<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PemeriksaanDatatablesModel;
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
}
