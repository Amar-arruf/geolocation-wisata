<?php

namespace App\Controllers;

use App\Libraries\Oauth2instagram;
use App\Libraries\Oauth2facebook;
use App\Libraries\Oauth2google;
use App\Models\Akun;
use App\Models\UserLogin;
use App\Models\UserToken;

$db = db_connect();


class Auth extends BaseController
{

  public $Bool;
  public $BoolToken;
  public $session;

  public function login()
  {

    return view('webComponent/formLogin');
  }
  // auth admin 
  public function auth()
  {
    $model = new Akun();

    $username = $this->request->getPost("username");
    $password = $this->request->getPost("password");

    $data = $model->getakun($username);

    // check data is valid
    if (is_array($data) || is_object($data)) {
      $this->session = \Config\Services::session();

      // check data password = 
      $passdataDB = $data["PASSWORD"];
      if ($password === $passdataDB) {
        $ses_data = [
          'user_id' => $data["ID_AKUN"],
          'username' => $data["USERNAME"]
        ];

        $this->session->set($ses_data);

        // redirect ke Dashboard

        return redirect()->to("admin/dashboardadmin");
      } else {
        return redirect()->to('/login')->with("message", "Paswword Salah");
      }
    } else {
      return redirect()->to("/login")->with("message", "gagal login silahkan check Username");
    }
  }
  // authentification genereted code authorization dengan google
  public function loginGoogle()
  {
    if (isset($_COOKIE['access_token'])) {
      return redirect('Dashboard/dashboard');
    } else {
      $googleOauth = new Oauth2google();
      return redirect()->to($googleOauth->getAuthUrl());
    }
  }
  // menukarkan code authorization ke akses token
  public function  googleCallback()
  {
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
    if ($this->Bool) {
      echo "data sudah ada";

      var_dump($getuserLogin);
    } else {
      // echo "data perlu ditambahkan";
      // var_dump(json_decode(json_encode($data['userProfile']), true));

      $message = $userLogin->addUser(json_decode(json_encode($data["userProfile"]), true), "Google");
      echo $message;
    }

    $getTokenGoogel = $userToken->getTokenUser(json_decode(json_encode($data["userProfile"]['id'])));
    $getToken = $userToken->getToken(json_decode(json_encode($data["accessToken"]["access_token"])));

    // check jika ada token di database dan token accses tidak sama  maka update
    if (is_array($getTokenGoogel) && $data["accessToken"]["access_token"] !== $getTokenGoogel[0]["ACCESS_TOKEN"]) {

      $updateToken = $userToken->updateTokenDB(json_decode(json_encode($data["userProfile"]["id"])), $data["accessToken"]["access_token"], $data["accessToken"]["refresh_token"], 'Google');

      if ($updateToken === "token berhasil di update") {
        echo "data token sudah dan diupdate!";
      } else {
        echo "gagal diupdate token";
      }
    } else {
      //  simpan ke database
      $message = $userToken->addToken($data["accessToken"], json_decode(json_encode($data["userProfile"]["id"])), "Google");
      echo $message;
    }

    // check token sudah di update  dan ada di database
    if (is_array($getTokenGoogel) && is_array($getuserLogin)) {
      // check statusnya 
      if ($getuserLogin[0]["STATUS"] == "aktif") {
        setcookie('access_token', $data["accessToken"]["access_token"], time() + 3600, "/", '');
        return redirect('Dashboard/dashboard');
      } else {
        return redirect()->to('/login')->with("failed", "gagal login anda dinonaktifkan oleh admin");
      }
    } else {
      setcookie('access_token', $data["accessToken"]["access_token"], time() + 3600, "/", '');
      return redirect('Dashboard/dashboard');
    }
  }

  // authentification ke Instagram dan mendapatkan code authorization dengan Instagram
  public function loginInstagram()
  {
    if (isset($_COOKIE["access_token"])) {
      return redirect('Dashboard/dashboard');
    } else {
      $IGOauth = new Oauth2instagram();
      // jalankan metode Authorization pada class IGOauth untuk mendapatkan Code authorization
      $IGOauth->Authorization();
    }
  }

