<?php

namespace App\Libraries;

use League\OAuth2\Client\Provider\Instagram;

class Oauth2instagram
{
  private $private;

  private $options;

  private $session;



  public function __construct()
  {
    $this->private = new Instagram([
      'clientId'          => getenv('id_apk'),
      'clientSecret'      => getenv('secret_key_apk'),
      'redirectUri'       => base_url('login/auth/ig/callback'),
      'graphApiVersion'   => 'v3.0',
      'host'              => 'https://api.instagram.com',  // Optional,  secara default https://api.instagram.com
      'graphHost'         => 'https://graph.instagram.com' // Optional,  secara default https://graph.instagram.com
    ]);
  }

  public function Authorization()
  {
    $this->session = \Config\Services::session();

    if (!isset($_GET['code'])) {

      $this->options = [
        'scope' => ['user_profile', 'user_media']
      ];

      // jika tidak mendapatkan authoization code
      $authUrl = $this->private->getAuthorizationUrl($this->options);
      $oauth2state = ['state' => $this->private->getState()];
      $this->session->set($oauth2state);
      header('Location: ' . $authUrl);
      exit;
    }


    // check kembali state sebelumnya sudah simpan untuk mengurangi serangan CSRF 
    elseif (empty($_GET['state']) || ($_GET['state'] != $this->session->get('state'))) {
      $this->session->remove('state');
      exit('gagal authentifikasi');
      header('Location:. ' . base_url('/login'));
    } else {
      // mencoba untuk mendapatkan access token (menggunakan authorization code )
      $token = $this->private->getAccessToken('authorization_code', [
        'code' => $_GET['code']
      ]);

      // tukarkan refresh_token umur yang panjang dengan durasi 90 hari
      $longLivedToken = $this->requestTokenLonglive($token);

      // setelah mendapatkan token kamu dapat melihat users profile data 
      try {

        // We got an access token, let's now get the user's details
        $user = $this->private->getResourceOwner($longLivedToken);



        // Use these details to create a new profile
        return [
          "user" => $user,
          "token" => $longLivedToken
        ];
      } catch (\Exception $e) {

        // gagal mendapatkan 
        return exit('tidak bisa mendapatkan detail user');
      }

      // Use this to interact with an API on the users behalf
      echo $token->getToken();
    }
  }

  public function requestTokenLonglive($access_token)
  {
    $longLivedToken = $this->private->getLongLivedAccessToken($access_token);
    return $longLivedToken;
  }
}
