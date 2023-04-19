<?php

namespace App\Models;

use CodeIgniter\Model;

class Desa extends Model
{
    protected $table            = 'desa';
    protected $primaryKey       = 'ID_DESA';
    protected $useAutoIncrement = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ID_DESA', 'NAMA_DESA', "KODE_POS"];

    public function countData()
    {
        return $this->countAllResults();
    }

    public function search($keyword)
    {
        return $this->like('NAMA_DESA', $keyword);
    }

    public function edit($id)
    {
        $data = [
            "NAMA_DESA" => $_POST["namaDesa"],
            "KODE_POS" => $_POST["kodePos"],
        ];

        return $this->update($id, $data);
    }

    public function hapus($id)
    {
        return $this->delete($id);
    }

    public function tambah()
    {
        $data = [
            "ID_DESA" => $_POST['id'],
            "NAMA_DESA" => $_POST['namaDesa'],
            "KODE_POS" => $_POST['kodePos']
        ];

        return $this->insert($data);
    }
}
