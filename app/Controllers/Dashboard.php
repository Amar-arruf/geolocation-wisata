<?php 
namespace App\Controllers;

class Dashboard extends BaseController {
  public function dashboard ()
  {
    return view('Dashboard/Page/dashboardpage');
  }
}