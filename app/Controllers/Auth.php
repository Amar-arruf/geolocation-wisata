<?php 
namespace App\Controllers;

use App\Libraries\Oauth2google;


class Auth extends BaseController {
  public function login() { 
    
    return view('webComponent/formLogin');
  }

  public function loginGoogle () {
    $googleOauth = new Oauth2google();
    return redirect()->to($googleOauth->getAuthUrl());
  }

  public function  googleCallback() {
    $googleOauth = new Oauth2google();
    $data = $googleOauth->authenticate($this->request->getVar('code'));
    /*
      Note: simpa access token dan user Profile ke dalam database dan jangan pernah kedalam session di php 
    */
    var_dump($data);
  }
}