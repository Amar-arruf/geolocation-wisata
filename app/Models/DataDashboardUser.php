<?php

namespace App\Models;

use CodeIgniter\Model;

class DataDashboardUser extends Model
{
  protected $DBGroup          = 'default';
  protected $table            = 'profil_wisata';
  protected $primaryKey       = 'ID';
  protected $useAutoIncrement = false;

  protected $protectFields    = true;
  protected $allowedFields    = ['ID', 'NAMA', 'VIDEO', 'DESKRIPSI_TEXT', 'GAMBAR'];

  public function getAllDataUser($userid)
  {
    $builder = $this->builder($this->table);
    $builder->select(
      $this->table . '.ID,'
        . $this->table . '.NAMA,'
        . $this->table . '.VIDEO,'
        . $this->table . '.DESKRIPSI_TEXT,'
        . $this->table . '.GAMBAR,
      buka_tutup_wisata.JAM_OPERASIONAL, 
      hari_operasional_wisata.HARI_OPERASIONAL, 
      gps.LONGITUDE, 
      gps.ALTITUDE,
      userlogin.ID_USER,
      userlogin.USERNAME,'
    );
    $builder->join('hari_operasional_wisata', 'hari_operasional_wisata.ID = profil_wisata.ID');
    $builder->join('buka_tutup_wisata', 'buka_tutup_wisata.KODE_JAM_OPERASI = hari_operasional_wisata.KODE_JAM_OPERASI');
    $builder->join('gps', 'gps.ID = profil_wisata.ID');
    $builder->join('uploader', 'uploader.ID = profil_wisata.ID');
    $builder->join('userlogin', 'userlogin.ID_USER = uploader.USER_ID');
    $builder->where('ID_USER', $userid);

    return $builder->get()->getResultArray();
  }
}
