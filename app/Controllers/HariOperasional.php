<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HariOperasi;
use App\Models\UserLogin;

class HariOperasional extends BaseController
{
    public function index()
    {
        //
        $UserId = '108321858974021678564';

        $db = new UserLogin();
        $dataLogin = $db->getUserLogin($UserId);
        $getHariOperasi = new HariOperasi();
        $getHariOperasi->GetDatasJamOperasi();

        $conn = db_connect();

        if(is_array($dataLogin)) {
            $userData = [
              'id_user' => $dataLogin[0]["ID_USER"],
              'username' => $dataLogin[0]["USERNAME"],
              'poto_profil' => $dataLogin[0]["GAMBAR_PROFIL"],
              'kode_pos' => $conn->table('kecamatan')->select('KODE_POS')->get()->getResultArray(),
              'kode_uploader' => $conn->table('uploader')->select('KODE_UPLOADER')->get()->getResultArray(),
              'id_wisata' => $conn->table('profil_wisata')->select('ID')->get()->getResultArray(),
              'kode_jam' => $conn->table('buka_tutup_wisata')->select('KODE_JAM_OPERASI')->get()->getResultArray(),
              'PagerHariOperasional' => $getHariOperasi->paginate(3),
              'pager' => $getHariOperasi->pager
            ];  
          }

        return view('Dashboard/Page/tabeloperasional', $userData);
    }

    public function search ()
    {
      $dataSearch = new HariOperasi();

      $keyword = $this->request->getGet('keyword');
      $dataSearch->search($keyword);

      $conn = db_connect();

      $UserId = '108321858974021678564';
      $db = new UserLogin();
      $dataLogin = $db->getUserLogin($UserId);
      
      if(is_array($dataLogin)) {
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

    public function edit ($id)
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
}
