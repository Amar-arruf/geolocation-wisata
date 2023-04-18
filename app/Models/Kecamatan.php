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
}
