<?php

namespace App\Models;

use CodeIgniter\Model;

class UserToken extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'token';
    protected $primaryKey       = 'ID_TOKEN';
    protected $protectFields    = true;
    protected $allowedFields    = ["ID_TOKEN", "ACCESS_TOKEN", 'REFRESH_TOKEN', "EXPIRES_IN", "LOGIN_TYPE", "ID_AKUN"];

    protected $db;

    protected $builder;

    public function __construct()
    {
        parent::__construct();
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

    public function updateTokenDB($idUser, $tokennew, $refresh_token, $typeLogin)
    {
        // $messagetoken = null;
        // update Token
        if ($typeLogin === 'Google') {
            $this->builder = $this->db->table($this->table);
            $this->builder->set('ACCESS_TOKEN', $tokennew);
            $this->builder->set('REFRESH_TOKEN', $refresh_token);
            $this->builder->where('ID_TOKEN', 'G-' . $idUser);
            $this->builder->update();

            // $data = [
            //     'ACCESS_TOKEN' => $tokennew,
            // ];

            // $messagetoken = $this->update('G-' . $idUser, $data);
        } else if ($typeLogin === 'Facebook') {
            $this->builder = $this->db->table($this->table);
            $this->builder->set('ACCESS_TOKEN', $tokennew);
            $this->builder->set('REFRESH_TOKEN', $refresh_token);
            $this->builder->where('ID_TOKEN', 'FB-' . $idUser);
            $this->builder->update();

            // $data = [
            //     'ACCESS_TOKEN' => $tokennew,
            // ];

            // $messagetoken = $this->update('IG-' . $idUser, $data);
        } else {
            $this->builder = $this->db->table($this->table);
            $this->builder->set('ACCESS_TOKEN', $tokennew);
            $this->builder->set('REFRESH_TOKEN', $refresh_token);
            $this->builder->where('ID_TOKEN', 'IG-' . $idUser);
            $this->builder->update();

            // $data = [
            //     'ACCESS_TOKEN' => $tokennew,
            // ];

            // $messagetoken = $this->update('IG-' . $idUser, $data);
        }

        if ($this->builder) {
            return "token berhasil di update";
        } else {
            return "token gagal dipupdate";
        }
    }

    public function addToken($arr, $id_Akun, $typeLogin = '')
    {
        $data = [];

        if ($typeLogin === "Google") {
            $data = [
                'ID_TOKEN' => 'G-' . $id_Akun,
                'ACCESS_TOKEN' => $arr['access_token'],
                'REFRESH_TOKEN' => $arr['refresh_token'],
                'EXPIRES_IN' => $arr['expires_in'],
                'LOGIN_TYPE' =>  $typeLogin,
                'ID_AKUN' => $id_Akun
            ];
        } else if ($typeLogin === "Facebook") {
            $data = [
                'ID_TOKEN' => 'FB-' . $id_Akun,
                'ACCESS_TOKEN' => $arr->getToken(),
                'REFRESH_TOKEN' => $arr->getRefreshToken(),
                'EXPIRES_IN' => $arr->getExpires(),
                'LOGIN_TYPE' =>  $typeLogin,
                'ID_AKUN' => $id_Akun
            ];
        } else {
            $data = [
                'ID_TOKEN' => 'IG-' . $id_Akun,
                'ACCESS_TOKEN' => $arr->getToken(),
                'REFRESH_TOKEN' => $arr->getRefreshToken(),
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

    public function getToken($token)
    {
        $builder = $this->db->table($this->table)->where('ACCESS_TOKEN', $token)->get();
        $data = $builder->getResultArray();

        if (count($data) >= 1) {
            return $data;
        } else {
            return "data token dengan id token yang anda minta tidak ada";
        }
    }
}
