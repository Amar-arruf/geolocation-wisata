<?php $session = \Config\Services::session(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Login</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- Sweetalert -->
  <script src="<?= base_url('js/sweetalert2.min.js') ?>"></script>
  <link rel="stylesheet" href="<?= base_url('style/sweetalert2.min.css') ?>">
  <!-- MDB -->
  <link rel="stylesheet" href="<?= base_url('MD/css/mdb.min.css'); ?>" />
</head>

<body>
  <!-- Start your project here-->

  <style>
    .divider:after,
    .divider:before {
      content: "";
      flex: 1;
      height: 1px;
      background: #eee;
    }

    .h-custom {
      height: calc(100% - 73px);
    }

    @media (max-width: 450px) {
      .h-custom {
        height: 100%;
      }
    }
  </style>
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div id="flash" data-flash="<?= $session->getFlashdata('success') ? $session->getFlashdata('success') : $session->getFlashdata('failed') ?>"></div>
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="<?= base_url('tourist_map.svg') ?>" class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-0 me-3">Masuk Dengan Media Sosial</p>
            <a type="button" href="<?= base_url('/login/auth/google') ?>" class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-google"></i>
            </a>

            <a type="button" href="<?= base_url('/login/auth/ig') ?>" class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-instagram"></i>
            </a>

            <a type="button" href="<?= base_url('/login/auth/fb') ?>" class="btn btn-primary btn-floating mx-1">
              <i class="fab fa-facebook fa-2x"></i>
            </a>
          </div>

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Atau</p>
          </div>

          <form action="<?= base_url('/login/auth') ?>" method="POST">
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="text" id="formUserName" name="username" class="form-control form-control-md" placeholder="masukkan username yang valid" />
              <label class="form-label" for="formUserName">Username</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
              <input type="password" id="formPassword" name="password" class="form-control form-control-lg" placeholder="Enter password" />
              <label class="form-label" for="formPassword">Password</label>
            </div>

            <div class="d-flex justify-content-between align-items-center">
              <!-- Checkbox -->
              <div class="form-check mb-0">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                <label class="form-check-label" for="form2Example3">
                  Ingat Saya
                </label>
              </div>
              <a href="#!" class="text-body">Lupa Password</a>
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" name="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
              <p class="small fw-bold mt-2 pt-1 mb-0">tidak punya akun <a href="#!" class="link-danger">Daftar!</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
      <!-- Copyright -->
      <div class="text-white mb-3 mb-md-0">
        Copyright © 2023. All rights reserved.
      </div>
      <!-- Copyright -->

      <!-- Right -->
      <div>
        <a href="#!" class="text-white me-4">
          <i class="fab fa-google"></i>
        </a>
        <a href="#!" class="text-white me-4">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="#!" class="text-white me-4">
          <i class="fab fa-facebook"></i>
        </a>
      </div>
      <!-- Right -->
    </div>
  </section>
  <!-- End your project here-->

  <!-- MDB -->
  <script type="text/javascript" src="<?= base_url('MD/js/mdb.min.js') ?>"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
  <script>
    var flash = document.getElementById('flash');
    var data = flash.getAttribute('data-flash');
    console.log(data)

    if (data) {
      Swal.fire(
        'perhatian!',
        data,
        'warning'
      )
    }
  </script>
</body>

</html>