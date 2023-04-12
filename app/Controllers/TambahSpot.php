<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserLogin;
use App\Models\UserToken;

class TambahSpot extends BaseController

{
  protected $conn;
  protected $UserId;
  protected $Token;
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

    $this->conn = db_connect();
    $query = $this->conn->table('profil_wisata')
      ->select("
        profil_wisata.ID,
        profil_wisata.NAMA,
        profil_wisata.VIDEO,
        profil_wisata.DESKRIPSI_TEXT,
        profil_wisata.GAMBAR,
        gps.LONGITUDE,
        gps.ALTITUDE")
      ->join('gps', "gps.ID = profil_wisata.ID")
      ->get();

    $result = $query->getResult('array');

    if (is_array($dataLogin)) {
      $userData = [
        'id_user' => $dataLogin[0]["ID_USER"],
        'username' => $dataLogin[0]["USERNAME"],
        'poto_profil' => $dataLogin[0]["GAMBAR_PROFIL"],
        'data_wisata' => $result
      ];
    }

    return view('Dashboard/Page/tambahspot', $userData);
  }

  public function add()
  {
    $this->UserId = '108321858974021678564';
    $this->conn = db_connect();
    // tambah tabel profil wisata
    $datawisata = [
      "ID" => $_POST["id"],
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
    $new_number = intval(substr($getIDLast[0]["KODE"], 3)) + 1;
    $newidgps = 'GPS' . $new_number;

    $dataGPS = [
      "KODE" => $newidgps,
      "ID" => $_POST["id"],
      "KODE_POS" => "62381",
      "LONGITUDE" => $_POST["longitude"],
      "ALTITUDE" => $_POST["latitude"]
    ];

    // tambah data gps wisata
    $responseaddGPS = $this->conn->table("gps")->insert($dataGPS);

    // tambah data uploader

    // generete ID
    $getIdLastuploader = $this->conn->table('uploader')->select("KODE_UPLOADER")->orderBy('KODE_UPLOADER', 'DESC')->limit(1)->get()->getResultArray();

    $new_numUp = intval(substr($getIdLastuploader[0]["KODE_UPLOADER"], 2)) + 1;

    $newidup = 'UP' . $new_numUp;

    $getUserLogin = new UserLogin();
    $getData = $getUserLogin->getUserLogin($this->UserId);

    $dataUploade = [
      "KODE_UPLOADER" => $newidup,
      "ID_AKUN" => null,
      "USER_ID" => $getData[0]["ID_USER"],
      "ID" => $_POST["id"],
      "WISATA" => $_POST["nama"]
    ];
    // tambah data user id
    $responseAddUpload = $this->conn->table("uploader")->insert($dataUploade);

    // tambah data hari operasional

    // generete ID 

    $getIdLastDayOperasi = $this->conn->table('hari_operasional_wisata')->select("ID_OPERASIONAL")->orderBy('ID_OPERASIONAL', 'DESC')->limit(1)->get()->getResultArray();
    $new_numDO = intval(substr($getIdLastDayOperasi[0]["ID_OPERASIONAL"], 2)) + 1;
    $newIdOP = "OP" . $new_numDO;

    $dataUpDO = [
      "ID_OPERASIONAL" => $newIdOP,
      "KODE_POS" => null,
      "KODE_UPLOADER" => $newidup,
      "ID" => $_POST["id"],
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
