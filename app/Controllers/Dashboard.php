<?php

namespace App\Controllers;

use App\Models\DataDashboardUser;
use App\Models\UserLogin;
use App\Models\UserToken;

class Dashboard extends BaseController
{
  protected $UserId;
  protected $Token;

  public function dashboard()
  {

    $userData = array();
    $this->Token = new UserToken();

    $getToken = $this->Token->getToken($_COOKIE["access_token"]);


    // check cookie 
    if (isset($_COOKIE["access_token"])) {
      $this->UserId = $getToken[0]["ID_AKUN"];
    }

    $db = new UserLogin();
    $dataLogin = $db->getUserLogin($this->UserId);

    $dataWisata = new DataDashboardUser();
    $getDataWisata = $dataWisata->getAllDataUser($this->UserId);


    if (is_array($dataLogin) && is_array($getDataWisata)) {
      $userData = [
        'id_user' => $dataLogin[0]["ID_USER"],
        'username' => $dataLogin[0]["USERNAME"],
        'poto_profil' => $dataLogin[0]["GAMBAR_PROFIL"],
        'data_wisata' => $getDataWisata
      ];
    }

    return view('Dashboard/Page/dashboardpage', $userData);
  }
}
