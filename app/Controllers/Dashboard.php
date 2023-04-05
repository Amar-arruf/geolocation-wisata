<?php 
namespace App\Controllers;

use App\Models\getLocationDash;
use App\Models\UserLogin;



class Dashboard extends BaseController {

  public function dashboard ()
  {
    $UserId = '108321858974021678564';
    $userData = array();

    $db = new UserLogin();
    $dataLogin = $db->getUserLogin($UserId);

    $dataWisata = new getLocationDash();
    $getDataWisata = $dataWisata->getAllDataWisata();
    
    
    if(is_array($dataLogin) && is_array($getDataWisata)) {
      $userData = [
        'id_user' => $dataLogin[0]["ID_USER"],
        'username' => $dataLogin[0]["USERNAME"],
        'poto_profil' => $dataLogin[0]["GAMBAR_PROFIL"],
        'data_wisata' => $getDataWisata
      ];  
    }

    return view('Dashboard/Page/dashboardpage',$userData);
  }
}