<?php

namespace App\Models;

use CodeIgniter\Model;

class Gps extends Model
{
  protected $table            = 'gps';
  protected $primaryKey       = 'KODE';
  protected $protectFields    = true;
  protected $allowedFields    = ["ID", "KODE_POS", "LONGITUDE", "ALTITUDE"];

  public function GetDatas($userid)
  {
    $model = new Gps();
    $builder = $model->select(
      $this->table . '.KODE,'
        . $this->table . '.ID,'
        . $this->table . '.KODE_POS,'
        . $this->table . '.LONGITUDE,'
        . $this->table . '.ALTITUDE,
        userlogin.ID_USER,
        userlogin.USERNAME,'
    )
      ->join('profil_wisata', 'profil_wisata.ID = ' . $this->table . '.ID')
      ->join('uploader', 'uploader.ID = profil_wisata.ID')
      ->join('userlogin', 'userlogin.ID_USER = uploader.USER_ID')
      ->where("ID_USER", $userid);

    return $builder;
  }

  public function search($keyword)
  {
    return $this->builder($this->table)->like('ID', $keyword);
  }

  public function edit($id)
  {
    $data = [
      "ID" => $_POST["kode_wisata"],
      "KODE_POS" => $_POST["kode_pos"],
      "LONGITUDE" => $_POST["longitude"],
      "ALTITUDE" => $_POST["altitude"],

    ];

    return $this->update($id, $data);
  }

  public function hapus($id)
  {
    return $this->delete($id);
  }
}
