<?php

namespace App\Libraries;

use League\OAuth2\Client\Provider\Facebook;

class Oauth2facebook
{
  protected $provider;
  protected $session;
  protected $options;

  public function __construct()
  {
    $this->provider = new Facebook([
      'clientId'          => getenv('app_id'),
      'clientSecret'      => getenv('app_secret'),
      'redirectUri'       => base_url('/login/auth/fb/callback'),
      'graphApiVersion'   => 'v2.10',
    ]);
  }

  public function Authorization()
  {
    $this->session = \Config\Services::session();

    if (!isset($_GET['code'])) {

      $this->options = [
        'scope' => [
          'public_profile',
          'email',
        ]
      ];

      // jika tidak mendapatkan authoization code
      $authUrl = $this->provider->getAuthorizationUrl($this->options);
      $oauth2state = ['state' => $this->provider->getState()];
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
      $token = $this->provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
      ]);

      // tukarkan refresh_token umur yang panjang dengan durasi 90 hari
      $longLivedToken = $this->requestTokenLonglive($token);

      // setelah mendapatkan token kamu dapat melihat users profile data 
      try {

        // We got an access token, let's now get the user's details
        $user = $this->provider->getResourceOwner($longLivedToken);



        // Use these details to create a new profile
        return [
          "user" => $user,
          "token" => $longLivedToken,
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
    $longLivedToken = $this->provider->getLongLivedAccessToken($access_token);
    return $longLivedToken;
  }
}
