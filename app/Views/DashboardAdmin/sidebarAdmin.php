<?php $uri = new \CodeIgniter\HTTP\URI(base_url(uri_string(true))); ?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
    <div class="sidebar-brand-text mx-3">geolocation wisata</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0" style="border-top: 1px solid white;">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item <?= $uri->getSegment(2) === 'dashboardadmin' ? "active" : '' ?>">
    <a class="nav-link" href="<?= base_url('/admin/dashboardadmin') ?>">
      <i class="fa-solid fa-table"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider" style="border-top: 1px solid white;">

  <!-- Nav Item - Tabel tambah data wisata -->
  <li class="nav-item <?= $uri->getSegment(2) === 'userdata' ? 'active' : '' ?>">
    <a class="nav-link" href="<?= base_url('/admin/userdata') ?>">
      <i class="fa-solid fa-users"></i>
      <span>Data Users</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider" style="border-top: 1px solid white;">

  <!-- Nav Item - Tabel wisata -->
  <li class="nav-item <?= $uri->getSegment(2) === 'kecamatan' ? 'active' : '' ?>">
    <a class="nav-link" href="<?= base_url('/admin/kecamatan') ?>">
      <i class="fa-solid fa-database"></i>
      <span>Data Kecamatan</span>
    </a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider" style="border-top: 1px solid white;">

  <!-- Nav Item - Tabel wisata -->
  <li class="nav-item <?= $uri->getSegment(2) === 'desa' ? 'active' : '' ?> ">
    <a class="nav-link" href="<?= base_url('/admin/desa') ?>">
      <i class="fa-solid fa-database"></i>
      <span> Data Desa</span>
    </a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider" style="border-top: 1px solid white;">

  <!-- Nav Item - Tabel wisata -->
  <li class="nav-item <?= $uri->getSegment(2) === 'datawisata' ? 'active' : '' ?> ">
    <a class="nav-link" href="<?= base_url('/admin/datawisata') ?>">
      <i class="fa-solid fa-database"></i>
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