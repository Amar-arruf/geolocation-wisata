<?php 
namespace App\Controllers;

use App\Libraries\Oauth2google;
use App\Libraries\Oauth2Instagram;


class Auth extends BaseController {
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
    var_dump($data);
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