<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Desa;
use App\Models\getLocationDash;
use App\Models\Kecamatan;
use App\Models\UserLogin;

class DashboardAdmin extends BaseController
{
    protected $username;
    protected $data;
    protected $session;
    protected $breadcrumb;
    public function dashboard()
    {
        // check session 
        $this->session = \Config\Services::session();

        if (!$this->session->has('username')) {
            return redirect()->to('login');
        }

        // ambl data user
        $modelUser = new UserLogin;
        // ambil data desa
        $modeldesa = new Desa();
        // ambil data kecamatan
        $modelkecamatan = new Kecamatan();
        // ambil data wisata
        $modelWisata = new getLocationDash();

        $this->breadcrumb = [
            ["title" => "Dashboard"],
            ["title" => "Dashboard admin"],
        ];

        $this->data = [
            "username" => $this->session->get("username"),
            "data_users" => $modelUser->getAllDataUser(),
            "dataAktif" => $modelUser->getDataUserAktif("aktif"),
            "dataNonAktif" => $modelUser->getDataUserAktif("nonaktif"),
            "data_kecamatan" => $modelkecamatan->countDataKec(),
            "data_Desa" => $modeldesa->countData(),
            "data_wisata" => $modelWisata->getAllDataWisata(),
            "breadcrumb" => $this->breadcrumb
        ];

        return view('DashboardAdmin/Pages/dashboardAdmin', $this->data);
    }
}
