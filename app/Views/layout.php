<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skripsi Geolocation</title>
    <!-- google iconts  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <!-- css boostrap -->
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">
    <!-- menyambungkan mapbox css dan js  -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.13.0/mapbox-gl.js"></script>
    <!-- CSS Custom -->
    <link rel="stylesheet" href="<?= base_url('style/style.css') ?>">
</head>
<body>
    <!-- navbar -->
    <?= $this->include('webComponent/navbar') ?>
    <!-- Akhir Navbar -->
    <!-- section map -->
    <?= $this->include('webComponent/map'); ?>
    <!-- akhir section map -->
    <!-- list wisata modal -->
    <?= $this->include('webComponent/sidemodal'); ?>
    <!-- Akhir wisata modal -->
    <!-- fitur pencarian -->
    <?= $this->include('webComponent/search'); ?>
    <!-- Akhir Fitur Pencarian -->

<!-- js boostrap -->
    <script src="<?= base_url('bootstrap/js/bootstrap.bundle.min.js') ?>" ></script>

    <script type= "module">  
    mapboxgl.accessToken = 'pk.eyJ1IjoiYW1hcmFycnVmMjQiLCJhIjoiY2xldGdjNnR4MWZ3cTN2cDQ5djduZmUxNyJ9.PXQDnSL6qVCGg1OX63BZ7A'
        const map = new mapboxgl.Map({
            container: 'map', // container ID
            // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
            style: 'mapbox://styles/mapbox/streets-v12', // style URL
            center: [112.06, -6.893], // starting position [lng, lat]
            zoom: 10 // starting zoom
        });

        // passing data php objek ke dalam objek javascript
        var js_data = <?= json_encode($getData) ?>;

        // format geoJSON
        let stores = {
        "type": "FeatureCollection",
        "features": []
        };

        // passing js data ke dalam format GeoJSON
        for (let i = 0; i < js_data.length; i++) {
        stores.features.push( {
        "type": "Feature",
        "geometry": {
            "type": "Point",
            "coordinates": [
            Number(js_data[i]["LONGITUDE"]),
            Number(js_data[i]["ALTITUDE"])
            ]
        },
        "properties": {
            "ID": js_data[i]["ID"],
            "NAMA": js_data[i]["NAMA"],
            "DESKRIPSI_TEXT": js_data[i]["DESKRIPSI_TEXT"],
            "VIDEO": js_data[i]["VIDEO"],
            "GAMBAR": js_data[i]["GAMBAR"],
            "JAM OPERASIONAL": js_data[i]["JAM_OPERASIONAL"],
            "HARI OPERASIONAL": js_data[i]["HARI_OPERASIONAL"]
            }
        })
        }

    map.on('load', ()=> {
        map.addSource('places', {
        'type': 'geojson',
        'data': stores
        });

        addMarker();

        buildListing();

       
    })

    function addMarker() {
        // tampilkan data GeoJSON DOM HTML
        for (const marker of stores.features) {
        const el = document.createElement('div');
        el.id = `marker-${marker.properties["ID"]}`
        el.className = 'marker'

        new mapboxgl.Marker(el)
            .setLngLat(marker.geometry.coordinates)
            .addTo(map)

        el.addEventListener('click',()=> {
            //terbang ke point yang di klik
            flyToStore(marker)
            // tutup semua popup yang lain dan tampilkan popup point yang di kliked
            createPopUp(marker)
        })

        }
    }

    function flyToStore (currentFeature) {
        map.flyTo({
        center: currentFeature.geometry.coordinates,
        zoom: 15
        });
    }

    function createPopUp(currentFeature) {
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

        
        popUps[0].addEventListener("click", () =>{
        popUps[0].remove();
        })
    }

    // tangkap element div dengan id sidebarmodal
    const listing = document.getElementById('listing');

    function buildListing () {
         // tampilkan data ke dalam list daftar wisata
        for (const data of stores.features) {
        const ItemList = document.createElement('div');
        ItemList.classList.add('card' , 'w-100', 'mb-2', )
        ItemList.style.cursor = "pointer"
        
        ItemList.innerHTML = `
            <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title">
                <p class= "fw-bold" >${data.properties["ID"]}</p>
                <p class="card-subtitle mb-2 text-muted">${data.properties["NAMA"]}</p>
            </div>
            <a href="#" class="card-link">DETAIL</a>
            </div>
        `;

        ItemList.addEventListener("click", () => {
          flyToStore(data);
          createPopUp(data)
        })

        listing.appendChild(ItemList)

      }

      // tangkap element search
      const search = document.getElementById('search');
      const result = document.getElementById('result');
      let search_term = '' ;
      
      
      search.addEventListener('input', (event) => {
        search_term = event.target.value.toLowerCase();
        showList();
      })

      const showList = () => {
        if (search_term.length >= 1) {
          result.classList.remove('d-none');
        } else {
          result.classList.add('d-none')
        }

        result.innerHTML = '';
        stores.features.filter((item)=> {
          return (
            item.properties["NAMA"].toLowerCase().includes(search_term)
          )
        })
        .forEach(el => {
          const createElItem = document.createElement('div');
          createElItem.id = `ID-${el.properties["ID"]}`
          createElItem.classList.add('p-2', 'mt-2');
          createElItem.innerHTML = `
            <span style="display: block;" class="fw-bold pb-2">${el.properties["NAMA"]}</span>
          `;
          createElItem.addEventListener('click', ()=> {
            flyToStore(el);
            createPopUp(el);
          })
          result.appendChild(createElItem)
        });
      }

    }
    </script>
</body>
</html>
