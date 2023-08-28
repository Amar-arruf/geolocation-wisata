<?= $this->extend('Dashboard/layout'); ?>

<?= $this->section('content') ?>
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <p class="h3 fw-bold mb-0 text-gray-800">Tambah Spot Wisata</p>
  </div>

  <!-- row -->
  <div class="row">
    <!-- total entry spot -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                Total entry</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= sizeof($data_wisata); ?></div>
            </div>
            <div class="col-auto">
              <i class="fa-solid fa-map-location-dot fa-2x text-gray-400"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- total jumlah current entry -->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-sm font-weight-bold text-warning text-uppercase mb-1">
                entry spot</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= isset($_COOKIE["upload_cookie"]) ? $_COOKIE["upload_cookie"] : 0; ?></div>
            </div>
            <div class="col-auto">
              <i class="fa-solid fa-map-pin fa-2x text-gray-400"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- total tambahspot-->
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-sm font-weight-bold text-success text-uppercase mb-1">
                tambah spot</div>
              <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" type="button" data-bs-toggle="modal" data-bs-target="#AddModal"><i class="fas fa-plus fa-sm text-white-50"></i> tambah spot</a>
            </div>
            <div class="col-auto">
              <i class="fa-solid fa-map-pin fa-2x text-gray-400"></i>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- maps -->
    <div class="row mx-1">
      <!-- Basic Card Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Map Wisata</h6>
        </div>
        <div class="card-body position-relative mt-0 mx-0 mb-2 p-0 overflow-hidden" style="height: 350px;">
          <div id="Maps" class="position-absolute top-0 bottom-0 w-100"></div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- modal add -->
<div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold text-gray-800" id="exampleModalLabel">Tambah Spot Wisata</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('/Dashboard/tambahsport/add') ?>" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="formControlID" class="form-label">id</label>
            <input type="text" class="form-control" name="id" id="formControlID" placeholder="ID Wisata">
          </div>
          <div class="mb-3">
            <label for="formControlname" class="form-label">Nama Wisata</label>
            <input type="text" class="form-control" name="nama" id="formControlname" placeholder="Nama Wisata">
          </div>
          <div class="mb-3">
            <label for="formControlLongitude" class="form-label">Longitude</label>
            <input type="text" class="form-control" name="longitude" id="formControlLongitude" placeholder="Longitude">
          </div>
          <div class="mb-3">
            <label for="formControlLatitude" class="form-label">Latitude</label>
            <input type="text" class="form-control" name="latitude" id="formControlLatitude" placeholder="latitude">
          </div>
          <div class="mb-3">
            <label class="form-label">message</label>
            <div id="message" class="p-1 message bg-lights rounded text-xs"></div>
          </div>
          <div class="mb-3">
            <label for="formPosting" class="form-label">Postingan</label>
            <input type="text" class="form-control" name="posting" id="formControlLatitude" placeholder="Postingan">
          </div>
          <div class="mb-3">
            <label for="formControlGambar" class="form-label">Gambar</label>
            <input type="file" id="input-gambar" class="form-control" name="image" id="formControlGambar">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">tutup</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  console.log("connected")
  mapboxgl.accessToken = 'pk.eyJ1IjoiYW1hcmFycnVmMjQiLCJhIjoiY2xldGdjNnR4MWZ3cTN2cDQ5djduZmUxNyJ9.PXQDnSL6qVCGg1OX63BZ7A'
  const map = new mapboxgl.Map({
    container: 'Maps', // container ID
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

  map.on('load', () => {
    map.addSource('places', {
      'type': 'geojson',
      'data': Stores
    });


    AddMarker();
  })


  function Fly_To_Store(currentFeature) {
    map.flyTo({
      center: currentFeature.geometry.coordinates,
      zoom: 18
    });
  }

  let getCoordinate;

  // dapatkan coordinate pada  saat click Event
  map.on('click', (e) => {
    getCoordinate = e.lngLat;
    console.log(getCoordinate)

    const message = document.getElementById("message");
    const inputLatitude = document.getElementById('formControlLatitude');
    const inputLongitude = document.getElementById('formControlLongitude');

    inputLatitude.value = getCoordinate.lat;
    inputLongitude.value = getCoordinate.lng;

    // tampilkan ke message 
    message.innerText = `Latitude: ${inputLatitude.value}, Longitude: ${inputLongitude.value}`;
    // aktifkan  modal
    $('#AddModal').modal('show');

  });

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
<script>
  let exifData;
  const message = document.getElementById("message");
  const inputLatitude = document.getElementById('formControlLatitude');
  const inputLongitude = document.getElementById('formControlLongitude');

  // Konversi koordinat GPS dari format derajat, menit, dan detik ke format derajat desimal
  function convertDMSToDD(degrees, minutes, seconds, direction) {
    var dd = degrees + (minutes / 60) + (seconds / 3600);
    if (direction == "S" || direction == "W") {
      dd = dd * -1;
    }
    return Number(dd).toFixed(15);
  }

  function readEXIF(input) {
    const file = input.files[0];
    if (file) {
      const image = new Image();
      image.addEventListener('load', function() {
        // Panggil fungsi untuk membaca data EXIF dari objek gambar
        EXIF.getData(image, function() {
          // ambil informasi GPS dari data EXIF
          // check ambil data semuanya

          let getDataObj = EXIF.getAllTags(this);

          if (getDataObj.hasOwnProperty("GPSLatitude") && getDataObj.hasOwnProperty("GPSLongitude")) {

            let latitude = EXIF.getTag(this, "GPSLatitude");
            let longitude = EXIF.getTag(this, "GPSLongitude");

            // Konversi koordinat GPS dari format derajat, menit, dan detik ke format derajat desimal
            let latitudeRef = EXIF.getTag(this, "GPSLatitudeRef") || "N";
            let longitudeRef = EXIF.getTag(this, "GPSLongitudeRef") || "W";
            let latitudeDeg = latitude[0].numerator / latitude[0].denominator;
            let latitudeMin = latitude[1].numerator / latitude[1].denominator;
            let latitudeSec = latitude[2].numerator / latitude[2].denominator;
            let longitudeDeg = longitude[0].numerator / longitude[0].denominator;
            let longitudeMin = longitude[1].numerator / longitude[1].denominator;
            let longitudeSec = longitude[2].numerator / longitude[2].denominator;
            let latitudeFinal = convertDMSToDD(latitudeDeg, latitudeMin, latitudeSec, latitudeRef);
            let longitudeFinal = convertDMSToDD(longitudeDeg, longitudeMin, longitudeSec, longitudeRef);

            // Tampilkan koordinat GPS dalam format derajat desimal di konsol
            console.log("Latitude: " + latitudeFinal);
            console.log("Longitude: " + longitudeFinal);

            exifData = {
              "longitude": longitudeFinal,
              "latitude": latitudeFinal
            };

            // tampilkan ke form 
            inputLatitude.value = latitudeFinal
            inputLongitude.value = longitudeFinal

            // tampilkan ke message 
            message.innerText = `Latitude: ${latitudeFinal}, Longitude: ${longitudeFinal}`;
          } else {
            // tampilkan ke message 
            message.innerText = `mohon maaf data GPS tidak ada silahkan input manual dengan format derajat desimal`;
          }
        });
      });
      image.src = URL.createObjectURL(file);
    }
  }

  // Ambil elemen input gambar dari DOM
  const input = document.getElementById('input-gambar');

  // 

  // Tambahkan event listener pada input
  input.addEventListener('change', function() {
    // Panggil fungsi untuk membaca data EXIF dari gambar yang dipilih
    readEXIF(this);
  });
</script>
<?= $this->endSection(); ?>