  public function instagramCallback()
  {
    $IGOauth = new Oauth2instagram();
    // jalankan metode authorization untuk menukarkan kode ke dalam acces tokken 
    $data = $IGOauth->Authorization();

    var_dump($data["token"]);


    $userLoginIG = new UserLogin();
    $userTokenIG = new UserToken();

    // Simpan ke database user account dan Token 

    $getUserID = $userLoginIG->getUserLogin($data["user"]->toArray()["id"]);
    $getUserToken =  $userTokenIG->getTokenUser($data["user"]->toArray()["id"]);


    // check kembalian dari variabel $getUserID
    if (is_array($getUserID)) {
      echo "data sudah ada";
    } else {
      $addUser = $userLoginIG->addUser($data["user"]->toArray(), "Instagram");
      echo $addUser;
    }

    // check jika ada token di database dan token accses tidak sama  maka update

    if (is_array($getUserToken) && $data["token"]->getToken() !== $getUserToken[0]["ACCESS_TOKEN"]) {

      $updateTokenIg = $userTokenIG->updateTokenDB($data["user"]->toArray()["id"], $data["token"]->getToken(), $data['token']->getRefreshToken(), 'Instagram');

      if ($updateTokenIg === "token berhasil di update") {
        echo "data token FB Sudah diupdate!";
        var_dump($getUserToken);
      } else {
        var_dump("token gagal di update");
      }
    } else {
      $addToken = $userTokenIG->addToken($data["token"], $data["user"]->toArray()["id"], "Instagram");
      echo $addToken;
    }

    // check token sudah di update  dan ada di database
    if (is_array($getUserToken) && is_array($getUserID)) {
      // check status user ID nya
      if ($getUserID[0]["STATUS"] == "aktif") {
        setcookie('access_token', $data["token"]->getToken(), time() + 3600, "/", '');
        return redirect('Dashboard/dashboard');
      } else {
        return redirect()->to('/login')->with("failed", "gagal login anda dinonaktifkan oleh admin");
      }
    } else {
      setcookie('access_token', $data["token"]->getToken(), time() + 3600, "/", '');
      return redirect('Dashboard/dashboard');
    }
  }

  public function loginFacebook()
  {
    if (isset($_COOKIE['access_token'])) {
      return redirect("Dashboard/dashboard");
    } else {
      $FbOauth2 = new Oauth2facebook();
      // dapatkan authorize code dari facebook
      $FbOauth2->Authorization();
    }
  }

  public function FBcallback()
  {
    $fbOauth2 = new Oauth2facebook();
    $data = $fbOauth2->Authorization();
    // simpan user dan token

    $userLoginFB = new UserLogin();
    $userTokenFB = new UserToken();

    // Simpan ke database user account dan Token 

    $getUserID = $userLoginFB->getUserLogin($data["user"]->toArray()["id"]);
    $getUserToken =  $userTokenFB->getTokenUser($data["user"]->toArray()["id"]);


    // check kembalian dari variabel $getUserID
    if (is_array($getUserID)) {
      echo "data sudah ada";
    } else {
      $addUser = $userLoginFB->addUser($data["user"]->toArray(), "Facebook");
      echo $addUser;
    }

    // check jika ada token di database dan token accses tidak sama  maka update

    if (is_array($getUserToken) && $data["token"]->getToken() !== $getUserToken[0]["ACCESS_TOKEN"]) {

      $updateTokenFB = $userTokenFB->updateTokenDB($data["user"]->toArray()["id"], $data["token"]->getToken(), $data['token']->getRefreshToken(), 'Facebook');

      if ($updateTokenFB === "token berhasil di update") {
        echo "data token FB Sudah diupdate!";
        var_dump($getUserToken);
      } else {
        var_dump("token gagal di update");
      }
    } else {
      $addToken = $userTokenFB->addToken($data["token"], $data["user"]->toArray()["id"], "Facebook");
      echo $addToken;
    }

    // check token sudah di update  dan ada di database
    if (is_array($getUserToken) && is_array($getUserID)) {
      // check status user ID nya
      if ($getUserID[0]["STATUS"] == "aktif") {
        setcookie('access_token', $data["token"]->getToken(), time() + 3600, "/", '');
        return redirect('Dashboard/dashboard');
      } else {
        return redirect()->to('/login')->with("failed", "gagal login anda dinonaktifkan oleh admin");
      }
    } else {
      setcookie('access_token', $data["token"]->getToken(), time() + 3600, "/", '');
      return redirect('Dashboard/dashboard');
    }
  }

  public function logout()
  {
    setcookie("access_token", "", time() - 3600);
    return redirect()->to('/login');
  }
}
