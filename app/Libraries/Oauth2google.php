<?php

namespace App\Libraries;

use Google\Client;
use Google\Service\Oauth2;

class Oauth2google
{
   private $client;

   public function __construct()
   {
      $this->client = new Client();
      $this->client->setApplicationName("GeoLocation");
      $this->client->setClientId(getenv('client_id'));
      $this->client->setClientSecret(getenv('secret_key'));
      $this->client->setRedirectUri(base_url('login/auth/google/callback'));
      $this->client->setAccessType("offline");
      $this->client->setPrompt('consent');
      $this->client->addScope('email');
      $this->client->addScope('profile');
   }

   public function getAuthUrl()
   {
      return $this->client->createAuthUrl();
   }

   public function authenticate($code)
   {
      $this->client->fetchAccessTokenWithAuthCode($code);
      $accessToken = $this->client->getAccessToken();
      $userService =  new Oauth2($this->client);
      $userProfile = $userService->userinfo->get();

      return [
         'accessToken' => $accessToken,
         'userProfile' => $userProfile,
      ];
   }

   public function setAccessToken($token)
   {
      $this->client->setAccessToken($token);
   }

   public function RefreshToken($refresh_token)
   {
      return $this->client->fetchAccessTokenWithRefreshToken($refresh_token);
   }
}
