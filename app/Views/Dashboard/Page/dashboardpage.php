<?= $this->extend('Dashboard/layout'); ?>

<?= $this->section('content') ?>

<div class="container-fluid mt-5">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 fw-bold mb-0 text-gray-800">Selmat Datang di Halaman Dashboard</h1>
      <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
              class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">
    <!-- Total Wisata  card  Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="fs-5 font-weight-bold text-primary text-uppercase mb-1">
                            Total wisata</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">5</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-map-location-dot fa-2x text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jumlah kecamatan Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="fs-5 font-weight-bold text-success text-uppercase mb-1">
                            Total Kecamatan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">20</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-circle-dot fa-2x text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jumlah Desa  Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="fs-5 font-weight-bold text-warning text-uppercase mb-1">
                            Total Desa
                          </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">200</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-house-chimney-crack fa-2x text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

  <!-- Content Row -->
  <div class="row mx-1">
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Map Wisata User</h6>
      </div>
      <div class="card-body position-relative mt-0 mx-0 mb-2 p-0 overflow-hidden" style="height: 300px;">
        <div id="Map" class="position-absolute top-0 bottom-0 w-100"></div>
      </div>
    </div>
  </div>
</div>

<script >
  mapboxgl.accessToken = 'pk.eyJ1IjoiYW1hcmFycnVmMjQiLCJhIjoiY2xldGdjNnR4MWZ3cTN2cDQ5djduZmUxNyJ9.PXQDnSL6qVCGg1OX63BZ7A'
        const map = new mapboxgl.Map({
            container: 'Map', // container ID
            // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
            style: 'mapbox://styles/mapbox/streets-v12', // style URL
            center: [112.06, -6.893], // starting position [lng, lat]
            zoom: 10   // starting zoom
        });
</script>
<?= $this->endSection() ?>