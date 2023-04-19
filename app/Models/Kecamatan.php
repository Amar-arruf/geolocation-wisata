<?php

namespace App\Models;

use CodeIgniter\Model;

class Kecamatan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kecamatan';
    protected $primaryKey       = 'KODE_POS';
    protected $useAutoIncrement = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["KODE_POS", "KECAMATAN"];

    public function countDataKec()
    {
        return $this->countAllResults();
    }

    public function tambah()
    {
        $data = [
            "KODE_POS" => $_POST["id"],
            "KECAMATAN" => $_POST["kecamatan"]
        ];

        return $this->insert($data);
    }

    public function search($keyword)
    {
        return $this->like("KECAMATAN", $keyword);
    }

    public function edit($id)
    {
        return $this->update($id, ["KECAMATAN" => $_POST["kecamatan"]]);
    }

    public function hapus($id)
    {
        return $this->delete($id);
    }
}
