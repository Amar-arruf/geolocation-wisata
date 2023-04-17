<?php

namespace App\Models;

use CodeIgniter\Model;


class Akun extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'akun';
    protected $primaryKey       = 'ID_AKUN';
    protected $useAutoIncrement = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ID_AKUN', 'ID_TOKEN', 'USERNAME', 'PASSWORD', 'AUTHORIZATION'];

    public function getakun($username)
    {
        $getDataMessage = $this->where('USERNAME', $username, true)->first();

        if ($getDataMessage !== null) {
            return $getDataMessage;
        } else {
            return "data tidak ada atau null";
        }
    }
}
