<?php if (count($getData) !== 0) : ?>
  <?php $i = 0; ?>
  <?php foreach ($getdataCloud->resources as $item) : ?>
    <div class="card rounded-4 shadow position-absolute overflow-hidden modalClass d-none" id="<?= $getData[$i]["ID"] ?>">
      <div class="bg-primary p-2 text-light position-absolute w-100">
        <span class="material-symbols-rounded d-block cursor-pointer close" style="text-align: right;">
          close
        </span>
      </div>
      <img src="<?= $item->secure_url ?>" class="card-img-top" alt="<?= $getData[$i]["NAMA"] ?>" style="height: 200px;">
      <div class="card-body p-1 overflow-auto">
        <h5 class="card-title bg-info text-white p-3 fw-bold">ID <?= $getData[$i]["ID"]; ?></h5>
        <p class="card-text p-3 fw-bold"><?= $getData[$i]["NAMA"] ?></p>
        <h6 class="card-title fw-bold bg-info text-white p-2">Video Deskripsi</h6>
        <?php if ($getData[$i]["VIDEO"] == NULL) : ?>
          <span>Belum ada Video</span>
        <?php else : ?>
          <video id="my-video-<?= $i ?>" class="video-js  vjs-fluid mb-2" controls data-setup='{}'>
            <source src="https://res.cloudinary.com/doclblyw3/video/upload/v<?= $getdataVideo->resources[$i]->version ?>/Video_geolocation/<?= $getData[$i]["VIDEO"] ?>" />
          </video>
        <?php endif; ?>
        <h6 class="card-title fw-bold bg-info text-white p-3">Deskripsi Wisata</h6>
        <p class="card-text p-2" style="text-align: justify;"><?= $getData[$i]["DESKRIPSI_TEXT"] ?></p>
      </div>
    </div>
    <?php ++$i; ?>
  <?php endforeach; ?>
<?php endif; ?>


<script src="https://vjs.zencdn.net/8.0.4/video.min.js"></script>


<script>
  const elementClose = document.getElementsByClassName("close");
  const elementModal = document.getElementsByClassName("modalClass")

  for (let i = 0; i < elementClose.length; i++) {
    elementClose[i].style.cursor = "pointer"
    elementClose[i].addEventListener("click", () => {
      elementModal[i].classList.add("d-none")
    })
  }
</script>