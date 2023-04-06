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

    public function edit ($id)
    {
      $getWisata = new getLocationDash();
      $responseEdit = $getWisata->edit($id);

     // ambil file gambar dan video dari Form 
      $getGambarFile = $this->request->getFile('gambar');
      $getVideoFile = $this->request->getFile('video');

      

      // check response Edit berhasil di update di database dan terdapat file nya 
      if ($responseEdit) {
          $uploadGambar = null;
          $uploadVideo = null;
        if (strlen($_FILES["gambar"]["name"]) !== 0 ) {
          // upload File Gambar
            $uploadGambar = $this->Cloudinary->Upload($getGambarFile->getTempName(),[
            'public_id' => 'foto_geoloccation/'.$getGambarFile->getBasename()// Nama file di Cloudinary
            ]);
        }
        if (strlen($_FILES["video"]["name"]) !== 0 ) {
           // upload File Video
            $uploadVideo = $this->Cloudinary->Upload($getVideoFile->getTempName(),[
              'public_id' => 'Video_geolocation/'.$getVideoFile->getBasename(),// Nama file di Cloudinary
              'resource_type' => 'video'
          ]);
        }
        
       

        if (!json_decode($uploadGambar) === null & !json_decode($uploadVideo) === null) 
        {
          return redirect()->to('/Dashboard/tabelwisata')->with('success', 'data berhasil di edit');
        } else {
          return redirect()->to('/Dashboard/tabelwisata')->with('success', 'data berhasil di edit');
        }
        return redirect()->to('/Dashboard/tabelwisata')->with('failed', 'data gagal di edit');
      }

       

    }
}
