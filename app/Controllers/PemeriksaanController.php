<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FormPemeriksaan;
use App\Models\FormPemeriksaanDatatablesModel;
use App\Models\ItemPemeriksaanModel;
use App\Models\PasienModel;
use App\Models\PemeriksaanDatatablesModel;
use App\Models\PemeriksaanModel;
use App\Models\PetugasDatatablesModel;
use App\Models\PetugasModel;
use App\Models\SamplingDatatablesModel;
use App\Models\SamplingModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Exception;

class PemeriksaanController extends BaseController
{
    public function __construct()
    {
        helper(["main"]);
    }
    public function index()
    {
        return view('pages/layout/pemeriksaan/data-pemeriksaan/index');
    }

    public function dataPemeriksaanList()
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

    public function showPemeriksaan($id = null, $idPasien = null)
    {
        $pemeriksaanmModel = new PemeriksaanModel();
        $pemeriksaanData = $pemeriksaanmModel->select('t_pemeriksaan.id, t_pemeriksaan.idPasien, t_pemeriksaan.status, t_pemeriksaan.tanggalPemeriksaan, t_pemeriksaan.statusSelesai, t_pemeriksaan.NomorAntrian, t_pemeriksaan.userIdPendaftar, t_pemeriksaan.metode_pembayaran, t_pemeriksaan.totalPembayaran, t_pemeriksaan.updated_at,t_request.idSubPemeriksaan, m_subPemeriksaan.nama, m_subPemeriksaan.harga')->join('t_request', 't_pemeriksaan.id=t_request.idTrPemeriksaan')->join('m_subPemeriksaan', 't_request.idSubPemeriksaan=m_subPemeriksaan.id')->where('t_pemeriksaan.id', $id)->where('t_pemeriksaan.idPasien', $idPasien)->get()->getResultArray();

        $samplingModel = new SamplingModel();
        $samplingData = $samplingModel->where('idPemeriksaan', $id)->get()->getResultArray();

        return view('pages/layout/pemeriksaan/data-pemeriksaan/show',  ['pemeriksaanData' => $pemeriksaanData, 'samplingData' => $samplingData]);
    }

