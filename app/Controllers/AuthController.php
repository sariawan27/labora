<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function index()
    {
        return view('pages/auth/login');
    }
    public function pendaftaran() {
        return view('pages/auth/login');
    }
    public function sampling() {
        return view('pages/auth/login');
    }
    public function pemeriksaan() {
        return view('pages/auth/login');
    }
    public function validasi() {
        return view('pages/auth/login');
    }

    public function login($param = null) {
        
        $session = session();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();

        $dataUser = $userModel->where([
            'username' => $username,
            'password' => $password,
            'deleted_at' => NULL

        ])->get()->getResultArray();

        if (count($dataUser) == 0) {
                return redirect('login/'.$param)->with('messageError', 'akun tidak tersedia');
        } else {
            if ($param!=null) {
                
                $session->set('user', $dataUser);
                return redirect($param);
            } else {
                return redirect('login/'.$param);
            }
        }
        
        // return json_encode($dataUser);

    }

    public function session_check() {
        $session = session();
        var_dump($session->get('user'));
    }

    public function logout($param) {
        $session = session();
        $session->remove('user');

        return redirect('login/'.$param);
    }
}
