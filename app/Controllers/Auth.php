<?php 
namespace App\Controllers;

use App\Libraries\Oauth2google;
use App\Libraries\Oauth2Instagram;
use App\Models\UserLogin;
use App\Models\UserToken;

$db = db_connect();


class Auth extends BaseController {

  public $Bool;
  public $BoolToken;

  public function login() { 
    
    return view('webComponent/formLogin');
  }

  // authentification genereted code authorization dengan google
  public function loginGoogle () {
    $googleOauth = new Oauth2google();
    return redirect()->to($googleOauth->getAuthUrl());
  }
  // menukarkan code authorization ke akses token
  public function  googleCallback() {
    $googleOauth = new Oauth2google();
    $data = $googleOauth->authenticate($this->request->getVar('code'));
    /*
      Note: simpan access token dan user Profile ke dalam database
    */
    $userLogin = new UserLogin();
    $userToken = new UserToken();

    $getuserLogin = $userLogin->getUserLogin(json_decode(json_encode($data["userProfile"]["id"])));

   // check gtuserLogin is_Array 

   if (is_array($getuserLogin)) {
    $this->Bool = json_decode(json_encode($data["userProfile"]["id"])) === $getuserLogin[0]["ID_USER"];
   }
     // check jika ada username data tidak di tambahkan ke database
    if($this->Bool) {
      echo "data sudah ada";

      var_dump($getuserLogin);

    } else {
      // echo "data perlu ditambahkan";
      // var_dump(json_decode(json_encode($data['userProfile']), true));

       $message = $userLogin->addUser(json_decode(json_encode($data["userProfile"]), true));
       echo $message ;  
    }

    $getTokenGoogel = $userToken->getTokenUser(json_decode(json_encode($data["userProfile"]['id'])));

    // check jika ada token di database dan token accses tidak sama  maka update
    if (isset($getTokenGoogel) && $data["accessToken"]["access_token"] !== $getTokenGoogel[0]["ACCESS_TOKEN"]) {
      echo "data token sudah dan diupdate!";

      $updateToken = $userToken->updateTokenDB(json_decode(json_encode($data["userProfile"]['id'])),$data["accessToken"]["access_token"]);

      if($updateToken === "token berhasil di update") {
        var_dump($getTokenGoogel);
      } else {
        echo "gagal diupdate token";
      }
    }  else {
      //  simpan ke database
      $message = $userToken->addToken($data["accessToken"], json_decode(json_encode($data["userProfile"]["id"])));
      echo $message;
    }
  }

  // authentification ke Instagram dan mendapatkan code authorization dengan Instagram
  public function loginInstagram () 
  {
    $IGOauth = new Oauth2Instagram();
    // jalankan metode Authorization pada class IGOauth untuk mendapatkan Code authorization
    $IGOauth->Authorization();
  }

  public function instagramCallback() 
  {
    $IGOauth = new Oauth2Instagram();
    // jalankan metode authorization untuk menukarkan kode ke dalam acces tokken 
    $IGOauth->Authorization();
  }
}