<?php

namespace App\Models;

use CodeIgniter\Model;

class UserToken extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'token';

    protected $db;

    protected $builder;

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

    public function updateTokenDB ($idUser = '', $tokennew = "",$typeLogin = '' ) 
    {
        // update Token
        if ($typeLogin === 'Google') {
            $this->builder = $this->db->table($this->table);
            $this->builder->set('ACCESS_TOKEN',$tokennew);
            $this->builder->where('ID_TOKEN', 'G-'. $idUser);
            $this->builder->update();
        } else {
            $this->builder = $this->db->table($this->table);
            $this->builder->set('ACCESS_TOKEN',$tokennew);
            $this->builder->where('ID_TOKEN', 'IG-'. $idUser);
            $this->builder->update();
        }

      

        if ($this->builder)
        {
            return "token berhasil di update";
        } else {
            return "token gagal dipupdate";
        }
    }

    public function addToken ($arr, $id_Akun, $typeLogin = '') 
    {
        $data = [];

        if ($typeLogin === "Google") {
            $data = [
                'ID_TOKEN' => 'G-'. $id_Akun,
                'ACCESS_TOKEN' => $arr['access_token'],
                'EXPIRES_IN' => $arr['expires_in'],
                'LOGIN_TYPE' =>  $typeLogin,
                'ID_AKUN' => $id_Akun
            ];
        } else {
            $data = [
                'ID_TOKEN' => 'IG-'. $id_Akun,
                'ACCESS_TOKEN' => $arr->getToken(),
                'EXPIRES_IN' => $arr->getExpires(),
                'LOGIN_TYPE' =>  $typeLogin,
                'ID_AKUN' => $id_Akun
            ];
        }

        $queryBuilder = $this->db->table($this->table)->insert($data);

        if ($queryBuilder) {
            return "token berhasil ditambahkan di database";
        } else {
            return "token gagal ditambahkan ke database";
        }
    }
}
