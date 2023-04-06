<?php

namespace App\Models;

use CodeIgniter\Model;

class Gps extends Model
{
    protected $table            = 'gps';
    protected $primaryKey       = 'KODE';
    protected $protectFields    = true;
    protected $allowedFields    = ["ID", "KODE_POS", "LONGITUDE", "ALTITUDE"];

    public function GetDatas () 
    {
         return $this->findAll();
    }

    public function search ($keyword)
    {
        return $this->builder($this->table)->like("ID", $keyword);
    }

    public function edit($id)
    {
        $data = [
            "ID" => $_POST["kode_wisata"],
            "KODE_POS" => $_POST["kode_pos"],
            "LONGITUDE" => $_POST["longitude"],
            "ALTITUDE" => $_POST["alltitude"],

        ];

        return $this->update($id,$data);
    }
}