    public function showPengambilanSample($id = null, $idPasien = null, $idSub = null)
    {
        $pemeriksaanmModel = new PemeriksaanModel();
        $pemeriksaanData = $pemeriksaanmModel->select('t_pemeriksaan.id, t_pemeriksaan.idPasien, t_pemeriksaan.status, t_pemeriksaan.tanggalPemeriksaan, t_pemeriksaan.statusSelesai, t_pemeriksaan.NomorAntrian, t_pemeriksaan.userIdPendaftar, t_pemeriksaan.metode_pembayaran, t_pemeriksaan.totalPembayaran, t_pemeriksaan.updated_at, t_request.idSubPemeriksaan, m_subPemeriksaan.nama, m_subPemeriksaan.harga')->join('t_request', 't_pemeriksaan.id=t_request.idTrPemeriksaan')->join('m_subPemeriksaan', 't_request.idSubPemeriksaan=m_subPemeriksaan.id')->where('t_pemeriksaan.id', $id)->where('t_pemeriksaan.idPasien', $idPasien)->where('t_request.idSubPemeriksaan', $idSub)->get()->getRowArray();

        return view('pages/layout/pemeriksaan/data-pemeriksaan/pengambilan-sample/add',  ['pemeriksaanData' => $pemeriksaanData]);
    }
    public function addPengambilanSample($id = null)
    {
        try {
            $formPemeriksaanModel = new FormPemeriksaan();
            $isValid = $this->validate([
                'item' => 'required',
                'satuan' => 'required',
                'nilai' => 'required'
            ]);

            if (!$isValid) {
                return $this->response->setStatusCode(400)->setJson([
                    'error'     => true,
                    'message'   => "Data is not valid",
                    'data'      => $this->validator->getErrors()
                ]);
            }
            $pModel = new PemeriksaanModel();
            $pModel->update($id, [
                "statusSelesai" => "Pemeriksaan",
                "updated_at" => date('Y-m-d H:i:s')
            ]);

            $dataToInsert = [
                'idPemeriksaan' => $id,
                'idSubPemeriksaan' => $this->request->getVar('idSubPemeriksaan'),
                'nama' => $this->request->getVar('item'),
                'satuan' => $this->request->getVar('satuan'),
                'normal' => $this->request->getVar('nilai'),
                // 'normal' => $this->request->getVar('nilai'),
            ];

            $doInsert = $formPemeriksaanModel->insert($dataToInsert);

            return $this->response->setStatusCode(200)->setJson([
                "error"     => false,
                "message"   => "Successfully add data",
                "data"      => $dataToInsert
            ]);
        } catch (Exception $e) {
            return $this->response->setStatusCode(500)->setJson([
                "error"     => true,
                "message"   => $e->getMessage(),
                "data"      => []
            ]);
        }
    }
    public function detailPemeriksaan($id = null, $idPasien = null)
    {
        $pemeriksaanmModel = new FormPemeriksaan();
        $pemeriksaanData = $pemeriksaanmModel->select('m_formPemeriksaan.id, m_formPemeriksaan.idPemeriksaan, m_formPemeriksaan.idSubPemeriksaan, m_formPemeriksaan.nama, m_formPemeriksaan.satuan, m_formPemeriksaan.normal, m_formPemeriksaan.created_at, t_pemeriksaan.idPasien, t_pemeriksaan.status, t_pemeriksaan.tanggalPemeriksaan, t_pemeriksaan.statusSelesai, t_pemeriksaan.NomorAntrian, t_pemeriksaan.userIdPendaftar, t_pemeriksaan.metode_pembayaran, t_pemeriksaan.totalPembayaran, t_pemeriksaan.updated_at, m_subPemeriksaan.nama as namaSubPemeriksaan, m_subPemeriksaan.harga')->join('t_pemeriksaan', 't_pemeriksaan.id=m_formPemeriksaan.idPemeriksaan')->join('m_subPemeriksaan', 'm_formPemeriksaan.idSubPemeriksaan=m_subPemeriksaan.id')->where('m_formPemeriksaan.idPemeriksaan', $id)->where('t_pemeriksaan.idPasien', $idPasien)->get()->getResultArray();

        $pasienModel = new PasienModel();
        $pasienData = $pasienModel->where('id', $idPasien)->get()->getRowArray();

        return view('pages/layout/pemeriksaan/hasil-pemeriksaan/show',  ['pemeriksaanData' => $pemeriksaanData, 'pasienData' => $pasienData]);
    }
    public function showRiwayatPemeriksaan($id = null, $idPasien = null, $idSub = null)
    {
        $pemeriksaanmModel = new FormPemeriksaan();
        $pemeriksaanData = $pemeriksaanmModel->select('m_formPemeriksaan.id, m_formPemeriksaan.idPemeriksaan, m_formPemeriksaan.idSubPemeriksaan, m_formPemeriksaan.nama, m_formPemeriksaan.satuan, m_formPemeriksaan.normal, m_formPemeriksaan.created_at, m_subPemeriksaan.nama as namaSubPemeriksaan, t_pemeriksaan.idPasien, t_pemeriksaan.status, t_pemeriksaan.tanggalPemeriksaan, t_pemeriksaan.statusSelesai, t_pemeriksaan.NomorAntrian, t_pemeriksaan.userIdPendaftar, t_pemeriksaan.metode_pembayaran, t_pemeriksaan.totalPembayaran, t_pemeriksaan.updated_at, m_pasien.nomorRekamMedis, m_pasien.namaPasien, m_pasien.jk, m_pasien.tempatLahir, m_pasien.tanggalLahir, m_pasien.email, m_pasien.nomor, m_pasien.alamat, m_pasien.usia')->join('t_pemeriksaan', 't_pemeriksaan.id=m_formPemeriksaan.idPemeriksaan')->join('m_subPemeriksaan', 'm_subPemeriksaan.id=m_formPemeriksaan.idSubPemeriksaan')->join('m_pasien', 't_pemeriksaan.idPasien=m_pasien.id', 'left')->where('t_pemeriksaan.id', $id)->where('t_pemeriksaan.idPasien', $idPasien)->where('m_formPemeriksaan.idSubPemeriksaan', $idSub)->get()->getRowArray();

        return view('pages/layout/sampling/pendaftar/pengambilan-sample/add',  ['pemeriksaanData' => $pemeriksaanData]);
    }


