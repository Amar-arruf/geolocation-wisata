<?php

namespace App\Models;

use CodeIgniter\Model;

class HariOperasi extends Model
{
    protected $table            = 'hari_operasional_wisata';
    protected $primaryKey       = 'ID_OPERASIONAL';
    protected $protectFields    = true;
    protected $allowedFields    = ["KODE_POS", "KODE_UPLOADER", "ID","KODE_JAM_OPERASI","HARI_OPERASIONAL"];


    public function GetDatasJamOperasi () 
    {
         return $this->findAll();
    }

    public function search ($keyword)
    {
        return $this->builder($this->table)->like("ID_OPERASIONAL", $keyword);
    }

    public function edit($id)
    {
        $data = [
            "KODE_POS" => $_POST["kode_pos"],
            "KODE_UPLOADER" =>$_POST["kode_uploader"],
            "ID" => $_POST["id_wisata"],
            "KODE_JAM_OPERASI" => $_POST["kode_jam"],
            "HARI_OPERASIONAL" => $_POST["hari_operasional"]
        ];

        return $this->update($id,$data);
    }
}
