<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemPemeriksaanDatatablesModel;
use App\Models\ItemPemeriksaanModel;
use App\Models\SubItemPemeriksaanModel;
use App\Models\UserDatatablesModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
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

    public function rincianItemPemeriksaan()
    {
        return view('pages/layout/pendaftaran/jenis_pemeriksaan/rincian');
    }

    public function createUser()
    {
        return view('pages/layout/admin/user/add');
    }

    public function storeUser()
    {
        $userModel = new UserModel();
        try {
            $data = [
                'roleId' => $this->request->getPost('role'),
                'namaDepan' => $this->request->getPost('depan'),
                'namaBelakang' => $this->request->getPost('belakang'),
                'email' => $this->request->getPost('email'),
                'nomor' => $this->request->getPost('nomor'),
                'password' => $this->request->getPost('password')
            ];

            if (!$userModel->insert($data)) {
                $response = [
                    'status' => 400,
                    'message' => 'Atlm gagal disimpan.',
                    'data' => $data
                ];
                return redirect('admin/users/create-user')->with('messageError', 'Gagal menyimpan data!');
            }
            $response = [
                'status' => 201,
                'message' => 'Atlm berhasil disimpan.',
                'data' => $data
            ];
            return redirect('admin/users')->with('success', $response);
        } catch (Exception $e) {
            $response = [
                'status' => 400,
                'message' => 'Atlm gagal disimpan.',
                'data' => $data
            ];
            return redirect('admin/users/create-user')->with('messageError', 'Gagal menyimpan data!');
        }
    }
    //end user

    //item pemeriksaan
    public function indexItemPemeriksaan()
    {
        return view('pages/layout/admin/item-pemeriksaan/index');
    }
    public function itemPemeriksaanList()
    {
        $request = Services::request();
        $datatable = new ItemPemeriksaanDatatablesModel($request);

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
