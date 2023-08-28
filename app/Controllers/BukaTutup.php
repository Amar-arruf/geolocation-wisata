<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BukaTutup as ModelsBukaTutup;
use App\Models\UserLogin;
use App\Models\UserToken;

class BukaTutup extends BaseController
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

    $opencloseWisata = new ModelsBukaTutup();
    $opencloseWisata->GetDatasJamOperasi();


    if (is_array($dataLogin)) {
      $userData = [
        'id_user' => $dataLogin[0]["ID_USER"],
        'username' => $dataLogin[0]["USERNAME"],
        'poto_profil' => $dataLogin[0]["GAMBAR_PROFIL"],
        'pageropenclose' => $opencloseWisata->paginate(3),
        'pager' => $opencloseWisata->pager
      ];
    }
    return view('Dashboard/Page/tabelBukaTutup', $userData);
  }

  public function search()
  {
    $dataSearch = new ModelsBukaTutup();

    $this->Token = new UserToken();
    $getToken = $this->Token->getToken($_COOKIE["access_token"]);

    if (isset($_COOKIE["access_token"])) {
      $this->UserId = $getToken[0]["ID_AKUN"];
    }

    $keyword = $this->request->getGet('keyword');
    $dataSearch->search($keyword);

    $db = new UserLogin();
    $dataLogin = $db->getUserLogin($this->UserId);

    if (is_array($dataLogin)) {
      $userData = [
        'id_user' => $dataLogin[0]["ID_USER"],
        'username' => $dataLogin[0]["USERNAME"],
        'poto_profil' => $dataLogin[0]["GAMBAR_PROFIL"],
        'pageropenclose' => $dataSearch->paginate(3),
        'pager' => $dataSearch->pager
      ];
    }

    return view('Dashboard/Page/tabelBukaTutup', $userData);
  }

  public function edit($id)
  {
    $getBukaTutupWisata = new ModelsBukaTutup();
    $responseEdit = $getBukaTutupWisata->edit($id);

    // check response Edit berhasil di update di database dan terdapat file nya 
    if ($responseEdit) {
      return redirect()->to('/Dashboard/bukatutup')->with('success', 'data berhasil diedit');
    } else {
      return redirect()->to('/Dashboard/bukatutup')->with('failed', 'data gagal diupdate');
    }
  }

  public function delete($id)
  {
    $delete = new ModelsBukaTutup();

    try {
      $boolDel = $delete->hapus($id);

      if ($boolDel) {
        return redirect()->to('/Dashboard/bukatutup')->with('success', 'data berhasil dihapus');
      } else {
        return redirect()->to('/Dashboard/bukatutup')->with('failed', 'terjadi kesalahan data');
      }
    } catch (\Throwable $th) {
      //throw $th;
      return redirect()->to('/Dashboard/bukatutup')->with('failed', $th->getMessage());
    }
  }
}
