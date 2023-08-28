<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Desa as ModelsDesa;
use App\Models\Kecamatan;

class Desa extends BaseController
{
  protected $username;
  protected $data;
  protected $session;
  protected $breadcrumb;
  public function index()
  {
    // check data session 
    $this->session = \Config\Services::session();

    if (!$this->session->has('username')) {
      return redirect()->to('login');
    }

    // ambil data
    $modelDesa = new ModelsDesa();
    // bread_crumb
    $this->breadcrumb = [
      ["title" => "Dashboard"],
      ["title" => "Data Desa"],
    ];

    // ambil data kode pos kecamtan
    $modelskecamatan = new Kecamatan();
    $datakecamatan = $modelskecamatan->findAll();

    $this->data = [
      "username" => $this->session->get("username"),
      "datakecamatan" => $datakecamatan,
      "dataDesa" => $modelDesa->paginate(10),
      "datapager" => $modelDesa->pager,
      "breadcrumb" => $this->breadcrumb
    ];

    return view("DashboardAdmin/Pages/dataDesa", $this->data);
  }

  public function search()
  {
    // check session data
    $this->session = \Config\Services::session();

    if (!$this->session->has('username')) {
      return redirect()->to('login');
    }

    // ambil data desa
    $modeldesa = new ModelsDesa();
    $keyword = $this->request->getGet("keyword");
    // breadcrumb
    $this->breadcrumb = [
      ["title" => "Dashboard"],
      ["title" => "Data Desa"],
    ];
    // ambil data kode pos kecamtan
    $modelskecamatan = new Kecamatan();
    $datakecamatan = $modelskecamatan->findAll();


    $this->data = [
      "username" => $this->session->get("username"),
      "datakecamatan" => $datakecamatan,
      "dataDesa" => $modeldesa->search($keyword)->paginate(5),
      "datapager" => $modeldesa->pager,
      "breadcrumb" => $this->breadcrumb
    ];

    return view("DashboardAdmin/Pages/dataDesa", $this->data);
  }

  public function add()
  {
    // check session data
    $this->session = \Config\Services::session();

    if (!$this->session->has('username')) {
      return redirect()->to('login');
    }

    // tambah data desa 
    $modelsDesa = new ModelsDesa();
    $messageAddData = $modelsDesa->tambah();

    if ($messageAddData) {
      return redirect()->to("admin/desa")->with("success", "data berhasil ditambah");
    } else {
      return redirect()->to("admin/desa")->with("failed", "gagal di tambahkan");
    }
  }

  public function edit($id)
  {
    // check session data
    $this->session = \Config\Services::session();

    if (!$this->session->has('username')) {
      return redirect()->to('login');
    }

    // ubah nama dari kecaramatan
    $modeldesa = new ModelsDesa();
    $ubahData = $modeldesa->edit($id);


    if ($ubahData) {
      return redirect()->to("admin/desa")->with("success", "data berhasil diubah");
    } else {
      return redirect()->to("admin/desa")->with("failed", "data gagal diubah");
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
    $modelkecamatan = new ModelsDesa();
    try {
      //code...
      $deleteData = $modelkecamatan->hapus($id);

      if ($deleteData) {
        return redirect()->to("admin/desa")->with("success", "data berhasil dihapus");
      } else {
        return redirect()->to("admin/desa")->with("failed", "data gagal diubah");
      }
    } catch (\Throwable $th) {
      //throw $th;
      return redirect()->to('admin/desa')->with('failed', $th->getMessage());
    }
  }
}
