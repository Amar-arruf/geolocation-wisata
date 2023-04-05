<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Kecamatan extends Seeder
{
    public function run()
    {
        // tambah data kecamatan
        $kode_post = [
            [
                "kode_pos" => 62354,
                "kecamatan" => "Bancar",
            ],
            [
                "kode_pos" => 62364,
                "kecamatan" => "Bangilan",
            ],
            [
                "kode_pos" => 62371,
                "kecamatan" => "Grabagan",
            ],
            [
                "kode_pos" => 62362,
                "kecamatan" => "Jatirogo",
            ],
            [
                "kode_pos" => 62356,
                "kecamatan" => "Kerek",
            ],
            [
                "kode_pos" => 62355,
                "kecamatan" => "Merakurak",
            ],
            [
                "kode_pos" => 62357,
                "kecamatan" => "Montong",
            ],
            [
                "kode_pos" => 62366,
                "kecamatan" => "Parengan",
            ],
            [
                "kode_pos" => 62382,
                "kecamatan" => "Plumpang",
            ],
            [
                "kode_pos" => 62370,
                "kecamatan" => "Rengel",
            ],
            [
                "kode_pos" => 62365,
                "kecamatan" => "Senori",
            ],
            
            [
                "kode_pos" => 62361,
                "kecamatan" => "Singgahan",
            ],
            
            [
                "kode_pos" => 62353,
                "kecamatan" => "Tambakboyo",
            ],
            [
                "kode_pos" => 62383,
                "kecamatan" => "Widang",
            ],
            [
                "kode_pos" => 62363,
                "kecamatan" => "Kenduruhan",
            ],
            [
                "kode_pos" => 62372,
                "kecamatan" => "Widang",
            ],
            
        ];

        foreach($kode_post as $item) {
            $this->db->table('kecamatan')->insert($item);
        }
    }
}
