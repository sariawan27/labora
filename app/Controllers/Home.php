<?php

namespace App\Controllers;

use App\Models\ItemPemeriksaanModel;
use App\Models\PasienModel;
use App\Models\PemeriksaanModel;
use App\Models\SubItemPemeriksaanModel;
use App\Models\UserModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('pages/auth/index');
    }

    public function admin(): string
    {
        $pasienModel = new  PasienModel();
        $pasienCount = $pasienModel->where('YEAR(created_at)', date("Y"))->countAllResults();

        $atlmModel = new UserModel();
        $atlmCount = $atlmModel->where('roleId', 4)->countAllResults();

        $itemPemeriksaanModel = new ItemPemeriksaanModel();
        $itemPemeriksaanCount = $itemPemeriksaanModel->countAllResults();

        $subItemPemeriksaanModel = new SubItemPemeriksaanModel();
        $subItemPemeriksaanCount = $subItemPemeriksaanModel->countAllResults();

        $arrPasienPerbulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $pasienPerbulanCount = $pasienModel->where('MONTH(created_at)', $i)->where('YEAR(created_at)', date("Y"))->countAllResults();
            array_push($arrPasienPerbulan, $pasienPerbulanCount);
        }
        return view('pages/layout/admin/dashboard', [
            "pasienCount" => $pasienCount,
            "atlmCount" => $atlmCount,
            "itemPemeriksaanCount" => $itemPemeriksaanCount,
            "subItemPemeriksaanCount" => $subItemPemeriksaanCount,
            "arrPasienPerbulan" => json_encode($arrPasienPerbulan)
        ]);
    }

    public function pendaftaran(): string
    {
        $pasienModel = new  PasienModel();
        $pasienCount = $pasienModel->where('YEAR(created_at)', date("Y"))->countAllResults();

        $atlmModel = new UserModel();
        $atlmCount = $atlmModel->where('roleId', 4)->countAllResults();

        $itemPemeriksaanModel = new ItemPemeriksaanModel();
        $itemPemeriksaanCount = $itemPemeriksaanModel->countAllResults();

        $subItemPemeriksaanModel = new SubItemPemeriksaanModel();
        $subItemPemeriksaanCount = $subItemPemeriksaanModel->countAllResults();

        $arrPasienPerbulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $pasienPerbulanCount = $pasienModel->where('MONTH(created_at)', $i)->where('YEAR(created_at)', date("Y"))->countAllResults();
            array_push($arrPasienPerbulan, $pasienPerbulanCount);
        }
        return view('pages/layout/pendaftaran/dashboard', [
            "pasienCount" => $pasienCount,
            "atlmCount" => $atlmCount,
            "itemPemeriksaanCount" => $itemPemeriksaanCount,
            "subItemPemeriksaanCount" => $subItemPemeriksaanCount,
            "arrPasienPerbulan" => json_encode($arrPasienPerbulan)
        ]);
    }

    public function sampling(): string
    {
        $pasienModel = new  PasienModel();
        $pasienCount = $pasienModel->where('YEAR(created_at)', date("Y"))->countAllResults();

        $atlmModel = new UserModel();
        $atlmCount = $atlmModel->where('roleId', 4)->countAllResults();

        $itemPemeriksaanModel = new ItemPemeriksaanModel();
        $itemPemeriksaanCount = $itemPemeriksaanModel->countAllResults();

        $subItemPemeriksaanModel = new SubItemPemeriksaanModel();
        $subItemPemeriksaanCount = $subItemPemeriksaanModel->countAllResults();

        $arrPasienPerbulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $pasienPerbulanCount = $pasienModel->where('MONTH(created_at)', $i)->where('YEAR(created_at)', date("Y"))->countAllResults();
            array_push($arrPasienPerbulan, $pasienPerbulanCount);
        }
        return view('pages/layout/sampling/dashboard', [
            "pasienCount" => $pasienCount,
            "atlmCount" => $atlmCount,
            "itemPemeriksaanCount" => $itemPemeriksaanCount,
            "subItemPemeriksaanCount" => $subItemPemeriksaanCount,
            "arrPasienPerbulan" => json_encode($arrPasienPerbulan)
        ]);
    }

    public function pemeriksaan(): string
    {
        $pasienModel = new  PasienModel();
        $pasienCount = $pasienModel->where('YEAR(created_at)', date("Y"))->countAllResults();

        $atlmModel = new UserModel();
        $atlmCount = $atlmModel->where('roleId', 4)->countAllResults();

        $itemPemeriksaanModel = new ItemPemeriksaanModel();
        $itemPemeriksaanCount = $itemPemeriksaanModel->countAllResults();

        $subItemPemeriksaanModel = new SubItemPemeriksaanModel();
        $subItemPemeriksaanCount = $subItemPemeriksaanModel->countAllResults();

        $arrPasienPerbulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $pasienPerbulanCount = $pasienModel->where('MONTH(created_at)', $i)->where('YEAR(created_at)', date("Y"))->countAllResults();
            array_push($arrPasienPerbulan, $pasienPerbulanCount);
        }
        return view('pages/layout/pemeriksaan/dashboard', [
            "pasienCount" => $pasienCount,
            "atlmCount" => $atlmCount,
            "itemPemeriksaanCount" => $itemPemeriksaanCount,
            "subItemPemeriksaanCount" => $subItemPemeriksaanCount,
            "arrPasienPerbulan" => json_encode($arrPasienPerbulan)
        ]);
    }

    public function validasi(): string
    {
        $pasienModel = new  PasienModel();
        $pasienCount = $pasienModel->where('YEAR(created_at)', date("Y"))->countAllResults();

        $atlmModel = new UserModel();
        $atlmCount = $atlmModel->where('roleId', 4)->countAllResults();

        $itemPemeriksaanModel = new ItemPemeriksaanModel();
        $itemPemeriksaanCount = $itemPemeriksaanModel->countAllResults();

        $subItemPemeriksaanModel = new SubItemPemeriksaanModel();
        $subItemPemeriksaanCount = $subItemPemeriksaanModel->countAllResults();

        $arrPasienPerbulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $pasienPerbulanCount = $pasienModel->where('MONTH(created_at)', $i)->where('YEAR(created_at)', date("Y"))->countAllResults();
            array_push($arrPasienPerbulan, $pasienPerbulanCount);
        }
        return view('pages/layout/validasi/dashboard', [
            "pasienCount" => $pasienCount,
            "atlmCount" => $atlmCount,
            "itemPemeriksaanCount" => $itemPemeriksaanCount,
            "subItemPemeriksaanCount" => $subItemPemeriksaanCount,
            "arrPasienPerbulan" => json_encode($arrPasienPerbulan)
        ]);
    }

    public function landing(): string
    {
        return view('pages/auth/landing_page');
    }

    function notification()
    {
        $pemeriksaanModel = new PemeriksaanModel();
        $unreadNotif = $pemeriksaanModel->select('t_pemeriksaan.id, t_pemeriksaan.idPasien, t_pemeriksaan.status, t_pemeriksaan.tanggalPemeriksaan, t_pemeriksaan.statusSelesai, t_pemeriksaan.NomorAntrian, t_pemeriksaan.userIdPendaftar, t_pemeriksaan.metode_pembayaran, t_pemeriksaan.totalPembayaran, t_pemeriksaan.updated_at, m_pasien.nomorRekamMedis, m_pasien.namaPasien, m_pasien.jk, m_pasien.tempatLahir, m_pasien.tanggalLahir, m_pasien.email, m_pasien.nomor, m_pasien.alamat, m_pasien.usia')->join('m_pasien', 't_pemeriksaan.idPasien=m_pasien.id', 'left')->where('t_pemeriksaan.updated_at', null)->orderBy('t_pemeriksaan.created_at', 'desc')->limit(5)->get()->getResultArray();

        return json_encode([
            "unreadNotif" => $unreadNotif
        ]);
    }
}
