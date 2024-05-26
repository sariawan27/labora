<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FormPemeriksaan;
use App\Models\PasienModel;
use App\Models\PemeriksaanDatatablesModel;
use App\Models\PemeriksaanModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class ValidasiController extends BaseController
{
    public function index()
    {
        //
    }

    public function indexHasilPemeriksaan()
    {
        return view('pages/layout/validasi/hasil-pemeriksaan/index');
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
    public function showPemeriksaan($id = null, $idPasien = null)
    {
        $pemeriksaanmModel = new FormPemeriksaan();
        $pemeriksaanData = $pemeriksaanmModel->select('m_formPemeriksaan.id, m_formPemeriksaan.idPemeriksaan, m_formPemeriksaan.idSubPemeriksaan, m_formPemeriksaan.nama, m_formPemeriksaan.satuan, m_formPemeriksaan.normal, m_formPemeriksaan.created_at, t_pemeriksaan.idPasien, t_pemeriksaan.status, t_pemeriksaan.tanggalPemeriksaan, t_pemeriksaan.statusSelesai, t_pemeriksaan.NomorAntrian, t_pemeriksaan.userIdPendaftar, t_pemeriksaan.metode_pembayaran, t_pemeriksaan.totalPembayaran, t_pemeriksaan.updated_at, m_subPemeriksaan.nama as namaSubPemeriksaan, m_subPemeriksaan.harga, m_subPemeriksaan.normal as nilaiAcuan, m_subPemeriksaan.satuan as satuanAcuan')->join('t_pemeriksaan', 't_pemeriksaan.id=m_formPemeriksaan.idPemeriksaan')->join('m_subPemeriksaan', 'm_formPemeriksaan.idSubPemeriksaan=m_subPemeriksaan.id')->where('m_formPemeriksaan.idPemeriksaan', $id)->where('t_pemeriksaan.idPasien', $idPasien)->get()->getResultArray();

        $pasienModel = new PasienModel();
        $pasienData = $pasienModel->where('id', $idPasien)->get()->getRowArray();

        return view('pages/layout/validasi/hasil-pemeriksaan/show',  ['pemeriksaanData' => $pemeriksaanData, 'pasienData' => $pasienData]);
    }
    function validasiPemeriksaan($id = null, $idPasien = null)
    {
        $pModel = new PemeriksaanModel();
        $pModel->update($id, [
            "statusSelesai" => "Selesai",
            "updated_at" => date('Y-m-d H:i:s')
        ]);
        return redirect()->to(base_url('validasi/hasil-pemeriksaan/show/') . $id . '/' . $idPasien);
    }
}
