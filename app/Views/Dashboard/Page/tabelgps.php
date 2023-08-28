<?= $this->extend('Dashboard/layout'); ?>

<?php $session = \Config\Services::session(); ?>

<?= $this->section('content') ?>
<div class="container-fluid">
  <div id="flash" data-flash="<?= $session->getFlashdata('success') ? $session->getFlashdata('success') : $session->getFlashdata('failed') ?>"></div>
  <!-- data tables example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Table GPS Wisata</h6>
    </div>
    <div class="card-body">
      <!--search -->
      <div class="w-25 mb-3 ms-auto card rounded shadow">
        <form action="<?= base_url('/Dasgboard/gps/search') ?>" method="get" autocomplete="off">
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
              <th class="table-info">Id Gps</th>
              <th class="table-info">Id Wisata</th>
              <th class="table-info">Kode Pos</th>
              <th class="table-info">Longitude</th>
              <th class="table-info">Altitude</th>
              <th class="table-info">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data_gps_pager as $row) : ?>
              <tr>
                <td class="text"><?= $row["KODE"]; ?></td>
                <td class="text"><?= $row["ID"]; ?></td>
                <td class="text"><?= $row["KODE_POS"]; ?></td>
                <td class="text"><?= $row["LONGITUDE"] ?></td>
                <td class="text"><?= $row["ALTITUDE"]; ?></td>
                <td>
                  <a href="#" class="btn btn-success btn-sm btn-icon-split" type="button" data-bs-toggle="modal" data-bs-target="#EditModal-<?= $row["KODE"] ?>">
                    <span class="icon text-white-50">
                      <i class="fas fa-pen-to-square"></i>
                    </span>
                    <span class="text">Edit</span>
                  </a>
                  <button data-id="<?= $row["KODE"]; ?>" class="btn btn-danger btn-sm btn-icon-split delete">
                    <span class="icon text-white-50">
                      <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Hapus</span>
                  </button>
                </td>
              </tr>
              <!-- modal edit -->
              <div class="modal fade" id="EditModal-<?= $row["KODE"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title font-weight-bold text-gray-800" id="exampleModalLabel">Edit Gps Wisata dengan ID <?= $row["KODE"]; ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="<?= base_url('/Dashboard/gps/' . $row["KODE"] . '/edit') ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                          <label for="formControlID" class="form-label">Id GPS</label>
                          <input type="text" class="form-control" name="kode_gps" id="formControlID" value="<?= $row["KODE"] ?>" disabled readonly>
                        </div>
                        <div class="mb-3">
                          <label for="formControlIDWisata" class="form-label">ID Wisata</label>
                          <select class="form-select" name="kode_wisata" aria-label="Default select example" id="formControlIDWisata">
                            <option selected value="<?= $row["ID"]; ?>"><?= $row["ID"]; ?></option>
                            <?php foreach ($id_Wisata as $item) : ?>
                              <option value="<?= $item["ID"]; ?>"><?= $item["ID"]; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="formControlKode_Pos" class="form-label">Kode Pos</label>
                          <select class="form-select" name="kode_pos" aria-label="Default select example" id="formControlKode_Pos">
                            <option selected value="<?= $row["KODE_POS"]; ?>"><?= $row["KODE_POS"]; ?></option>
                            <?php foreach ($kode_pos as $item2) : ?>
                              <option value="<?= $item2["KODE_POS"]; ?>"><?= $item2["KODE_POS"]; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="formControlLng" class="form-label">Longitude</label>
                          <input type="text" class="form-control" name="longitude" id="formControlLng" value="<?= $row["LONGITUDE"] ?>">
                        </div>
                        <div class="mb-3">
                          <label for="formControlAltitude" class="form-label">Altitude</label>
                          <input type="text" class="form-control" name="altitude" id="formControlAltitude" value="<?= $row["ALTITUDE"] ?>">
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
          window.location.href = `https://site.com/Dashboard/gps/${getID}/delete`;
        }
      })
    })
  }
</script>
<?= $this->endSection(); ?>