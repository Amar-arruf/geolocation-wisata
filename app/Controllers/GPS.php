<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserLogin;

class GPS extends BaseController
{
    public function index()
    {
        //
        
        $UserId = '108321858974021678564';

        $db = new UserLogin();
        $dataLogin = $db->getUserLogin($UserId);
        if(is_array($dataLogin)) {
            $userData = [
              'id_user' => $dataLogin[0]["ID_USER"],
              'username' => $dataLogin[0]["USERNAME"],
              'poto_profil' => $dataLogin[0]["GAMBAR_PROFIL"]
            ];  
          }
        return view('Dashboard/Page/tabelgps',$userData);
    }
}
