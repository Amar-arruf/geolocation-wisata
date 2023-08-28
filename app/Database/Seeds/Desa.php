<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Desa extends Seeder
{
    public function run()
    {
        $data =[];
        $typeRequest = 'villages';
        $kodeJSON = '3523010.json';
        $KODE_POS = 62363;


        // ambil data API desa 
        $options = [
            'baseURI' => 'https://www.emsifa.com/api-wilayah-indonesia/api/',
            'timeout' => 3,
        ];

        $client = \Config\Services::curlrequest($options);

        $response = $client->get($typeRequest.'/'.$kodeJSON);
        $body = $response->getBody();
        
        if (strpos($response->header('content-type'), 'application/json') !== false) {
            $body = json_decode($body);
        }
        // simpan ke array data
        foreach($body as $item) {
            array_push($data,[
                'ID_DESA' =>  $item->id,
                'NAMA_DESA' => $item->name,
                'KODE_POS' =>  $KODE_POS
                ]);
        }

        // tambahkan ke database
        foreach($data as $row) {
            $this->db->table('desa')->insert($row);
        }

    }
}
