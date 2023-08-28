<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataDashboardUser;
use App\Models\UserLogin;
use App\Models\UserToken;

use function App\Helpers\generated_random_id;

class TambahSpot extends BaseController

{
  protected $conn;
  protected $UserId;
  protected $Token;
  protected $pageToken;


  public function addPost($typeLogin, $url, $message)
  {

    // get Token Login dan page Token
    $token = new UserToken();
    $dapatToken = $token->getToken($_COOKIE["access_token"]);
    $options = [
      'baseURI' => getenv('Host_Graph'),
    ];
    $client = \Config\Services::curlrequest($options);

    if (is_array($dapatToken)) {
      // lakukan request
      $getResponse = $client->request("GET", '/' . getenv('Page_Id'), [
        'query' => [
          'fields' => 'access_token',
          'access_token' => $dapatToken[0]["ACCESS_TOKEN"]
        ]
      ]);
      $Page_Token = json_decode(json_decode($getResponse->getJSON()));
      $this->pageToken = $Page_Token->access_token;
    }

    // tambahkan ke posting  Facebook
    if ($typeLogin === "Facebook") {
      // posting facebook
      $getResponse = $client->request("POST", '/' . getenv('Page_Id') . '/photos', [
        'query' => [
          "url" => $url,
          "message" => $message,
          'access_token' => $this->pageToken
        ]
      ]);

      // check  jika API return JSON
      if (is_object(json_decode(json_decode($getResponse->getJSON())))) {
        // check if mempunyai attribute ID
        $obj = json_decode(json_decode($getResponse->getJSON()));
        if (isset($obj->id)) {
          return "sukses menambahkan postingan";
        } else {
          return null;
        }
      } else {
        return null;
      }
    } else {
      return null;
    }
  }

  public function getUserId()
  {
    $this->Token = new UserToken();
    $getToken = $this->Token->getToken($_COOKIE["access_token"]);

    if (isset($_COOKIE["access_token"])) {
      $this->UserId = $getToken[0]["ID_AKUN"];
    }
    return $this->UserId;
  }

  public function index()
  {
    //
    $this->Token = new UserToken();
    $getToken = $this->Token->getToken($_COOKIE["access_token"]);

    if (isset($_COOKIE["access_token"])) {
      $this->UserId = $getToken[0]["ID_AKUN"];
    }


    $db = new UserLogin();
    $dataLogin = $db->getUserLogin($this->UserId);

    $data = new DataDashboardUser();
    $getData =  $data->getAllDataUser($this->UserId);

    if (is_array($dataLogin)) {
      $userData = [
        'id_user' => $dataLogin[0]["ID_USER"],
        'username' => $dataLogin[0]["USERNAME"],
        'poto_profil' => $dataLogin[0]["GAMBAR_PROFIL"],
        'data_wisata' => $getData
      ];
    }

    return view('Dashboard/Page/tambahspot', $userData);
  }

  public function add()
  {
    helper('id_helper');
    $idWisata = 'W' . generated_random_id();

    $getIduser = $this->getUserId();
    $this->conn = db_connect();
    // tambah tabel profil wisata
    $datawisata = [
      "ID" => $idWisata,
      "NAMA" => $_POST["nama"],
      "VIDEO" => null,
      "DESKRIPSI_TEXT" => null,
      "GAMBAR" => $_FILES["image"]["name"]
    ];
    // tambah data profil wisata

    $responseAddWisata = $this->conn->table("profil_wisata")->insert($datawisata);

    // tambah data gps

    // ID KodeGPS
    $getIDLast = $this->conn->table('gps')->select("KODE")->orderBy("KODE", 'DESC')->limit(1)->get()->getResultArray();

    // generete ID


    $dataGPS = [
      "KODE" => 'GPS' . generated_random_id(),
      "ID" => $idWisata,
      "KODE_POS" => "62381",
      "LONGITUDE" => $_POST["longitude"],
      "ALTITUDE" => $_POST["latitude"]
    ];

    // tambah data gps wisata
    $responseaddGPS = $this->conn->table("gps")->insert($dataGPS);

    // tambah data uploader

    // generete ID
    $getIdLastuploader = $this->conn->table('uploader')->select("KODE_UPLOADER")->orderBy('KODE_UPLOADER', 'DESC')->limit(1)->get()->getResultArray();

    $newidup = 'UP' . generated_random_id();


    $getUserLogin = new UserLogin();
    $getDataUser = $getUserLogin->getUserLogin($getIduser);

    $dataUploade = [
      "KODE_UPLOADER" => $newidup,
      "USER_ID" => $getDataUser[0]["ID_USER"],
      "ID" => $idWisata,
      "WISATA" => $_POST["nama"]
    ];
    // tambah data user id
    $responseAddUpload = $this->conn->table("uploader")->insert($dataUploade);

    // tambah data hari operasional

    // generete ID 
    $getIdLastDayOperasi = $this->conn->table('hari_operasional_wisata')->select("ID_OPERASIONAL")->orderBy('ID_OPERASIONAL', 'DESC')->limit(1)->get()->getResultArray();




    $dataUpDO = [
      "ID_OPERASIONAL" => 'OP' . generated_random_id(),
      "KODE_POS" => null,
      "KODE_UPLOADER" => $newidup,
      "ID" => $idWisata,
      "KODE_JAM_OPERASI" => '1M',
      "HARI_OPERASIONAL" => '7 hari'
    ];

    // tambah data hari operasional
    $responseADDDayOP =  $this->conn->table('hari_operasional_wisata')->insert($dataUpDO);

    // setnama Cookie
    $nama_cookie = "upload_cookie";

    $getGambar = $this->request->getFile("image");

    $publicId = pathinfo($getGambar->getName(), PATHINFO_FILENAME);

    // mengupload ke dalam Cloaudinary
    $optionConf = [
      "public_id" => 'foto_geoloccation/' . $publicId,
    ];

    $responseUploadImageToCloaud = $this->Cloudinary->Upload($getGambar->getTempName(), $optionConf);

    // upload ke postingan facebook
    // $getAkun = $this->Token->getToken($_COOKIE["access_token"]);
    // $getTypeLogin = $getAkun[0]["LOGIN_TYPE"];
    // if ($getTypeLogin === "Facebook") {
    //   $getPostMessage = $this->request->getPost("posting");
    //   $AddPost = $this->addPost($getTypeLogin, $responseUploadImageToCloaud["secure_url"], $getPostMessage . " " . base_url());
    // }


    if ($responseAddWisata && $responseaddGPS && $responseAddUpload && $responseADDDayOP && ($responseUploadImageToCloaud && !is_null($responseUploadImageToCloaud))) {
      // set cookie dan check Cookie dengan nama "upload_cookie"
      if (!isset($_COOKIE["upload_cookie"])) {
        $cookie_value = 1;
        setcookie($nama_cookie, $cookie_value, strtotime('today midnight'), "/");
      } else {
        $cookie_value = ++$_COOKIE["upload_cookie"];
        setcookie($nama_cookie, $cookie_value, strtotime('today midnight'), "/");
      }

      return redirect()->to('/Dashboard/tambahsport');
    }
  }
}
