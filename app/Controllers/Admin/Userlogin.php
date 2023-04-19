<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserLogin as ModelsUserLogin;

class Userlogin extends BaseController
{
    protected $username;
    protected $data;
    protected $session;
    protected $breadcrumb;
    public function index()
    {
        // check session data
        $this->session = \Config\Services::session();

        if (!$this->session->has('username')) {
            return redirect()->to('login');
        }

        // ambil data user 
        $modeldata = new ModelsUserLogin();

        // data breadcrumb
        $this->breadcrumb = [
            ["title" => "Dashboard"],
            ["title" => "Data User"],
        ];

        $this->data = [
            "username" => $this->session->get("username"),
            "datauser" => $modeldata->paginate(3),
            "datapager" => $modeldata->pager,
            "breadcrumb" => $this->breadcrumb
        ];

        return view("DashboardAdmin/Pages/dataUser", $this->data);
    }

    public function search()
    {
        // check session data
        $this->session = \Config\Services::session();

        if (!$this->session->has('username')) {
            return redirect()->to('login');
        }

        // ambil data user 
        $modelUser = new ModelsUserLogin();
        $keyword = $this->request->getGet("keyword");

        $this->breadcrumb = [
            ["title" => "Dashboard"],
            ["title" => "Data User"],
        ];

        $this->data = [
            "username" => $this->session->get("username"),
            "datauser" => $modelUser->search($keyword)->paginate(3),
            "datapager" => $modelUser->pager,
            "breadcrumb" => $this->breadcrumb
        ];

        return view("DashboardAdmin/Pages/dataUser", $this->data);
    }

    public function editState($id)
    {
        // check session data
        $this->session = \Config\Services::session();

        if (!$this->session->has('username')) {
            return redirect()->to('login');
        }

        // ubah data state status
        $modelUser = new ModelsUserLogin();
        $changeState = $modelUser->UbahStatus($id);


        if ($changeState == true) {
            return redirect()->to("admin/userdata")->with("success", "data berhasil diubah");
        } else {
            return redirect()->to("admin/userdata")->with("failed", "data gagal diubah");
        }
    }

    public function delete($id)
    {
        // check session data
        $this->session = \Config\Services::session();

        if (!$this->session->has('username')) {
            return redirect()->to('login');
        }

        // hapus data user
        $modelUser = new ModelsUserLogin();
        try {
            //code...
            $deleteData = $modelUser->HapusData($id);

            if ($deleteData) {
                return redirect()->to("admin/userdata")->with("success", "data berhasil dihapus");
            } else {
                return redirect()->to("admin/userdata")->with("failed", "data gagal diubah");
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('admin/userdata')->with('failed', $th->getMessage());
        }
    }
}
