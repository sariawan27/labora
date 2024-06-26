<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemPemeriksaanDatatablesModel;
use App\Models\ItemPemeriksaanModel;
use App\Models\PemeriksaanDatatablesModel;
use App\Models\PemeriksaanModel;
use App\Models\SubItemPemeriksaanDatatablesModel;
use App\Models\SubItemPemeriksaanModel;
use App\Models\UserDatatablesModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Exception;

class AdminController extends BaseController
{
    public function dashboard()
    {
        //
    }

    //user
    public function indexUser()
    {
        return view('pages/layout/admin/user/index');
    }

    public function userList()
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
                'username' => $this->request->getPost('username'),
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

    public function editItemPemeriksaan($id = null)
    {
        $userModel = new UserModel();
        $userData = $userModel->where('id', $id)->get()->getRowArray();

        return view('pages/layout/admin/user/edit', ['userData' => $userData]);
    }

    public function updateUser($id = null)
    {
        $userModel = new UserModel();
        try {
            $data = [
                'roleId' => $this->request->getPost('role'),
                'namaDepan' => $this->request->getPost('depan'),
                'namaBelakang' => $this->request->getPost('belakang'),
                'email' => $this->request->getPost('email'),
                'nomor' => $this->request->getPost('nomor'),
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password')
            ];

            if (!$userModel->update($id, $data)) {
                $response = [
                    'status' => 400,
                    'message' => 'Data gagal diupdate.',
                    'data' => $data
                ];
                return redirect('admin/users')->with('messageError', 'Gagal mengupdate data!');
            }
            $response = [
                'status' => 201,
                'message' => 'Data berhasil diupdate.',
                'data' => $data
            ];
            return redirect('admin')->with('success', $response);
        } catch (Exception $e) {
            $response = [
                'status' => 400,
                'message' => 'Atlm gagal disimpan.',
                'data' => $data
            ];
            return redirect('admin/users')->with('messageError', 'Gagal menyimpan data!');
        }
    }

