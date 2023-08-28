<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin| geolocation wisata</title>

  <!-- custom css fonts ke  dashboard  -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('vendorCustom/fontawesome-free/css/fontawesome.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('vendorCustom/fontawesome-free/css/all.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">
  <!-- Google Font Custom -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- menyambungkan mapbox css dan js  -->
  <link href="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.css" rel="stylesheet">
  <script src="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.js"></script>

  <!-- Custom  style untuk dashboard-->
  <link rel="stylesheet" href="<?= base_url('style/sb-admin-2.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('style/sweetalert2.min.css'); ?>">
  <script src="<?= base_url('js/sweetalert2.min.js'); ?>"></script>

  <!-- Custom style own -->
  <link rel="stylesheet" href="<?= base_url('style/styleDashboard.css') ?>">

</head>

<body id="page-top">

  <!-- page wrapper -->
  <div id="wrapper">
    <!-- include component navbar -->
    <?= $this->include("DashboardAdmin/sidebarAdmin"); ?>
    <!-- akhir component navbar -->

    <!--Content Wrapper -->
    <div id="content-wraper" class="d-flex flex-column w-100">
      <!-- Main Content -->
      <div id="content">
        <!-- TopBar -->
        <?= $this->include("DashboardAdmin/topbarAdmin"); ?>
        <!-- Akhir Top Bar -->
        <!-- $Content Dinamis -->
        <?= $this->renderSection('content') ?>
        <!-- $Akhir Content Dinamis -->
        <!-- Footer -->
        <!-- Akhir Foter -->
      </div>
    </div>
  </div>

  <!-- JQuery  -->
  <script src="<?= base_url('vendorCustom/jquery/jquery.min.js') ?>"></script>
  <!-- js boostrap -->
  <script src="<?= base_url('vendorCustom/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- jquery plugins -->
  <script src="<?= base_url('vendorCustom/jquery-easing/jquery.easing.min.js') ?>"></script>
  <!-- JS sbadmin2 -->
  <script src="<?= base_url('js/sb-admin-2.min.js'); ?>"></script>


  <script src="<?= base_url('vendorCustom/datatables/jquery.dataTables.min.js') ?>"></script>
  <script src="<?= base_url('vendorCustom/datatables/dataTables.bootstrap4.min.js') ?>"></script>
  <script src="<?= base_url('js/datatables-demo.js') ?>"></script>
</body>

</html>