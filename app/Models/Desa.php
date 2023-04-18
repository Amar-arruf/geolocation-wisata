<?php

namespace App\Models;

use CodeIgniter\Model;

class Desa extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'desa';
    protected $primaryKey       = 'ID_DESA';
    protected $useAutoIncrement = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ID_DESA', 'NAMA_DESA', "KODE_POS"];

    public function countData()
    {
        return $this->countAllResults();
    }
}
