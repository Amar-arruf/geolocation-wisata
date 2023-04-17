<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HariOperasi;
use App\Models\UserLogin;
use App\Models\UserToken;

class HariOperasional extends BaseController
{
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
    $getHariOperasi = new HariOperasi();
    $getDataOperasional = $getHariOperasi->GetDatasJamOperasi($this->UserId);

    $conn = db_connect();

    if (is_array($dataLogin)) {
      $userData = [
        'id_user' => $dataLogin[0]["ID_USER"],
        'username' => $dataLogin[0]["USERNAME"],
        'poto_profil' => $dataLogin[0]["GAMBAR_PROFIL"],
        'kode_pos' => $conn->table('kecamatan')->select('KODE_POS')->get()->getResultArray(),
        'kode_uploader' => $conn->table('uploader')->select('KODE_UPLOADER')->get()->getResultArray(),
        'id_wisata' => $conn->table('profil_wisata')->select('ID')->get()->getResultArray(),
        'kode_jam' => $conn->table('buka_tutup_wisata')->select('KODE_JAM_OPERASI')->get()->getResultArray(),
        'PagerHariOperasional' => $getDataOperasional->paginate(3),
        'pager' => $getDataOperasional->pager
      ];
    }

    return view('Dashboard/Page/tabeloperasional', $userData);
  }

  public function search()
  {
    $this->Token = new UserToken();
    $getToken = $this->Token->getToken($_COOKIE["access_token"]);

    if (isset($_COOKIE["access_token"])) {
      $this->UserId = $getToken[0]["ID_AKUN"];
    }

    $dataSearch = new HariOperasi();

    $keyword = $this->request->getGet('keyword');
    $dataSearch->search($keyword);

    $conn = db_connect();


    $db = new UserLogin();
    $dataLogin = $db->getUserLogin($this->UserId);

    if (is_array($dataLogin)) {
      $userData = [
        'id_user' => $dataLogin[0]["ID_USER"],
        'username' => $dataLogin[0]["USERNAME"],
        'poto_profil' => $dataLogin[0]["GAMBAR_PROFIL"],
        'kode_pos' => $conn->table('kecamatan')->select('KODE_POS')->get()->getResultArray(),
        'kode_uploader' => $conn->table('uploader')->select('KODE_UPLOADER')->get()->getResultArray(),
        'id_wisata' => $conn->table('profil_wisata')->select('ID')->get()->getResultArray(),
        'kode_jam' => $conn->table('buka_tutup_wisata')->select('KODE_JAM_OPERASI')->get()->getResultArray(),
        'PagerHariOperasional' => $dataSearch->paginate(3),
        'pager' => $dataSearch->pager
      ];
    }
    return view('Dashboard/Page/tabeloperasional', $userData);
  }

  public function edit($id)
  {
    $getDaysOperation = new HariOperasi();

    $responseEdit = $getDaysOperation->edit($id);

    // check response Edit berhasil di update di database dan terdapat file nya 
    if ($responseEdit) {
      return redirect()->to('/Dashboard/harioperasi')->with('success', 'data berhasil diedit');
    } else {
      return redirect()->to('/Dashboard/harioperasi')->with('failed', 'data gagal diupdate');
    }
  }

  public function delete($id)
  {
    $delete = new HariOperasi();

    try {
      $boolDel = $delete->hapus($id);

      if ($boolDel) {
        return redirect()->to('/Dashboard/harioperasi')->with('success', 'data berhasil dihapus');
      } else {
        return redirect()->to('/Dashboard/harioperasi')->with('failed', 'terjadi kesalahan data');
      }
    } catch (\Throwable $th) {
      //throw $th;
      return redirect()->to('/Dashboard/harioperasi')->with('failed', $th->getMessage());
    }
  }
}
