<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <!-- Topbar BreadCrumb-->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <?php foreach ($breadcrumb as $key => $value) : ?>
        <?php if ($key == count($breadcrumb) - 1) : ?>
          <li class="breadcrumb-item active" aria-current="page"><?= $value['title'] ?></li>
        <?php else : ?>
          <li class="breadcrumb-item"><a href=""><?= $value['title'] ?></a></li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ol>
  </nav>

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
      <a class="nav-link dropdown-toggle" href="#" id="breadcrumbDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-angles-right"></i>
      </a>
      <!-- Dropdown - Messages -->
      <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="breadcrumbDropdown">
        <nav aria-label="breadcrumb" class="mr-auto w-100">
          <ol class="breadcrumb">
            <?php foreach ($breadcrumb as $key => $value) : ?>
              <?php if ($key == count($breadcrumb) - 1) : ?>
                <li class="breadcrumb-item active" aria-current="page"><?= $value['title'] ?></li>
              <?php else : ?>
                <li class="breadcrumb-item"><a href=""><?= $value['title'] ?></a></li>
              <?php endif; ?>
            <?php endforeach; ?>
          </ol>
        </nav>
      </div>
    </li>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= esc($username) ?></span>
        <div class="px-2"><i class="fas fa-user fa-fw text-gray-400"></i></div>
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Profile
        </a>
        <a class="dropdown-item" href="#">
          <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
          Settings
        </a>
        <a class="dropdown-item" href="#">
          <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
          Activity Log
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?= base_url("/logout") ?>">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Logout
        </a>
      </div>
    </li>

  </ul>

</nav>
<!-- End of Topbar -->