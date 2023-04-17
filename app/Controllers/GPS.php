<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Gps as ModelsGps;
use App\Models\UserLogin;
use App\Models\UserToken;

class GPS extends BaseController
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

    $gpsWisata = new ModelsGps();
    $datagpsWisata = $gpsWisata->GetDatas($this->UserId);

    $conn = db_connect();

    $builder = $conn->table('profil_wisata');
    $query = $builder->select('ID')->get()->getResultArray();

    $builder2 = $conn->table('kecamatan');
    $query2 = $builder2->select('KODE_POS')->get()->getResultArray();

    if (is_array($dataLogin)) {
      $userData = [
        'id_user' => $dataLogin[0]["ID_USER"],
        'username' => $dataLogin[0]["USERNAME"],
        'poto_profil' => $dataLogin[0]["GAMBAR_PROFIL"],
        'id_Wisata' => $query,
        'kode_pos' => $query2,
        "data_gps_pager" => $datagpsWisata->paginate(3),
        'pager' => $datagpsWisata->pager
      ];
    }
    return view('Dashboard/Page/tabelgps', $userData);
  }

  public function search()
  {
    $this->Token = new UserToken();
    $getToken = $this->Token->getToken($_COOKIE["access_token"]);

    if (isset($_COOKIE["access_token"])) {
      $this->UserId = $getToken[0]["ID_AKUN"];
    }

    $data = array();
    $dataSearch = new ModelsGps();
    $dataUser = new UserLogin();

    $keyword = $this->request->getGet('keyword');
    $dataSearch->search($keyword);

    $conn = db_connect();

    $builder = $conn->table('profil_wisata');
    $query = $builder->select('ID')->get()->getResultArray();

    $builder2 = $conn->table('kecamatan');
    $query2 = $builder2->select('KODE_POS')->get()->getResultArray();


    $dataUserLogin = $dataUser->getUserLogin($this->UserId);

    $data = [
      'id_user' => $dataUserLogin[0]["ID_USER"],
      'username' => $dataUserLogin[0]["USERNAME"],
      'poto_profil' => $dataUserLogin[0]["GAMBAR_PROFIL"],
      'id_Wisata' => $query,
      'kode_pos' => $query2,
      // pagination   
      'pagergpswisata' => $dataSearch->paginate(3),
      'pager' => $dataSearch->pager
    ];

    return view('Dashboard/Page/tabelgps', $data);
  }

  public function edit($id)
  {
    $getGPSWisata = new ModelsGps();
    $responseEdit = $getGPSWisata->edit($id);

    // check response Edit berhasil di update di database dan terdapat file nya 
    if ($responseEdit) {
      return redirect()->to('/Dashboard/gps')->with('success', 'data berhasil diedit');
    } else {
      return redirect()->to('/Dashboard/gps')->with('failed', 'data gagal diupdate');
    }
  }

  public function hapus($id)
  {
    $delete = new ModelsGps();

    try {
      $boolDel = $delete->hapus($id);

      if ($boolDel) {
        return redirect()->to('Dashboard/gps')->with('success', 'data berhasil di hapus');
      } else {
        return redirect()->to('Dashboard/gps')->with('failed', "terjadi kesalahan data");
      }
    } catch (\Throwable $th) {
      //throw $th;
      return redirect()->to('Dashboard/gps')->with('failed', $th->getMessage());
    }
  }
}
