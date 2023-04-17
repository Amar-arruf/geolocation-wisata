<?php

namespace App\Models;

use CodeIgniter\Model;

class HariOperasi extends Model
{
  protected $table            = 'hari_operasional_wisata';
  protected $primaryKey       = 'ID_OPERASIONAL';
  protected $protectFields    = true;
  protected $allowedFields    = ["KODE_POS", "KODE_UPLOADER", "ID", "KODE_JAM_OPERASI", "HARI_OPERASIONAL"];


  public function GetDatasJamOperasi($userid)
  {
    $model = new HariOperasi();
    $builder = $model->select(
      $this->table . '. ID_OPERASIONAL,'
        . $this->table . '. KODE_POS,'
        . $this->table . '. KODE_UPLOADER,'
        . $this->table . '. ID,'
        . $this->table . '. KODE_JAM_OPERASI,'
        . $this->table . '. HARI_OPERASIONAL,
        userlogin.ID_USER,
        userlogin.USERNAME'
    )
      ->join('uploader', 'uploader.KODE_UPLOADER = ' . $this->table . '.KODE_UPLOADER')
      ->join('userlogin', 'userlogin.ID_USER =  uploader.USER_ID')
      ->where('ID_USER', $userid);

    return $builder;
  }

  public function search($keyword)
  {
    return $this->builder($this->table)->like("ID_OPERASIONAL", $keyword);
  }

  public function edit($id)
  {
    $data = [
      "KODE_POS" => $_POST["kode_pos"],
      "KODE_UPLOADER" => $_POST["kode_uploader"],
      "ID" => $_POST["id_wisata"],
      "KODE_JAM_OPERASI" => $_POST["kode_jam"],
      "HARI_OPERASIONAL" => $_POST["hari_operasional"]
    ];

    return $this->update($id, $data);
  }

  public function hapus($id)
  {
    return $this->delete($id);
  }
}