    public function indexHasilPemeriksaan()
    {
        return view('pages/layout/pemeriksaan/hasil-pemeriksaan/index');
    }

    public function hasilPemeriksaanList()
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

    public function showHasilPemeriksaan($id = null, $idPasien = null)
    {
        $pemeriksaanmModel = new FormPemeriksaan();
        $pemeriksaanData = $pemeriksaanmModel->select('m_formPemeriksaan.id, m_formPemeriksaan.idPemeriksaan, m_formPemeriksaan.idSubPemeriksaan, m_formPemeriksaan.nama, m_formPemeriksaan.satuan, m_formPemeriksaan.normal, m_formPemeriksaan.created_at, t_pemeriksaan.idPasien, t_pemeriksaan.status, t_pemeriksaan.tanggalPemeriksaan, t_pemeriksaan.statusSelesai, t_pemeriksaan.NomorAntrian, t_pemeriksaan.userIdPendaftar, t_pemeriksaan.metode_pembayaran, t_pemeriksaan.totalPembayaran, t_pemeriksaan.updated_at, m_subPemeriksaan.nama as namaSubPemeriksaan, m_subPemeriksaan.harga, m_subPemeriksaan.normal as nilaiAcuan, m_subPemeriksaan.satuan as satuanAcuan')->join('t_pemeriksaan', 't_pemeriksaan.id=m_formPemeriksaan.idPemeriksaan')->join('m_subPemeriksaan', 'm_formPemeriksaan.idSubPemeriksaan=m_subPemeriksaan.id')->where('m_formPemeriksaan.idPemeriksaan', $id)->where('t_pemeriksaan.idPasien', $idPasien)->get()->getResultArray();

        $pasienModel = new PasienModel();
        $pasienData = $pasienModel->where('id', $idPasien)->get()->getRowArray();

        return json_encode(['pemeriksaanData' => $pemeriksaanData, 'pasienData' => $pasienData]);
    }


    public function indexSampling()
    {
        return view('pages/layout/pemeriksaan/data-sampling/index');
    }

    public function showSampling($id = null)
    {
        $samplingModel = new SamplingModel();
        $samplingData = $samplingModel->where('idPemeriksaan', $id)->get()->getResultArray();

        return view('pages/layout/pemeriksaan/data-sampling/show',  ['samplingData' => $samplingData]);
    }

    public function addSample($id = null)
    {
        try {
            $formPemeriksaanModel = new SamplingModel();
            $isValid = $this->validate([
                'keterangan' => 'required',
            ]);

            if (!$isValid) {
                return $this->response->setStatusCode(400)->setJson([
                    'error'     => true,
                    'message'   => "Data is not valid",
                    'data'      => $this->validator->getErrors()
                ]);
            }

            $dataToInsert = [
                'idPemeriksaan' => $id,
                'keterangan' => $this->request->getVar('keterangan'),
                // 'normal' => $this->request->getVar('nilai'),
            ];

            $doInsert = $formPemeriksaanModel->insert($dataToInsert);

            return $this->response->setStatusCode(200)->setJson([
                "error"     => false,
                "message"   => "Successfully add data",
                "data"      => $dataToInsert
            ]);
        } catch (Exception $e) {
            return $this->response->setStatusCode(500)->setJson([
                "error"     => true,
                "message"   => $e->getMessage(),
                "data"      => []
            ]);
        }
    }


