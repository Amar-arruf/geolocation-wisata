<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\getLocationDash;
use App\Models\UserLogin;

class TabelWisata extends BaseController
{
    public function index()
    {
        //
        $userData = array();
        
        $UserId = '108321858974021678564';
        $db = new UserLogin();
        $dataLogin = $db->getUserLogin($UserId);

        $dataWisata = new getLocationDash();
        $dapatData = $dataWisata->getAllDataWithoutJoin();

      
        if(is_array($dataLogin) && is_array($dapatData)) {
            $userData = [
              'id_user' => $dataLogin[0]["ID_USER"],
              'username' => $dataLogin[0]["USERNAME"],
              'poto_profil' => $dataLogin[0]["GAMBAR_PROFIL"],
              // pagination 
              'pagerWisata' => $dataWisata->paginate(3),
              'pager' => $dataWisata->pager
            ];  
            
          }

        return view('Dashboard/Page/tabelwisata',$userData);
    }

    public function search() 
    {
      $data = array();
      $dataSearch = new getLocationDash();
      $dataUser = new UserLogin();

      $keyword = $this->request->getGet('keyword');
      $dataSearch->search($keyword);
      

      $UserId = '108321858974021678564';
      $dataUserLogin = $dataUser->getUserLogin($UserId);

      $data = [
        'id_user' => $dataUserLogin[0]["ID_USER"],
        'username' => $dataUserLogin[0]["USERNAME"],
        'poto_profil' => $dataUserLogin[0]["GAMBAR_PROFIL"],
        // pagination   
        'pagerWisata' => $dataSearch->paginate(3),
        'pager' => $dataSearch->pager
      ];

      return view('Dashboard/Page/tabelwisata',$data);
    }
}
