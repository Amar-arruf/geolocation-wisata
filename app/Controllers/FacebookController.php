<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class FacebookController extends BaseController
{
  public function deleteUserData()
  {
    $signed_request = $this->request->getPost('signed_request');
    $data = $this->parse_signed_request($signed_request);
    $user_id = $data['user_id'];
    $id_Deletion = 'DELETION4523';

    // start data deletion 

    $status_url = 'https://site.com/deletion?id=' . $id_Deletion;
    $confirm_code = $id_Deletion;

    $data = array(
      'url' => $status_url,
      'confirmation_code' => $confirm_code
    );

    return json_encode($data);
  }

  private function parse_signed_request($signed_request)
  {
    list($encoded_sig, $payload) = explode('.', $signed_request, 2);

    $secret = getenv('app_secret'); // Use your app secret here

    // decode the data
    $sig = $this->base64_url_decode($encoded_sig);
    $data = json_decode($this->base64_url_decode($payload), true);

    // confirm the signature
    $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
    if ($sig !== $expected_sig) {
      error_log('Bad Signed JSON signature!');
      return null;
    }

    return $data;
  }

  private function base64_url_decode($input)
  {
    return base64_decode(strtr($input, '-_', '+/'));
  }
}
