<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PetugasDatatablesModel;
use App\Models\PetugasModel;
use Config\Services;
use Exception;

class LaboratoriumController extends BaseController
{
    public function __construct()
    {
        helper(["main"]);
    }

    public function index()
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
