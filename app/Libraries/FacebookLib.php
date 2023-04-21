<?php

namespace App\Libraries;

use Facebook\Facebook;


class FacebookLib
{
  protected $fb;



  public function __construct()
  {
    $this->fb = new Facebook([
      'app_id' => getenv('app_id'),
      'app_secret' => getenv('app_secret'),
      'default_graph_version' => 'v16.0',
    ]);
  }

  public function login()
  {
    $helper = $this->fb->getRedirectLoginHelper();

    $permissions = ['email', 'public_profile'];

    $loginUrl = $helper->getLoginUrl('https://geolocationswisata.com/facebook/callback', $permissions);

    redirect($loginUrl);
  }

  public function authenticate()
  {
    $helper = $this->fb->getRedirectLoginHelper();

    try {
      //code...
      $accessToken = $helper->getAccessToken();
      $response = $this->fb->get('/me?fields=id,name,picture', $accessToken);
      $user = $response->getGraphUser();
      $data = [
        "id" => $user->getId(),
        "username" => $user->getName(),
        "email" => $user->getEmail(),
        "accessToken" => $accessToken // short live accessToken
      ];
      var_dump($data);
    } catch (\Facebook\Exceptions\FacebookResponseException $th) {
      echo "graph mengembalilan error :" . $th->getMessage();
      exit;
    } catch (\Facebook\Exceptions\FacebookSDKException $th) {
      echo "Facebook SDK mengembalikan error : " . $th->getMessage();
      exit;
    }
  }

  public function requestLongliveToken()
  {
    $helper = $this->fb->getRedirectLoginHelper();

    //code...
    $accessToken = $helper->getAccessToken();

    if (!$accessToken->isLongLived()) {
      try {
        // lakukan sesuatu yang request token long lived
        $oAuth2Client = $this->fb->getOAuth2Client();
        $longLiveAccessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
      } catch (\Facebook\Exceptions\FacebookSDKException $th) {
        echo "gagal mendapatkan long-lived access token :" . $th->getMessage();
      }

      // tampilkan atau updated token di database
      var_dump($longLiveAccessToken);
    }
  }

  public function requestTokenLongLived()
  {
    $helper = $this->fb->getRedirectLoginHelper();

    //code...
    $accessToken = $helper->getAccessToken();

    if ($accessToken->isExpired()) {
      try {
        // lakukan sesuatu yang request token long lived
        $oAuth2Client = $this->fb->getOAuth2Client();
        $longLiveAccessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
      } catch (\Facebook\Exceptions\FacebookSDKException $th) {
        echo "gagal mendapatkan long-lived access token :" . $th->getMessage();
      }

      // tampilkan atau updated token di database
      var_dump($longLiveAccessToken);
    }
  }
}
