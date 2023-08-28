<?php

namespace App\Models;

use CodeIgniter\Model;


class UserLogin extends Model
{
    protected $table            = 'userlogin';
    protected $primaryKey       = 'ID_USER';
    protected $protectFields    = true;
    protected $allowedFields    = ["ID_USER", "USERNAME", "GAMBAR_PROFIL", "EMAIL", "STATUS"];

    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function getUserLogin($id)
    {
        // mencegah serangan SQL injection 
        $data = $this->db->table($this->table)->where('ID_USER', $id)->get();
        $getData = $data->getResultArray();


        if (count($getData) >= 1) {
            return $getData;
        } else {
            return "data tidak ditemukan ";
        }
    }

    public function addUser($arr, $typeLogin = "Google")
    {
        $data = [];

        if ($typeLogin === "Google") {
            $data = [
                "ID_USER" => $arr['id'],
                "USERNAME" => $arr['name'],
                "GAMBAR_PROFIL" => $arr['picture'],
                "EMAIL" => $arr['email'],
                "STATUS" => 'aktif'
            ];
        } else if ($typeLogin === "Instagram") {
            $data = [
                "ID_USER" => $arr['id'],
                "USERNAME" => $arr['username'],
                "GAMBAR_PROFIL" => null,
                "EMAIL" => null,
                "STATUS" => 'aktif'
            ];
        } else {
            $data = [
                "ID_USER" => $arr['id'],
                "USERNAME" => $arr['name'],
                "GAMBAR_PROFIL" => $arr['picture_url'],
                "EMAIL" => null,
                "STATUS" => 'aktif'
            ];
        }

        $queryBuilder = $this->db->table($this->table)->insert($data);

        if ($queryBuilder) {
            return "data berhasil ditambahkan di database";
        } else {
            return "data gagal ditambahkan";
        }
    }

    public function getAllDataUser()
    {
        return $this->findAll();
    }

    public function getDataUserAktif($status)
    {
        $data = '';

        if ($status === 'aktif') {
            $data = $status;
        } else {
            $data = 'nonaktif';
        }

        return $this->where("STATUS", $data)->findAll();
    }

    public function search($keyword)
    {
        return $this->like("USERNAME", $keyword);
    }

    public function UbahStatus($id)
    {
        // check apakah data ada
        $getdatauser = $this->find($id);

        if (is_array($getdatauser)) {
            // check ada statusnya aktif
            if ($getdatauser["STATUS"] == "aktif") {
                $data = [
                    "STATUS" => "nonaktif"
                ];
                return $this->update($id, $data);
            } else {
                $data = [
                    "STATUS" => "aktif"
                ];
                return $this->update($id, $data);
            }
        } else {
            return "maaf data tidak dapat diubah";
        }
    }

    public function HapusData($id)
    {
        return $this->delete($id);
    }
}
