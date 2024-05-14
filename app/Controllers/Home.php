<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('pages/auth/index');
    }

    public function admin(): string
    {
        return view('pages/layout/admin/dashboard');
    }

    public function pendaftaran(): string
    {
        return view('layouts/pendaftaran');
    }

    public function sampling(): string
    {
        return view('layouts/sampling');
    }

    public function pemeriksaan(): string
    {
        return view('layouts/pemeriksaan');
    }

    public function validasi(): string
    {
        return view('layouts/validasi');
    }

    public function landing(): string
    {
        return view('pages/auth/landing_page');
    }
}
