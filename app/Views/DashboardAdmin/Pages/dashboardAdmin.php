<?= $this->extend('DashboardAdmin/layoutAdmin'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 fw-bold mb-0 text-gray-800">Selamat Datang di Halaman Dashboard Admin</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">
    <!-- Total user card  Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                Total users</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($data_users); ?></div>
            </div>
            <div class="col-auto">
              <i class="fa-solid fa-users fa-2x text-gray-400"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- jumlah user aktif Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-sm font-weight-bold text-success text-uppercase mb-1">
                users aktif</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($dataAktif); ?></div>
            </div>
            <div class="col-auto">
              <i class="fa-solid fa-users-line fa-2x text-gray-400"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Jumlah user nonaktif example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                user nonaktif
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($dataNonAktif); ?></div>
            </div>
            <div class="col-auto">
              <i class="fa-solid fa-users-rectangle fa-2x text-gray-400"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Total kecamatan -->
    <div class="col-md-6 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                Total Kecamatan</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data_kecamatan; ?></div>
            </div>
            <div class="col-auto">
              <i class="fa-solid fa-circle fa-2x text-gray-400"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Desa -->
    <div class="col-md-6 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-sm font-weight-bold text-success text-uppercase mb-1">
                Total Desa</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data_Desa; ?></div>
            </div>
            <div class="col-auto">
              <i class="fa-solid fa-house fa-2x text-gray-400"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Content Row -->
  <div class="row">
    <!-- Total Wisata  card  Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                Total wisata</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($data_wisata); ?></div>
            </div>
            <div class="col-auto">
              <i class="fa-solid fa-map-location-dot fa-2x text-gray-400"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- jumlah wisata jauh dari pusat kota Example -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-sm font-weight-bold text-success text-uppercase mb-1">
                wisata jauh dari pusat kota</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800" id="Jauh"></div>
            </div>
            <div class="col-auto">
              <i class="fa-solid fa-map-pin fa-2x text-gray-400"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Jumlah wisata deket pusat kota -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                Wisata dekat dari pusat kota
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800" id="Dekat"></div>
            </div>
            <div class="col-auto">
              <i class="fa-solid fa-location-dot fa-2x text-gray-400"></i>
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
      <div class="card-body position-relative mt-0 mx-0 mb-2 p-0 overflow-hidden" style="height: 400px;">
        <div id="Map" class="position-absolute top-0 bottom-0 w-100"></div>
      </div>
    </div>
  </div>
</div>

<script src='https://unpkg.com/@turf/turf@6.5.0/turf.min.js'></script>
<script>
  mapboxgl.accessToken = 'pk.eyJ1IjoiYW1hcmFycnVmMjQiLCJhIjoiY2xldGdjNnR4MWZ3cTN2cDQ5djduZmUxNyJ9.PXQDnSL6qVCGg1OX63BZ7A'
  const map = new mapboxgl.Map({
    container: 'Map', // container ID
    // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
    style: 'mapbox://styles/mapbox/streets-v12', // style URL
    center: [112.06, -6.893], // starting position [lng, lat]
    zoom: 10 // starting zoom
  });

  // passing data php objek ke dalam objek javascript
  let js_Data = <?= json_encode($data_wisata) ?>;

  // format geoJSON
  let Stores = {
    "type": "FeatureCollection",
    "features": []
  };

  // passing js data ke dalam format GeoJSON
  for (let i = 0; i < js_Data.length; i++) {
    Stores.features.push({
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          Number(js_Data[i]["LONGITUDE"]),
          Number(js_Data[i]["ALTITUDE"])
        ]
      },
      "properties": {
        "ID": js_Data[i]["ID"],
        "NAMA": js_Data[i]["NAMA"],
      }
    })
  }
  // membuat daftar titik wisata yang akan di check
  let points = [];
  for (const item of Stores.features) {
    points.push([item.geometry.coordinates[0], item.geometry.coordinates[1]]);
  }

  // membuat circle polygon circular
  const circlePusat = [112.06, -6.893]
  const circleRadius = 5.5 // dalam km

  const options = {
    steps: 64,
    units: 'kilometers'
  }

  const circle = turf.circle(circlePusat, circleRadius, options);

  map.on('load', () => {
    map.addSource('places', {
      'type': 'geojson',
      'data': Stores
    });

    map.addLayer({
      id: 'circle-layer',
      type: 'fill',
      source: {
        type: 'geojson',
        data: circle
      },
      paint: {
        'fill-color': '#10f8cb',
        'fill-opacity': 0.2,
        'fill-outline-color': 'green',
      }
    });

    AddMarker();

    // tangkap element jauh dari pusat kota 
    const ElJauh = document.getElementById("Jauh");
    // tangkap element dekat dari pusat kota 
    const ElDekat = document.getElementById("Dekat");

    // count
    let CountDekat = 0;
    let CountJauh = 0;



    points.forEach((value, index) => {
      let point = turf.point(value); //titik yang akan diperiksa
      let isInside = turf.booleanPointInPolygon(point, circle); // periksa apakah titik berada di dalam lingkaran
      if (isInside) {
        CountDekat += 1;
        ElDekat.innerText = CountDekat;
      } else {
        CountJauh += 1;
        ElJauh.innerText = CountJauh;
      }
    })
  })

  function Fly_To_Store(currentFeature) {
    map.flyTo({
      center: currentFeature.geometry.coordinates,
      zoom: 18
    });
  }


  function create_Pop_Up(currentFeature) {
    const popUps = document.getElementsByClassName('mapboxgl-popup');
    if (popUps[0]) popUps[0].remove();

    const popup = new mapboxgl.Popup({
        closeOnClick: false
      })
      .setLngLat(currentFeature.geometry.coordinates)
      .setHTML(
        `<h5>nama wisata</h5><h6>${currentFeature.properties["NAMA"]}</h6>`
      )
      .addTo(map);


    popUps[0].addEventListener("click", () => {
      popUps[0].remove();
    })
  }

  function AddMarker() {
    // tampilkan data GeoJSON DOM HTML
    for (const marker of Stores.features) {
      const el = document.createElement('div');
      el.id = `marker-${marker.properties["ID"]}`
      el.className = 'marker'

      new mapboxgl.Marker(el)
        .setLngLat(marker.geometry.coordinates)
        .addTo(map)


      el.addEventListener('click', () => {
        //terbang ke point yang di klik
        Fly_To_Store(marker)
        // tutup semua popup yang lain dan tampilkan popup point yang di kliked
        create_Pop_Up(marker)

      })
    }
  }
</script>
<?= $this->endSection() ?>