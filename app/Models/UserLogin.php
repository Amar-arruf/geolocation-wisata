<?php

namespace App\Models;

use CodeIgniter\Model;


class UserLogin extends Model
{
    protected $table            = 'UserLogin';
    protected $protectFields    = true;
    protected $allowedFields    = [];

    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function getUserLogin ($id)  
    {
        // mencegah serangan SQL injection 
       $data = $this->db->table($this->table)->where('ID_USER', $this->db->escapeString($id))->get();
       $getData = $data->getResultArray();
       

       if (count($getData) >= 1) {
        return $getData;
       } else {
        return "data tidak ditemukan ";
       }
    }

    public function addUser($arr, $typeLogin= "Google") 
    {
        $data = [];

        if ($typeLogin === "Google") {
            $data = [
                "ID_USER" => $arr['id'],
                "USERNAME" => $arr['name'] ,
                "GAMBAR_PROFIL" => $arr['picture'],
                "EMAIL" => $arr['email']
            ];  
        }else {
            $data = [
                "ID_USER" => $arr['id'],
                "USERNAME" => $arr['username'] ,
                "GAMBAR_PROFIL" => null,
                "EMAIL" => null
            ];
        }

        $queryBuilder = $this->db->table($this->table)->insert($data);

        if ($queryBuilder) {
            return "data berhasil ditambahkan di database";
        } else {
            return "data gagal ditambahkan";
        }   

    }

}
