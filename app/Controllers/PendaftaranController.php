<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemPemeriksaanDatatablesModel;
use App\Models\ItemPemeriksaanModel;
use App\Models\PasienModel;
use App\Models\PemeriksaanDatatablesModel;
use App\Models\PemeriksaanModel;
use App\Models\RequestModel;
use App\Models\SubItemPemeriksaanModel;
use App\Models\UserDatatablesModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use DateTime;
use Exception;

class PendaftaranController extends BaseController
{
    public function dashboard()
    {
        //
    }

    //registrasi
    public function indexRegistrasi()
    {
        return view('pages/layout/pendaftaran/registrasi/index');
    }

    public function pasienRegistrasi()
    {
        $request = Services::request();
        $datatable = new UserDatatablesModel($request);

        $lists = $datatable->getDatatables();
        $data = [];
        $no = $request->getGet('start');

        foreach ($lists as $list) {
            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $list->namaDepan;
            $row[] = $list->namaBelakang;
            $data[] = $row;
        }

        $output = [
            'draw' => $request->getGet('draw'),
            'recordsTotal' => $datatable->countAll(),
            'recordsFiltered' => $datatable->countFiltered(),
            'data' => $lists
        ];

        return json_encode($output);
    }

    public function setRegistrasi()
    {
        $data = [
            'roleId' => $this->request->getPost('role'),
            'nama' => $this->request->getPost('nama'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'usia' => $this->request->getPost('usia'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'nik' => $this->request->getPost('nik'),
            'email' => $this->request->getPost('email'),
            'no_telp' => $this->request->getPost('no_telp'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        $session = session();
        $session->set('registrasi_pasien', $data);

        return redirect('pendaftaran/jenis-pemeriksaan');
    }

    public function jenisPemeriksaan()
    {
        $itemPemeriksaanModel = new ItemPemeriksaanModel();
        $itemPemeriksaanData = $itemPemeriksaanModel->get()->getResultArray();

        return view('pages/layout/pendaftaran/jenis_pemeriksaan/index',  ['itemPemeriksaanData' => $itemPemeriksaanData]);
    }

    public function subJenisPemeriksaan($id = null)
    {
        $itemPemeriksaanModel = new ItemPemeriksaanModel();
        $itemPemeriksaanData = $itemPemeriksaanModel->where('id', $id)->get()->getRowArray();

        $subItemModel = new SubItemPemeriksaanModel();
        $subItemData = $subItemModel->where('idPemeriksaan', $id)->get()->getResultArray();

        return view('pages/layout/pendaftaran/jenis_pemeriksaan/sub_pemeriksaan',  ['itemPemeriksaanData' => $itemPemeriksaanData, 'subItemData' => $subItemData]);
    }

    public function showSubJenisPemeriksaan($id = null)
    {
        // $itemPemeriksaanModel = new ItemPemeriksaanModel();
        // $itemPemeriksaanData = $itemPemeriksaanModel->where('id', $id)->get()->getRowArray();

        $subItemModel = new SubItemPemeriksaanModel();
        $subItemData = $subItemModel->where('id', $id)->get()->getRowArray();

        return view('pages/layout/pendaftaran/jenis_pemeriksaan/detail_sub_pemeriksaan',  ['subItemData' => $subItemData]);
    }

    public function tempPemeriksaan($id = null)
    {
        $subItemModel = new SubItemPemeriksaanModel();
        $subItemData = $subItemModel->where('id', $id)->get()->getRowArray();

        $session = session();
        $itemSessionData  = $session->get('item_pemeriksaan');
        if (!$itemSessionData) {
            $itemSessionData = [];
        }

        array_push($itemSessionData, $subItemData);

        $totalPembayaran = 0;
        foreach ($itemSessionData as $key => $value) {
            $totalPembayaran += $value['harga'];
        }

        $session->set('total_pembayaran', $totalPembayaran);
        $session->set('item_pemeriksaan', $itemSessionData);

        return redirect('pendaftaran/rincian-pemeriksaan');
    }

    public function delItemTempPemeriksaan($id = null)
    {
        $session = session();
        $itemSessionData  = $session->get('item_pemeriksaan');
        $itemFiltered = array_filter($itemSessionData, function ($obj, $key) use ($id) {
            return $key != $id;
        }, ARRAY_FILTER_USE_BOTH);
        $session->set('item_pemeriksaan', $itemFiltered);

        return redirect('pendaftaran/rincian-pemeriksaan');
    }

    public function rincianItemPemeriksaan()
    {
        $session = session();
        $itemSessionData  = $session->get('item_pemeriksaan');

        $session = session();
        $pembayaranSession  = $session->get('total_pembayaran');
        if (!$itemSessionData) {
            return redirect('pendaftaran/jenis-pemeriksaan');
        }

        return view('pages/layout/pendaftaran/jenis_pemeriksaan/rincian', ['itemSessionData' => $itemSessionData, 'totalPembayaran' => $pembayaranSession]);
    }

    public function createUser()
    {
        return view('pages/layout/admin/user/add');
    }

    public function storePemeriksaan()
    {
        // $userModel = new UserModel();
        try {
            $data = [
                'tanggalPemeriksaan' => $this->request->getPost('jadwal'),
                'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
            ];


            //get data from session
            $session = session();
            $pasienSession = $session->get('registrasi_pasien');
            $userLoginSession = $session->get('user');
            $itemPemeriksaanSession = $session->get('item_pemeriksaan');
            $totalPembayaranSession = $session->get('total_pembayaran');

            $pasienModel =  new PasienModel();
            $row = $pasienModel->select('MAX(nomorRekamMedis) AS max_code')->get()->getRowArray();

            $maxCode = $row['max_code'];

            // Extract the numeric part and increment it.
            $numericPart = (int) substr($maxCode, 3);
            $numericPart++;

            // Generate the new code
            $newCode = 'RM-' . str_pad($numericPart, 6, '0', STR_PAD_LEFT);

            $pasienData = [
                'userId' => $userLoginSession[0]['id'],
                'nomorRekamMedis' => $newCode,
                'namaPasien' => $pasienSession['nama'],
                'jk' => $pasienSession['jenis_kelamin'],
                'tempatLahir' => $pasienSession['tempat_lahir'],
                'tanggalLahir' => $pasienSession['tanggal_lahir'],
                'email' => $pasienSession['email'],
                'nomor' => $pasienSession['no_telp'],
                'alamat' => $pasienSession['alamat'],
                'usia' => $pasienSession['usia']
            ];

            $savePasien = $pasienModel->insert($pasienData);

            //insert pemeriksaan pasien
            // $query = $this->db->query("SELECT MAX(NomorAntrian) AS max_code FROM t_pemeriksaan WHERE tanggalPemeriksaan = DATE_FORMAT(NOW(), '%Y-%m-%d')");
            $jadwal = date('Y-m-d', strtotime($this->request->getPost('jadwal')));
            $pemeriksaanModel = new PemeriksaanModel();
            $row = $pemeriksaanModel->select("MAX(NomorAntrian) AS max_code")->where('tanggalPemeriksaan', $jadwal)->get()->getRowArray();
            $maxCode = $row['max_code'];

            $nomorAntrian = 1;

            // Extract the numeric part and increment it.
            if ($maxCode ==  '' || $maxCode ==  null || $maxCode ==  NULL) {
                $nomorAntrian = 1;
            } else {
                $numericPart = (int) substr($maxCode, 0);
                $numericPart++;
                $nomorAntrian = $numericPart;
            }

            $pemeriksaanData = [
                'idPasien' => $pasienModel->getInsertID(),
                'status' => 'Belum Lunas',
                'tanggalPemeriksaan' => $jadwal,
                'statusSelesai' => 'Belum Selesai',
                'NomorAntrian' => $nomorAntrian,
                'userIdPendaftar' => $userLoginSession[0]['id'],
                'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
                'totalPembayaran' => $totalPembayaranSession
            ];

            $pemeriksaanModel = new PemeriksaanModel();
            $savePemeriksaan = $pemeriksaanModel->insert($pemeriksaanData);

            foreach ($itemPemeriksaanSession as $key => $value) {
                $subPemeriksaanData = [
                    'idTrPemeriksaan' => $pemeriksaanModel->getInsertID(),
                    'idSubPemeriksaan' => $value['id']
                ];

                $requestModel = new RequestModel();
                $saveSubPemeriksaan = $requestModel->insert($subPemeriksaanData);
            }

            if (!$savePasien) {
                $response = [
                    'status' => 400,
                    'message' => 'Atlm gagal disimpan.',
                    'data' => $data
                ];
                return redirect('pendaftaran/registrasi')->with('messageError', 'Gagal menyimpan data!');
            }

            if (!$savePemeriksaan) {
                $response = [
                    'status' => 400,
                    'message' => 'Atlm gagal disimpan.',
                    'data' => $data
                ];
                return redirect('pendaftaran/jenis-pemeriksaan')->with('messageError', 'Gagal menyimpan data!');
            }

            if (!$saveSubPemeriksaan) {
                $response = [
                    'status' => 400,
                    'message' => 'Atlm gagal disimpan.',
                    'data' => $data
                ];
                return redirect('pendaftaran/rincian-pemeriksaan')->with('messageError', 'Gagal menyimpan data!');
            }

            $session->remove('item_pemeriksaan');
            $session->remove('registrasi_pasien');
            $session->remove('total_pembayaran');
            $response = [
                'status' => 201,
                'message' => 'Atlm berhasil disimpan.',
                'data' => $data
            ];
            return redirect('pendaftaran/registrasi')->with('success', $response);
        } catch (Exception $e) {
            $response = [
                'status' => 400,
                'message' => 'Atlm gagal disimpan.',
                'data' => $data
            ];
            return redirect('pendaftaran/registrasi')->with('messageError', 'Gagal menyimpan data!');
        }
    }
    //end user

    //pendaftar / pasien
    public function indexPendaftar()
    {
        return view('pages/layout/pendaftaran/pendaftar/index');
    }
    public function pemeriksaanList()
    {
        $request = Services::request();
        $datatable = new PemeriksaanDatatablesModel($request);

        $lists = $datatable->getDatatables();
        $data = [];
        $no = $request->getGet('start');

        $output = [
            'draw' => $request->getGet('draw'),
            'recordsTotal' => $datatable->countAll(),
            'recordsFiltered' => $datatable->countFiltered(),
            'data' => $lists
        ];

        return json_encode($output);
    }
}
