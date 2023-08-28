<?php

namespace App\Models;

use CodeIgniter\Model;

class DataWisata extends Model
{
  protected $DBGroup          = 'default';
  protected $table            = 'profil_wisata';
  protected $primaryKey       = 'ID';
  protected $useAutoIncrement = false;

  protected $protectFields    = true;
  protected $allowedFields    = ['ID', 'NAMA', 'VIDEO', 'DESKRIPSI_TEXT', 'GAMBAR'];


  public function getAllDataUser($userid)
  {
    $model = new DataWisata();
    $builder = $model->select(
      $this->table . '.ID,'
        . $this->table . '.NAMA,'
        . $this->table . '.VIDEO,'
        . $this->table . '.DESKRIPSI_TEXT,'
        . $this->table . '.GAMBAR,
        userlogin.ID_USER,
        userlogin.USERNAME,'
    )
      ->join('uploader', 'uploader.ID = profil_wisata.ID')
      ->join('userlogin', 'userlogin.ID_USER = uploader.USER_ID')
      ->where('ID_USER', $userid);

    return $builder;
  }
}
