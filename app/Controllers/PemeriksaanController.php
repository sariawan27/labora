<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FormPemeriksaan;
use App\Models\FormPemeriksaanDatatablesModel;
use App\Models\ItemPemeriksaanModel;
use App\Models\PasienModel;
use App\Models\PemeriksaanDatatablesModel;
use App\Models\PemeriksaanModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class PemeriksaanController extends BaseController
{
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
        $pModel = new PemeriksaanModel();
        $pModel->update($id, [
            "statusSelesai" => "Pemeriksaan",
            "updated_at" => date('Y-m-d H:i:s')
        ]);

        $pemeriksaanmModel = new FormPemeriksaan();
        $pemeriksaanData = $pemeriksaanmModel->select('m_formPemeriksaan.id, m_formPemeriksaan.idPemeriksaan, m_formPemeriksaan.idSubPemeriksaan, m_formPemeriksaan.nama, m_formPemeriksaan.satuan, m_formPemeriksaan.normal, m_formPemeriksaan.created_at, t_pemeriksaan.idPasien, t_pemeriksaan.status, t_pemeriksaan.tanggalPemeriksaan, t_pemeriksaan.statusSelesai, t_pemeriksaan.NomorAntrian, t_pemeriksaan.userIdPendaftar, t_pemeriksaan.metode_pembayaran, t_pemeriksaan.totalPembayaran, t_pemeriksaan.updated_at, m_subPemeriksaan.nama as namaSubPemeriksaan, m_subPemeriksaan.harga')->join('t_pemeriksaan', 't_pemeriksaan.id=m_formPemeriksaan.idPemeriksaan')->join('m_subPemeriksaan', 'm_formPemeriksaan.idSubPemeriksaan=m_subPemeriksaan.id')->where('m_formPemeriksaan.idPemeriksaan', $id)->where('t_pemeriksaan.idPasien', $idPasien)->get()->getResultArray();

        $pasienModel = new PasienModel();
        $pasienData = $pasienModel->where('id', $idPasien)->get()->getRowArray();

        return view('pages/layout/pemeriksaan/data-pemeriksaan/show',  ['pemeriksaanData' => $pemeriksaanData, 'pasienData' => $pasienData]);
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
        $pemeriksaanData = $pemeriksaanmModel->select('m_formPemeriksaan.id, m_formPemeriksaan.idPemeriksaan, m_formPemeriksaan.idSubPemeriksaan, m_formPemeriksaan.nama, m_formPemeriksaan.satuan, m_formPemeriksaan.normal, m_formPemeriksaan.created_at, t_pemeriksaan.idPasien, t_pemeriksaan.status, t_pemeriksaan.tanggalPemeriksaan, t_pemeriksaan.statusSelesai, t_pemeriksaan.NomorAntrian, t_pemeriksaan.userIdPendaftar, t_pemeriksaan.metode_pembayaran, t_pemeriksaan.totalPembayaran, t_pemeriksaan.updated_at, m_subPemeriksaan.nama as namaSubPemeriksaan, m_subPemeriksaan.harga')->join('t_pemeriksaan', 't_pemeriksaan.id=m_formPemeriksaan.idPemeriksaan')->join('m_subPemeriksaan', 'm_formPemeriksaan.idSubPemeriksaan=m_subPemeriksaan.id')->where('m_formPemeriksaan.idPemeriksaan', $id)->where('t_pemeriksaan.idPasien', $idPasien)->get()->getResultArray();

        $pasienModel = new PasienModel();
        $pasienData = $pasienModel->where('id', $idPasien)->get()->getRowArray();

        return json_encode(['pemeriksaanData' => $pemeriksaanData, 'pasienData' => $pasienData]);
    }
}
