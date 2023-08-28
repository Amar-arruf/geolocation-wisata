<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DataWisata;
use App\Models\getLocationDash;
use App\Models\UserLogin;
use App\Models\UserToken;
use Exception;

class TabelWisata extends BaseController
{
  protected $UserId;
  protected $Token;

  public function index()
  {
    //
    $userData = array();

    $this->Token = new UserToken();
    $getToken = $this->Token->getToken($_COOKIE["access_token"]);

    if (isset($_COOKIE["access_token"])) {
      $this->UserId = $getToken[0]["ID_AKUN"];
    }

    $db = new UserLogin();
    $dataLogin = $db->getUserLogin($this->UserId);

    $dataWisata = new DataWisata();
    $dapatData = $dataWisata->getAllDataUser($this->UserId);


    if (is_array($dataLogin)) {
      $userData = [
        'id_user' => $dataLogin[0]["ID_USER"],
        'username' => $dataLogin[0]["USERNAME"],
        'poto_profil' => $dataLogin[0]["GAMBAR_PROFIL"],
        // pagination 
        'pagerWisata' => $dapatData->paginate(3),
        'pager' => $dapatData->pager
      ];
    }

    return view('Dashboard/Page/tabelwisata', $userData);
  }

  public function search()
  {
    $data = array();
    $dataSearch = new getLocationDash();
    $dataUser = new UserLogin();

    $this->Token = new UserToken();
    $getToken = $this->Token->getToken($_COOKIE["access_token"]);

    if (isset($_COOKIE["access_token"])) {
      $this->UserId = $getToken[0]["ID_AKUN"];
    }

    $keyword = $this->request->getGet('keyword');
    $dataSearch->search($keyword);



    $dataUserLogin = $dataUser->getUserLogin($this->UserId);

    $data = [
      'id_user' => $dataUserLogin[0]["ID_USER"],
      'username' => $dataUserLogin[0]["USERNAME"],
      'poto_profil' => $dataUserLogin[0]["GAMBAR_PROFIL"],
      // pagination   
      'pagerWisata' => $dataSearch->paginate(3),
      'pager' => $dataSearch->pager
    ];

    return view('Dashboard/Page/tabelwisata', $data);
  }

  public function edit($id)
  {
    $getWisata = new getLocationDash();
    $responseEdit = $getWisata->edit($id);

    // ambil file gambar dan video dari Form 
    $getGambarFile = $this->request->getFile('gambar');
    $getVideoFile = $this->request->getFile('video');

    // check response Edit berhasil di update di database dan terdapat file nya 
    if ($responseEdit) {
      $uploadGambar = null;
      $uploadVideo = null;
      if (strlen($_FILES["gambar"]["name"]) !== 0) {
        // hapus file dengan public_id yang lama 
        $getPublic_Id = $this->request->getPost("publicId");

        // hapus file gambar  di Cloudinary
        $hapusfileImage_Old = $this->Cloudinary->deleteAssetsSingleImage($getPublic_Id);

        $responseDelete = json_decode($hapusfileImage_Old, true);


        if ($responseDelete["result"] == "ok") {
          // upload File Gambar
          $uploadGambar = $this->Cloudinary->Upload($getGambarFile->getTempName(), [
            'public_id' => 'foto_geoloccation/' . pathinfo($getGambarFile->getName(), PATHINFO_FILENAME) // Nama file di Cloudinary
          ]);
        }
      }
      if (strlen($_FILES["video"]["name"]) !== 0) {
        // hapus file dengan public_id yang lama
        $getPublic_Id_Video = $this->request->getPost("publicIdVideo");

        $hapusfileVideo_Old = $this->Cloudinary->deleteAssetsSingleVideo($getPublic_Id_Video);

        $responseDeleteVideo = json_decode($hapusfileVideo_Old, true);

        if ($responseDeleteVideo["result"] == "ok") {
          // upload File Video
          $uploadVideo = $this->Cloudinary->Upload($getVideoFile->getTempName(), [
            'public_id' => 'Video_geolocation/' . pathinfo($getVideoFile->getName(), PATHINFO_FILENAME), // Nama file di Cloudinary
            'resource_type' => 'video'
          ]);
        } else {
          // upload File Video
          $uploadVideo = $this->Cloudinary->Upload($getVideoFile->getTempName(), [
            'public_id' => 'Video_geolocation/' . pathinfo($getVideoFile->getName(), PATHINFO_FILENAME), // Nama file di Cloudinary
            'resource_type' => 'video'
          ]);
        }
      }



      if (json_encode($uploadGambar) !== null || json_encode($uploadVideo) !== null) {
        return redirect()->to('/Dashboard/tabelwisata')->with('success', 'data berhasil di edit dan upload gambar atau upload video');
      } else {
        return redirect()->to('/Dashboard/tabelwisata')->with('success', 'data berhasil di edit');
      }
      return redirect()->to('/Dashboard/tabelwisata')->with('failed', 'data gagal di edit');
    }
  }

  public function delete($id, $publicIdImg, $publicIdVid)
  {

    // delete data uploader terlebih dahulu
    $db      = \Config\Database::connect();
    $builder = $db->table('uploader');

    $getDataUpload = $builder->get()->getResultArray();

    // check jika data uploader bukan nol
    if (count($getDataUpload) !== 0) {
      $builder->delete(['ID' => $id]);
    }



    $delete = new getLocationDash();


    try {
      $boolDel = $delete->hapus($id);

      if ($boolDel == true) {
        // hapus di Cloaudinary 
        if ((strlen($publicIdImg) !== 0) && (strlen($publicIdVid) !== 0)) {
          // hapus file gambar  di Cloudinary
          $publicIdImg = 'foto_geoloccation/' . $publicIdImg;
          $hapusfileImage_Old = $this->Cloudinary->deleteAssetsSingleImage($publicIdImg);
          // hapus file Video di Cloudinary
          $publicIdVid = "Video_geolocation/" . $publicIdVid;
          $hapusfileVideo = $this->Cloudinary->deleteAssetsSingleVideo($publicIdVid);
          return redirect()->to('Dashboard/tabelwisata')->with('success', 'data berhasil di hapus');
        }
        if (strlen($publicIdImg) !== 0) {
          // hapus file gambar  di Cloudinary
          $publicIdImg = 'foto_geoloccation/' . $publicIdImg;
          $hapusfileImage_Old = $this->Cloudinary->deleteAssetsSingleImage($publicIdImg);
          return redirect()->to('Dashboard/tabelwisata')->with('success', 'data berhasil di hapus');
        }
        if (strlen($publicIdVid) !== 0) {
          // hapus file Video di Cloudinary
          $publicIdVid = "Video_geolocation/" . $publicIdVid;
          $hapusfileVideo = $this->Cloudinary->deleteAssetsSingleVideo($publicIdVid);
          return redirect()->to('Dashboard/tabelwisata')->with('success', 'data berhasil di hapus');
        }
      }

      if ($boolDel != true) {
        $message = throw new Exception('terjadi kesalahan Data');

        return redirect()->to('Dashboard/tabelwisata')->with('failed', $message);
      }
    } catch (\Throwable $th) {
      // throw $th->getMessage();
      return redirect()->to('Dashboard/tabelwisata')->with('failed', $th->getMessage());
    }
  }
}
