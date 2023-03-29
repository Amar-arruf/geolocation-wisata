<?php

namespace App\Models;

use CodeIgniter\Model;

class UserToken extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'token';

    protected $db;

    public function __construct()
    {
        parent::__construct ();
        $this->db = db_connect();

    }

    public function getTokenUser($id) 
    {
        $builder = $this->db->table($this->table)->where('ID_AKUN', $id, true)->get();
        $data = $builder->getResultArray();

        if (count($data) >= 1) {
            return $data;
        } else {
            return "data token dengan id yang anda minta tidak ada";
        }
    }

    public function updateTokenDB ($idUser = '', $tokennew = "") 
    {
    
        // update token 
        $builder = $this->db->table($this->table);
        $builder->set('ACCESS_TOKEN',$tokennew);
        $builder->where('ID_TOKEN', 'G-'. $idUser);
        $builder->update();

        if ($builder)
        {
            return "token berhasil di update";
        } else {
            return "token gagal dipupdate";
        }
    }

    public function addToken ($arr = array(), $id_Akun) 
    {
        $data = [
            'ID_TOKEN' => 'G-'. $id_Akun,
            'ACCESS_TOKEN' => $arr['access_token'],
            'EXPIRES_IN' => $arr['expires_in'],
            'LOGIN_TYPE' => 'Google',
            'ID_AKUN' => $id_Akun
        ];

        $queryBuilder = $this->db->table($this->table)->insert($data);

        if ($queryBuilder) {
            return "token berhasil ditambahkan di database";
        } else {
            return "token gagal ditambahkan ke database";
        }
    }
}