    public function indexPetugas()
    {
        return view('pages/layout/sampling/laboratorium/index');
    }

    public function formPetugasAdd()
    {
        return view('pages/layout/sampling/laboratorium/add');
    }

    public function formPetugasEdit()
    {
        $id = $this->request->getVar("id");
        $petugasModel = new PetugasModel();
        $getData = $petugasModel->getById($id);
        return view('pages/layout/sampling/laboratorium/edit', $getData);
    }

    public function petugasList()
    {
        $request = Services::request();
        $datatable = new PetugasDatatablesModel($request);

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

    public function petugasAdd()
    {
        try {
            $petugasModel = new PetugasModel();
            $isValid = $this->validate([
                'namaLengkap' => 'required',
                'nik' => 'required',
                'tglLahir' => 'required',
                'tglTugas' => 'required',
            ]);

            if (!$isValid) {
                return $this->response->setStatusCode(400)->setJson([
                    'error'     => true,
                    'message'   => "Data is not valid",
                    'data'      => $this->validator->getErrors()
                ]);
            }

            $dataToInsert = [
                'id' => uuidv4(),
                'namaLengkap' => $this->request->getVar('namaLengkap'),
                'tglLahir' => $this->request->getVar('tglLahir'),
                'tglTugas' => $this->request->getVar('tglTugas'),
                'nik' => $this->request->getVar('nik'),
            ];
            $doInsert = $petugasModel->insert($dataToInsert);

            return $this->response->setStatusCode(200)->setJson([
                "error"     => false,
                "message"   => "Successfully add data petugas",
                "data"      => $dataToInsert
            ]);
        } catch (Exception $e) {
            return $this->response->setStatusCode(500)->setJson([
                "error"     => true,
                "message"   => $e->getMessage(),
                "data"      => []
            ]);
        }
    }

    public function petugasEdit()
    {
        try {
            $petugasModel = new PetugasModel();
            $isValid = $this->validate([
                'namaLengkap' => 'required',
                'nik' => 'required',
                'tglLahir' => 'required',
                'tglTugas' => 'required',
            ]);

            if (!$isValid) {
                return $this->response->setStatusCode(400)->setJson([
                    'error'     => true,
                    'message'   => "Data is not valid",
                    'data'      => $this->validator->getErrors()
                ]);
            }
            $id = $this->request->getVar('id');

            $dataToUpdate = [
                'id' => $id,
                'namaLengkap' => $this->request->getPost('namaLengkap'),
                'tglLahir' => $this->request->getPost('tglLahir'),
                'tglTugas' => $this->request->getPost('tglTugas'),
                'nik' => $this->request->getPost('nik'),
            ];
            $petugasModel->update($id, $dataToUpdate);
            return $this->response->setStatusCode(200)->setJson([
                "error"     => false,
                "message"   => "Successfully modify data petugas",
                "data"      => $dataToUpdate
            ]);
        } catch (Exception $e) {
            return $this->response->setStatusCode(500)->setJson([
                "error"     => true,
                "message"   => $e->getMessage(),
                "data"      => []
            ]);
        }
    }

    public function petugasDelete()
    {
        try {
            $petugasModel = new PetugasModel();

            $isValid = $this->validate([
                'id' => 'required',
            ]);

            if (!$isValid) {
                return $this->response->setStatusCode(400)->setJson([
                    'error'     => true,
                    'message'   => "Data is not valid",
                    'data'      => $this->validator->getErrors()
                ]);
            }
            $id = $this->request->getVar("id");
            $doDelete = $petugasModel->delete($id);

            return $this->response->setStatusCode(200)->setJson([
                "error"     => false,
                "message"   => "Successfully delete petugas",
                "data"      => $id
            ]);
        } catch (Exception $e) {
            return $this->response->setStatusCode(500)->setJson([
                "error"     => true,
                "message"   => $e->getMessage(),
                "data"      => []
            ]);
        }
    }
}
