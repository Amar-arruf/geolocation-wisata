<?= $this->extend('Dashboard/layout'); ?>

<?php $session = \Config\Services::session(); ?>

<?= $this->section('content') ?>
<div class="container-fluid">
  <div id="flash" data-flash="<?= $session->getFlashdata('success') ? $session->getFlashdata('success') : $session->getFlashdata('failed') ?>"></div>
  <!-- data tables example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Table Wisata</h6>
    </div>
    <div class="card-body">
      <!--search -->
      <div class="w-25 mb-3 ms-auto card rounded shadow">
        <form action="<?= base_url('Dashboard/tabelwisata/search') ?>" method="get" autocomplete="off">
          <div class="d-flex p-2 align-items-center">
            <input type="text" name="keyword" value="" class="form-control me-2" placeholder="Search">
            <button class="btn btn-primary btn-sm ms-2" type="submit"><i class="fas fa-search"></i></button>
          </div>
        </form>
      </div>
      <div class="table-responsive">
        <table class=" table table-bordered" width='100%' cellspacing='0'>
          <thead>
            <tr>
              <th class="table-info">Id</th>
              <th class="table-info">Nama</th>
              <th class="table-info">Video</th>
              <th class="table-info">Deskripsi text</th>
              <th class="table-info">Gambar</th>
              <th class="table-info">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($pagerWisata as $row) : ?>
              <tr>
                <td class="text"><?= $row["ID"]; ?></td>
                <td class="text"><?= $row["NAMA"]; ?></td>
                <td class="text"><?= $row["VIDEO"]; ?></td>
                <td class="text"><?= substr($row["DESKRIPSI_TEXT"], 0, 40); ?>...</td>
                <td class="text"><?= $row["GAMBAR"]; ?></td>
                <td>
                  <a href="#" class="btn btn-success btn-sm btn-icon-split" type="button" data-bs-toggle="modal" data-bs-target="#EditModal-<?= $row["ID"] ?>">
                    <span class="icon text-white-50">
                      <i class="fas fa-pen-to-square"></i>
                    </span>
                    <span class="text">Edit</span>
                  </a>
                  <button data-id="<?= $row["ID"]; ?>" data-publicIdImg="<?= str_replace(".jpg", "", $row["GAMBAR"]) ?>" data-publicIdVid="<?= str_replace(".mp4", "", $row["VIDEO"]) ?>" class="btn btn-danger btn-sm btn-icon-split delete">
                    <span class="icon text-white-50">
                      <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Hapus</span>
                  </button>
                </td>
              </tr>
              <!-- modal edit -->
              <div class="modal fade" id="EditModal-<?= $row["ID"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title font-weight-bold text-gray-800" id="exampleModalLabel">Edit Wisata dengan ID <?= $row["ID"]; ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="<?= base_url('/Dashboard/tabelwisata/' . $row["ID"] . '/edit') ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                          <label for="formControlID" class="form-label">id</label>
                          <input type="text" class="form-control" name="id" id="formControlID" placeholder="ID" value="<?= $row["ID"] ?>" disabled readonly>
                        </div>
                        <div class="mb-3">
                          <label for="formControlname" class="form-label">Nama Wisata</label>
                          <input type="text" class="form-control" name="nama" id="formControlname" placeholder="Nama Wisata" value="<?= $row["NAMA"] ?>">
                        </div>
                        <div class="mb-3">
                          <label for="formControlVideo" class="form-label">Video</label>
                          <input type="file" class="form-control" name="video" id="formControlVideo" placeholder="Video beserta ekstensi sesuai diupload di cloaud" value="<?= $row["VIDEO"] ?>">
                        </div>
                        <div class="mb-3">
                          <label for="formControlDesc" class="form-label">Deskripsi Text</label>
                          <textarea class="form-control" name="desc" id="formControlDesc" placeholder="Berikan Desc Wisata" rows="3"><?= $row["DESKRIPSI_TEXT"] ?></textarea>
                        </div>
                        <input type="hidden" class="form-control" name="publicId" value="foto_geoloccation/<?= strpos($row["GAMBAR"], ".jpg") == true ? str_replace(".jpg", "", $row["GAMBAR"]) : str_replace(".webp", "", $row["GAMBAR"])  ?>">
                        <input type="hidden" class="form-control" name="publicIdVideo" value="Video_geolocation/<?= str_replace(".mp4", "", $row["VIDEO"]) ?>">
                        <div class="mb-3">
                          <label for="formControlGambar" class="form-label">Gambar</label>
                          <input type="file" class="form-control" name="gambar" id="formControlGambar" placeholder="file Gambar beserta ekstensi yang disimpan di cloud" value="<?= $row["GAMBAR"] ?>">
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
            <?php endforeach; ?>
          </tbody>
        </table>
        <!-- pagination -->
        <?= $pager->links('default', 'custom_template') ?>
      </div>
    </div>
  </div>
</div>

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
<script>
  const buttonDeletedData = document.getElementsByClassName('delete')
  console.log(buttonDeletedData);
  for (const DeleteItem of buttonDeletedData) {
    DeleteItem.addEventListener("click", (e) => {
      e.preventDefault();
      const getID = DeleteItem.getAttribute('data-id');
      const publicIdImg = DeleteItem.getAttribute('data-publicIdImg');
      const publicIdVid = DeleteItem.getAttribute('data-publicIdVid');

      Swal.fire({
        title: 'Apa kamu yakin?',
        text: `ingin menghapus data dengan id ${getID}`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ya, hapus itu!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = `https://site.com/Dashboard/tabelwisata/${getID}/${publicIdImg}/${publicIdVid}/delete`;
        }
      })
    })
  }
</script>

<?= $this->endSection(); ?>