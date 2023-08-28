<?php

namespace App\Controllers;

use App\Models\getLocationDash;

class Home extends BaseController
{
    public function index()
    {
        // intancesiasi models tabels
        $getAllLocation = new getLocationDash();

        // passing data to View

        $data = [
            'getData' => $getAllLocation->getAllDataWithDatauserUpload(),
            'getdataCloud' => json_decode($this->Cloudinary->getResource()),
            "getdataVideo" => json_decode($this->Cloudinary->getResourceVideo())
        ];

        return view('layout', $data);
    }
}
