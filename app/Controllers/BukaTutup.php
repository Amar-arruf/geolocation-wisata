<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BukaTutup as ModelsBukaTutup;
use App\Models\UserLogin;

class BukaTutup extends BaseController
{
  public function index()
  {
    //



    $UserId = '108321858974021678564';

    $db = new UserLogin();
    $dataLogin = $db->getUserLogin($UserId);

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

    $keyword = $this->request->getGet('keyword');
    $dataSearch->search($keyword);

    $UserId = '108321858974021678564';
    $db = new UserLogin();
    $dataLogin = $db->getUserLogin($UserId);

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
