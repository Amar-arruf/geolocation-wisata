<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\getLocationDash;

class DataWisataUser extends BaseController
{
  protected $username;
  protected $data;
  protected $session;
  protected $breadcrumb;
  public function index()
  {
    // check data session 
    $this->session = \Config\Services::session();

    if (!$this->session->has('username')) {
      return redirect()->to('login');
    }

    // ambi data wisata beserta uploader
    $modelDataWisata = new getLocationDash();
    $getData = $modelDataWisata->select(
      $modelDataWisata->table . '.ID,'
        . $modelDataWisata->table . '.NAMA,'
        . $modelDataWisata->table . '.VIDEO,'
        . $modelDataWisata->table . '.DESKRIPSI_TEXT,'
        . $modelDataWisata->table . '.GAMBAR,
         buka_tutup_wisata.JAM_OPERASIONAL, 
         hari_operasional_wisata.HARI_OPERASIONAL, 
         gps.LONGITUDE, 
         gps.ALTITUDE,
         userlogin.USERNAME,
         userlogin.GAMBAR_PROFIL,'
    )
      ->join('hari_operasional_wisata', 'hari_operasional_wisata.ID = profil_wisata.ID')
      ->join('buka_tutup_wisata', 'buka_tutup_wisata.KODE_JAM_OPERASI = hari_operasional_wisata.KODE_JAM_OPERASI')
      ->join('gps', 'gps.ID = profil_wisata.ID')
      ->join('uploader', 'uploader.ID = profil_wisata.ID')
      ->join('userlogin', 'userlogin.ID_USER = uploader.USER_ID');

    // bread_crumb
    $this->breadcrumb = [
      ["title" => "Dashboard"],
      ["title" => "Data Wisata"],
    ];

    $this->data = [
      "username" => $this->session->get("username"),
      "dataDesa" => $getData->paginate(3),
      "datapager" => $getData->pager,
      "breadcrumb" => $this->breadcrumb
    ];

    return view("DashboardAdmin/Pages/dataWisata", $this->data);
  }

  public function search()
  {
    // check data session 
    $this->session = \Config\Services::session();

    if (!$this->session->has('username')) {
      return redirect()->to('login');
    }

    // cari data 
    $keyword = $this->request->getVar('keyword');

    $modelDataWisata = new getLocationDash();
    $getData = $modelDataWisata->select(
      $modelDataWisata->table . '.ID,'
        . $modelDataWisata->table . '.NAMA,'
        . $modelDataWisata->table . '.VIDEO,'
        . $modelDataWisata->table . '.DESKRIPSI_TEXT,'
        . $modelDataWisata->table . '.GAMBAR,
         buka_tutup_wisata.JAM_OPERASIONAL, 
         hari_operasional_wisata.HARI_OPERASIONAL, 
         gps.LONGITUDE, 
         gps.ALTITUDE,
         userlogin.USERNAME,
         userlogin.GAMBAR_PROFIL,'
    )
      ->join('hari_operasional_wisata', 'hari_operasional_wisata.ID = profil_wisata.ID')
      ->join('buka_tutup_wisata', 'buka_tutup_wisata.KODE_JAM_OPERASI = hari_operasional_wisata.KODE_JAM_OPERASI')
      ->join('gps', 'gps.ID = profil_wisata.ID')
      ->join('uploader', 'uploader.ID = profil_wisata.ID')
      ->join('userlogin', 'userlogin.ID_USER = uploader.USER_ID')
      ->like('NAMA', $keyword);

    // bread_crumb
    $this->breadcrumb = [
      ["title" => "Dashboard"],
      ["title" => "Data Wisata"],
    ];

    $this->data = [
      "username" => $this->session->get("username"),
      "dataDesa" => $getData->paginate(3),
      "datapager" => $getData->pager,
      "breadcrumb" => $this->breadcrumb
    ];

    return view("DashboardAdmin/Pages/dataWisata", $this->data);
  }
}
