<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Kecamatan as ModelsKecamatan;

class Kecamatan extends BaseController
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
    $modelKecamatan = new ModelsKecamatan();
    // bread_crumb
    $this->breadcrumb = [
      ["title" => "Dashboard"],
      ["title" => "Data Kecamatan"],
    ];

    $this->data = [
      "username" => $this->session->get("username"),
      "datakecamatan" => $modelKecamatan->paginate(5),
      "datapager" => $modelKecamatan->pager,
      "breadcrumb" => $this->breadcrumb
    ];

    return view("DashboardAdmin/Pages/dataKecamatan", $this->data);
  }

  public function search()
  {
    // check session data
    $this->session = \Config\Services::session();

    if (!$this->session->has('username')) {
      return redirect()->to('login');
    }

    // ambil data kecamatan
    $modelKecamatan = new ModelsKecamatan();
    $keyword = $this->request->getGet("keyword");

    $this->breadcrumb = [
      ["title" => "Dashboard"],
      ["title" => "Data User"],
    ];

    $this->data = [
      "username" => $this->session->get("username"),
      "datakecamatan" => $modelKecamatan->search($keyword)->paginate(5),
      "datapager" => $modelKecamatan->pager,
      "breadcrumb" => $this->breadcrumb
    ];

    return view("DashboardAdmin/Pages/dataKecamatan", $this->data);
  }

  public function add()
  {
    // check session data
    $this->session = \Config\Services::session();

    if (!$this->session->has('username')) {
      return redirect()->to('login');
    }

    $modelkecamatan = new ModelsKecamatan();
    $addData = $modelkecamatan->tambah();

    if ($addData == true) {
      return redirect()->to("admin/kecamatan")->with("success", "data berhasil diubah");
    } else {
      return redirect()->to("admin/kecamatan")->with("failed", "data gagal diubah");
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
    $modelkecamatan = new ModelsKecamatan();
    $ubahData = $modelkecamatan->edit($id);



    if ($ubahData == true) {
      return redirect()->to("admin/kecamatan")->with("success", "data berhasil diubah");
    } else {
      return redirect()->to("admin/kecamatan")->with("failed", "data gagal diubah");
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
    $modelkecamatan = new ModelsKecamatan();
    try {
      //code...
      $deleteData = $modelkecamatan->hapus($id);

      if ($deleteData) {
        return redirect()->to("admin/kecamatan")->with("success", "data berhasil dihapus");
      } else {
        return redirect()->to("admin/kecamatan")->with("failed", "data gagal diubah");
      }
    } catch (\Throwable $th) {
      //throw $th;
      return redirect()->to('admin/kecamatan')->with('failed', $th->getMessage());
    }
  }
}
