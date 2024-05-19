<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class PemeriksaanController extends BaseController
{
    public function index()
    {
        return view('pages/layout/pemeriksaan/index');
    }

    public function dataPemeriksaanList()
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
}
