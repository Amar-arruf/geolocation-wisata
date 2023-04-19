<?php

namespace Config;

use App\Controllers\Auth;
use App\Controllers\GPS;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

$routes->get('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->post('/login/auth', 'Auth::auth');
$routes->get('/login/auth/google', 'Auth::loginGoogle');
$routes->get('/login/auth/google/callback', 'Auth::googleCallback');
$routes->get('/login/auth/ig', 'Auth::loginInstagram');
$routes->get('/login/auth/ig/callback', 'Auth::instagramCallback');

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/Dashboard/dashboard', 'Dashboard::dashboard');
$routes->get('/Dashboard/tambahsport', 'TambahSpot::index');
$routes->get('/Dashboard/tabelwisata', 'TabelWisata::index');
$routes->get('/Dashboard/gps', 'GPS::index');
$routes->get('/Dashboard/bukatutup', 'BukaTutup::index');
$routes->get('/Dashboard/harioperasi', 'HariOperasional::index');
$routes->get('Dashboard/admin/dashboard', 'Admin\DashboardAdmin::dashboard');

$routes->post('/Dashboard/tambahsport/add', "TambahSpot::add");

$routes->get('/Dashboard/tabelwisata/search', 'Tabelwisata::search');
$routes->post('/Dashboard/tabelwisata/(:segment)/edit', 'Tabelwisata::edit/$1');
$routes->get('/Dashboard/tabelwisata/(:segment)/(:segment)/(:segment)/delete', 'Tabelwisata::delete/$1/$2/$3');

$routes->get("/Dasgboard/gps/search", "GPS::search");
$routes->post('/Dashboard/gps/(:segment)/edit', 'GPS::edit/$1');
$routes->get('/Dashboard/gps/(:segment)/delete', 'GPS::delete/$1');

$routes->get("Dashboard/bukatutup/search", "BukaTutup::search");
$routes->post("/Dashboard/bukatutup/(:segment)/edit", "BukaTutup::edit/$1");
$routes->post("/Dashboard/bukatutup/(:segment)/delete", "BukaTutup::delete/$1");

$routes->get("Dashboard/harioperasi/search", "HariOperasional::search");
$routes->post("/Dashboard/harioperasi/(:segment)/edit", "HariOperasional::edit/$1");
$routes->get("/Dashboard/harioperasi/(:segment)/delete", "HariOperasional::delete/$1");

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('dashboardadmin', 'DashboardAdmin::dashboard');
    $routes->get('userdata', "Userlogin::index");
    $routes->get('kecamatan', "Kecamatan::index");
    $routes->get('desa', "Desa::index");

    $routes->get('userdata/search', "Userlogin::search");
    $routes->get('userdata/(:segment)/edit', "Userlogin::editState/$1");
    $routes->get('userdata/(:segment)/hapus', "Userlogin::delete/$1");
    // tambahkan routes untuk controller di dalam folder Admin lainnya di sini
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
