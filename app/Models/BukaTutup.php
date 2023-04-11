<?php

namespace App\Models;

use CodeIgniter\Model;

class BukaTutup extends Model
{
    protected $table            = 'buka_tutup_wisata';
    protected $primaryKey       = 'KODE_JAM_OPERASI';
    protected $protectFields    = true;
    protected $allowedFields    = ["KODE_JAM_OPERASI", "JAM_OPERASIONAL"];

    public function GetDatasJamOperasi()
    {
        return $this->findAll();
    }

    public function search($keyword)
    {
        return $this->builder($this->table)->like("KODE_JAM_OPERASI", $keyword);
    }

    public function edit($id)
    {
        $data = [
            "KODE_JAM_OPERASI" => $_POST["kode_jam_operasi"],
            "JAM_OPERASIONAL" => $_POST["jam_operasional"]
        ];

        return $this->update($id, $data);
    }

    public function hapus($id)
    {
        return $this->delete($id);
    }
}
