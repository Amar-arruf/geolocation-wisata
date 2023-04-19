<?php $uri = new \CodeIgniter\HTTP\URI(base_url(uri_string(true))); ?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
    <div class="sidebar-brand-text mx-3">geolocation wisata</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0" style="border-top: 1px solid white;">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item <?= $uri->getSegment(3) === 'dashboardadmin' ? "active" : '' ?>">
    <a class="nav-link" href="">
      <i class="fa-solid fa-table"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider" style="border-top: 1px solid white;">

  <!-- Nav Item - Tabel tambah data wisata -->
  <li class="nav-item <?= $uri->getSegment(2) === 'tambahsport' ? 'active' : '' ?>">
    <a class="nav-link" href="<?= base_url('/Dashboard/tambahsport') ?>">
      <i class="fa-sharp fa-solid fa-location-dot"></i>
      <span>Data Users</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider" style="border-top: 1px solid white;">

  <!-- Nav Item - Tabel wisata -->
  <li class="nav-item <?= $uri->getSegment(2) === 'tabelwisata' ? 'active' : '' ?>">
    <a class="nav-link" href="<?= base_url('/Dashboard/tabelwisata') ?>">
      <i class="fa-solid fa-table-columns"></i>
      <span>Data Kecamatan</span>
    </a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider" style="border-top: 1px solid white;">

  <!-- Nav Item - Tabel wisata -->
  <li class="nav-item <?= $uri->getSegment(2) === 'gps' ? 'active' : '' ?> ">
    <a class="nav-link" href="<?= base_url('/Dashboard/gps') ?>">
      <i class="fa-solid fa-location-crosshairs"></i>
      <span> Data Desa</span>
    </a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider" style="border-top: 1px solid white;">

  <!-- Nav Item - Tabel wisata -->
  <li class="nav-item <?= $uri->getSegment(2) === 'gps' ? 'active' : '' ?> ">
    <a class="nav-link" href="">
      <i class="fa-solid fa-location-crosshairs"></i>
      <span>Data Wisata</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider" style="border-top: 1px solid white;">

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
<!-- End of Sidebar -->