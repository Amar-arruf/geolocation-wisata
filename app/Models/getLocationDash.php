<?php

namespace App\Models;


use CodeIgniter\Model;

class getLocationDash extends Model
{

   protected $db;
   protected $table            = 'profil_wisata';
   //  protected $primaryKey       = 'id';
   protected $useAutoIncrement = false;
   protected $allowedFields = ['ID', 'NAMA', 'VIDEO', 'DESKRIPSI_TEXT', 'GAMBAR'];


   public function __construct()
   {
      parent::__construct();
      // connect Database
      $this->db = \Config\Database::connect();
   }

   public function getAllDataWisata()
   {
      /*
          menampilkan data wisata
       */
      $query = $this->db->query('
         SELECT 
            profil_wisata.ID, 
            profil_wisata.NAMA, 
            profil_wisata.VIDEO, 
            profil_wisata.DESKRIPSI_TEXT, 
            profil_wisata.GAMBAR, 
            buka_tutup_wisata.JAM_OPERASIONAL, 
            hari_operasional_wisata.HARI_OPERASIONAL, 
            gps.LONGITUDE, 
            gps.ALTITUDE 
         FROM profil_wisata 
         JOIN hari_operasional_wisata 
            ON profil_wisata.ID = hari_operasional_wisata.ID 
         JOIN buka_tutup_wisata 
            ON buka_tutup_wisata.KODE_JAM_OPERASI = hari_operasional_wisata.KODE_JAM_OPERASI 
         JOIN gps 
            ON gps.ID = profil_wisata.ID;
         ');

      return $query->getResultArray();
   }

   public function getAllDataWithoutJoin()
   {
      $builder = $this->findAll();

      return $builder;
   }

   public function getAllDataWithDatauserUpload()
   {
      $builder = $this->builder($this->table);
      $builder->select(
         $this->table . '.ID,'
            . $this->table . '.NAMA,'
            . $this->table . '.VIDEO,'
            . $this->table . '.DESKRIPSI_TEXT,'
            . $this->table . '.GAMBAR,
         buka_tutup_wisata.JAM_OPERASIONAL, 
         hari_operasional_wisata.HARI_OPERASIONAL,
         hari_operasional_wisata.KODE_JAM_OPERASI,
         gps.LONGITUDE, 
         gps.ALTITUDE,
         userlogin.USERNAME,
         userlogin.GAMBAR_PROFIL,'
      );
      $builder->join('hari_operasional_wisata', 'hari_operasional_wisata.ID = profil_wisata.ID');
      $builder->join('buka_tutup_wisata', 'buka_tutup_wisata.KODE_JAM_OPERASI = hari_operasional_wisata.KODE_JAM_OPERASI');
      $builder->join('gps', 'gps.ID = profil_wisata.ID');
      $builder->join('uploader', 'uploader.ID = profil_wisata.ID');
      $builder->join('userlogin', 'userlogin.ID_USER = uploader.USER_ID');

      return $query = $builder->get()->getResultArray();
   }

   public function search($keyword)
   {
      $builder = $this->table($this->table);
      $builder->like('NAMA', $keyword); // Kolom yang ingin dicari
      return $builder;
   }

   public function filter($data)
   {
      $builder = $this->builder($this->table);
      $builder->select(
         $this->table . '.ID,'
            . $this->table . '.NAMA,'
            . $this->table . '.VIDEO,'
            . $this->table . '.DESKRIPSI_TEXT,'
            . $this->table . '.GAMBAR,
         buka_tutup_wisata.JAM_OPERASIONAL, 
         hari_operasional_wisata.HARI_OPERASIONAL,
         hari_operasional_wisata.KODE_JAM_OPERASI,
         gps.LONGITUDE, 
         gps.ALTITUDE,
         userlogin.USERNAME,
         userlogin.GAMBAR_PROFIL,'
      );
      $builder->join('hari_operasional_wisata', 'hari_operasional_wisata.ID = profil_wisata.ID');
      $builder->join('buka_tutup_wisata', 'buka_tutup_wisata.KODE_JAM_OPERASI = hari_operasional_wisata.KODE_JAM_OPERASI');
      $builder->join('gps', 'gps.ID = profil_wisata.ID');
      $builder->join('uploader', 'uploader.ID = profil_wisata.ID');
      $builder->join('userlogin', 'userlogin.ID_USER = uploader.USER_ID');
      $builder->where("hari_operasional_wisata.KODE_JAM_OPERASI", $data);
      return $builder;
   }

   public function edit($id)
   {
      $data = [];
      if (strlen($_FILES["gambar"]["name"]) !== 0) {
         $data = [
            'NAMA' => $_POST["nama"],
            'DESKRIPSI_TEXT'    => $_POST["desc"],
            'GAMBAR'    => $_FILES["gambar"]["name"]
         ];
      } else if (strlen($_FILES["video"]["name"]) !== 0) {
         $data = [
            'NAMA' => $_POST["nama"],
            'VIDEO'    => $_FILES["video"]["name"],
            'DESKRIPSI_TEXT'    => $_POST["desc"],
         ];
      } else {
         $data = [
            'NAMA' => $_POST["nama"],
            'DESKRIPSI_TEXT'    => $_POST["desc"],
         ];
      }

      return $this->update($id, $data);
   }

   public function hapus($id)
   {
      return $this->delete($id);
   }
}
