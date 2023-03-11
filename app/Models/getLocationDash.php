<?php 

namespace App\Models;

use CodeIgniter\Model;

class getLocationDash extends Model 
{

    protected $db;

    public function __construct()
    {
      parent::__construct();
      // connect Database
      $this->db = \Config\Database::connect();
    }

    public function getAllDataWisata () {
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
}