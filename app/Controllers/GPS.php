<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Gps as ModelsGps;
use App\Models\UserLogin;

class GPS extends BaseController
{
  public function index()
  {
    //

    $UserId = '108321858974021678564';

    $db = new UserLogin();
    $dataLogin = $db->getUserLogin($UserId);

    $gpsWisata = new ModelsGps();
    $gpsWisata->GetDatas();

    $conn = db_connect();

    $builder = $conn->table('profil_wisata');
    $query = $builder->select('ID')->get()->getResultArray();

    $builder2 = $conn->table('kecamatan');
    $query2 = $builder2->select('KODE_POS')->get()->getResultArray();

    if (is_array($dataLogin) && is_array($gpsWisata->GetDatas())) {
      $userData = [
        'id_user' => $dataLogin[0]["ID_USER"],
        'username' => $dataLogin[0]["USERNAME"],
        'poto_profil' => $dataLogin[0]["GAMBAR_PROFIL"],
        'id_Wisata' => $query,
        'kode_pos' => $query2,
        "pagergpswisata" => $gpsWisata->paginate(3),
        'pager' => $gpsWisata->pager
      ];
    }
    return view('Dashboard/Page/tabelgps', $userData);
  }

  public function search()
  {
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

    $UserId = '108321858974021678564';
    $dataUserLogin = $dataUser->getUserLogin($UserId);

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