    public function deleteUser()
    {
        try {
            $userModel = new UserModel();

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
            $doDelete = $userModel->delete($id);

            return $this->response->setStatusCode(200)->setJson([
                "error"     => false,
                "message"   => "Successfully delete user",
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

    public function createItemPemeriksaan()
    {
        return view('pages/layout/admin/item-pemeriksaan/add');
    }

    public function storeItemPemeriksaan()
    {
        $userModel = new ItemPemeriksaanModel();
        try {
            $data = [
                'namaPemeriksaan' => $this->request->getPost('namaPemeriksaan'),
                'picture' => $this->request->getPost('picture'),
            ];

            if (!$userModel->insert($data)) {
                $response = [
                    'status' => 400,
                    'message' => 'Data gagal disimpan.',
                    'data' => $data
                ];
                return redirect('admin/item-pemeriksaan/create-item')->with('messageError', 'Gagal menyimpan data!');
            }
            $response = [
                'status' => 201,
                'message' => 'Data berhasil disimpan.',
                'data' => $data
            ];
            return redirect('admin/item-pemeriksaan')->with('success', $response);
        } catch (Exception $e) {
            $response = [
                'status' => 400,
                'message' => 'Data gagal disimpan.',
                'data' => $data
            ];
            return redirect('admin/item-pemeriksaan/create-item')->with('messageError', 'Gagal menyimpan data!');
        }
    }

    public function showItemPemeriksaan($id = null)
    {
        $itemPemeriksaanModel = new ItemPemeriksaanModel();
        $itemPemeriksaanData = $itemPemeriksaanModel->where('id', $id)->get()->getRowArray();

        return view('pages/layout/admin/item-pemeriksaan/show', ['itemPemeriksaanData' => $itemPemeriksaanData]);
    }

    public function updateItemPemeriksaan($id = null)
    {
        $userModel = new ItemPemeriksaanModel();
        try {
            $data = [
                'namaPemeriksaan' => $this->request->getPost('namaPemeriksaan'),
                'picture' => $this->request->getPost('picture'),
            ];

            if (!$userModel->update($id, $data)) {
                $response = [
                    'status' => 400,
                    'message' => 'Data gagal diupdate.',
                    'data' => $data
                ];
                return redirect('admin/item-pemeriksaan')->with('messageError', 'Gagal mengupdate data!');
            }
            $response = [
                'status' => 201,
                'message' => 'Data berhasil diupdate.',
                'data' => $data
            ];
            return redirect('admin/item-pemeriksaan')->with('success', $response);
        } catch (Exception $e) {
            $response = [
                'status' => 400,
                'message' => 'Data gagal diupdate.',
                'data' => $data
            ];
            return redirect('admin/item-pemeriksaan')->with('messageError', 'Gagal mengupdate data!');
        }
    }

    public function deleteItemPemeriksaan()
    {
        try {
            $itemPemeriksaanModel = new ItemPemeriksaanModel();
            $subItemPemeriksaanModel = new SubItemPemeriksaanModel();

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
            $getData = $subItemPemeriksaanModel->getAll(["idPemeriksaan" => $id]);

            $doDelete = $itemPemeriksaanModel->delete($id);

            if (!empty($getData)) {
                $mapData = array_map(function ($val) {
                    $val["deleted_at"] = date("Y-m-d H:i:s");
                    return $val;
                }, $getData);
                $doUpdate = $subItemPemeriksaanModel->updateBatch($mapData, "id");
            }

            return $this->response->setStatusCode(200)->setJson([
                "error"     => false,
                "message"   => "Successfully delete item pemeriksaan",
                "data"      => [
                    "doDelete"  => $doDelete,
                    "doUpdate"  => $doUpdate ?? 0
                ]
            ]);
        } catch (Exception $e) {
            return $this->response->setStatusCode(500)->setJson([
                "error"     => true,
                "message"   => $e->getMessage(),
                "data"      => []
            ]);
        }
    }
    //end item pemeriksaan

    //sub item pemeriksaan
    public function subItemPemeriksaanList($id = null)
    {
        $request = Services::request();
        $datatable = new SubItemPemeriksaanDatatablesModel($request, $id);

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
    public function createSubItemPemeriksaan($id = null)
    {
        return view('pages/layout/admin/sub-item-pemeriksaan/add');
    }

    public function storeSubItemPemeriksaan($id = null)
    {
        $subItemModel = new SubItemPemeriksaanModel();
        try {
            $data = [
                'idPemeriksaan' => $id,
                'nama' => $this->request->getPost('nama'),
                'harga' => $this->request->getPost('harga'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'picture' => $this->request->getPost('picture'),
                'satuan' => $this->request->getVar('satuan'),
                'normal' => $this->request->getVar('nilai'),
            ];

            if (!$subItemModel->insert($data)) {
                $response = [
                    'status' => 400,
                    'message' => 'Data gagal disimpan.',
                    'data' => $data
                ];
                return redirect('admin/sub-item-pemeriksaan/create-sub-item')->with('messageError', 'Gagal menyimpan data!');
            }
            $response = [
                'status' => 201,
                'message' => 'Data berhasil disimpan.',
                'data' => $data
            ];
            return redirect('admin/item-pemeriksaan')->with('success', $response);
        } catch (Exception $e) {
            $response = [
                'status' => 400,
                'message' => 'Data gagal disimpan.',
                'data' => $data
            ];
            return redirect('admin/sub-item-pemeriksaan/create-sub-item')->with('messageError', 'Gagal menyimpan data!');
        }
    }

    public function editSubItemPemeriksaan($id = null)
    {
        $subItemPemeriksaanModel = new SubItemPemeriksaanModel();
        $subItemPemeriksaanData = $subItemPemeriksaanModel->where('id', $id)->get()->getRowArray();

        return view('pages/layout/admin/sub-item-pemeriksaan/edit', ['subItemPemeriksaanData' => $subItemPemeriksaanData]);
    }

    public function updateSubItemPemeriksaan($id = null)
    {
        $subItemModel = new SubItemPemeriksaanModel();
        try {
            $data = [
                'nama' => $this->request->getPost('nama'),
                'harga' => $this->request->getPost('harga'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'picture' => $this->request->getPost('picture'),
                'satuan' => $this->request->getVar('satuan'),
                'normal' => $this->request->getVar('nilai'),
            ];

            if (!$subItemModel->update($id, $data)) {
                $response = [
                    'status' => 400,
                    'message' => 'Data gagal diupdate.',
                    'data' => $data
                ];
                return redirect()->back()->with('messageError', 'Gagal mengupdate data!');
            }
            $response = [
                'status' => 201,
                'message' => 'Data berhasil diupdate.',
                'data' => $data
            ];
            return redirect()->back()->with('success', $response);
        } catch (Exception $e) {
            $response = [
                'status' => 400,
                'message' => 'Data gagal diupdate.',
                'data' => $data
            ];
            return redirect()->back()->with('messageError', 'Gagal mengupdate data!');
        }
    }

    public function deleteSubItemPemeriksaan()
    {
        try {
            $subItemPemeriksaanModel = new SubItemPemeriksaanModel();

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
            $doDelete = $subItemPemeriksaanModel->delete($id);
            return $this->response->setStatusCode(200)->setJson([
                "error"     => false,
                "message"   => "Successfully delete sub item pemeriksaan",
                "data"      => $doDelete,
            ]);
        } catch (Exception $e) {
            return $this->response->setStatusCode(500)->setJson([
                "error"     => true,
                "message"   => $e->getMessage(),
                "data"      => []
            ]);
        }
    }

    public function indexPendaftar()
    {
        return view('pages/layout/admin/pendaftar/index');
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

    public function konfirmasiPembayaran($id = null)
    {
        try {
            $pemeriksaanModel = new PemeriksaanModel();
            $dataToUpdate = [
                'status' => 'Lunas',
            ];
            $pemeriksaanModel->update($id, $dataToUpdate);
            return $this->response->setStatusCode(200)->setJson([
                "error"     => false,
                "message"   => "Successfully modify update data",
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
}
