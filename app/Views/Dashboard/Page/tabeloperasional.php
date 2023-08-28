<?= $this->extend('Dashboard/layout'); ?>

<?php $session = \Config\Services::session() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
  <div id="flash" data-flash="<?= $session->getFlashdata('success') ? $session->getFlashdata('success') : $session->getFlashdata('failed') ?>"></div>
  <!-- data tables example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Table Hari operasinal Wisata</h6>
    </div>
    <div class="card-body">
      <!--search -->
      <div class="w-25 mb-3 ms-auto card rounded shadow">
        <form action="<?= base_url('/Dashboard/harioperasi/search') ?>" method="get" autocomplete="off">
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
              <th class="table-info text-center">ID Operasi</th>
              <th class="table-info text-center">Kode Pos</th>
              <th class="table-info text-center">Kode Uploader</th>
              <th class="table-info text-center">Id Wisata</th>
              <th class="table-info text-center">Kode Jam Operasi</th>
              <th class="table-info text-center">Hari Operasional</th>
              <th class="table-info text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($PagerHariOperasional as $row) : ?>
              <tr>
                <td class="text text-center"><?= $row["ID_OPERASIONAL"]; ?></td>
                <td class="text text-center"><?= $row["KODE_POS"]; ?></td>
                <td class="text text-center"><?= $row["KODE_UPLOADER"]; ?></td>
                <td class="text text-center"><?= $row["ID"]; ?></td>
                <td class="text text-center"><?= $row["KODE_JAM_OPERASI"]; ?></td>
                <td class="text text-center"><?= $row["HARI_OPERASIONAL"]; ?></td>
                <td class="text-center">
                  <a href="#" class="btn btn-success btn-sm btn-icon-split" type="button" data-bs-toggle="modal" data-bs-target="#EditModal-<?= $row["ID_OPERASIONAL"] ?>">
                    <span class="icon text-white-50">
                      <i class="fas fa-pen-to-square"></i>
                    </span>
                    <span class="text">Edit</span>
                  </a>
                  <button data-id="<?= $row["ID_OPERASIONAL"]; ?>" class="btn btn-danger btn-sm btn-icon-split delete">
                    <span class="icon text-white-50">
                      <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Hapus</span>
                  </button>
                </td>
              </tr>
              <!-- modal edit -->
              <div class="modal fade" id="EditModal-<?= $row["ID_OPERASIONAL"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title font-weight-bold text-gray-800" id="exampleModalLabel">Edit Buka Tutup dengan ID <?= $row["ID_OPERASIONAL"]; ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="<?= base_url('/Dashboard/harioperasi/' . $row["ID_OPERASIONAL"] . '/edit') ?>" method="post">
                        <div class="mb-3">
                          <label for="formControlID" class="form-label">Id operasional</label>
                          <input type="text" class="form-control" name="id_operasional" id="formControlID" value="<?= $row["ID_OPERASIONAL"] ?>" disabled readonly>
                        </div>
                        <div class="mb-3">
                          <label for="formControlKode_pos" class="form-label">Kode Pos</label>
                          <select class="form-select" name="kode_pos" aria-label="Default select example" id="formControlKode_pos">
                            <option selected value="<?= $row["KODE_POS"]; ?>"><?= $row["KODE_POS"]; ?></option>
                            <?php foreach ($kode_pos as $item) : ?>
                              <option value="<?= $item["KODE_POS"]; ?>"><?= $item["KODE_POS"]; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="formControlKode_upload" class="form-label">Kode Uploader</label>
                          <select class="form-select" name="kode_uploader" aria-label="Default select example" id="formControlKode_upload">
                            <option selected value="<?= $row["KODE_UPLOADER"]; ?>"><?= $row["KODE_UPLOADER"]; ?></option>
                            <?php foreach ($kode_uploader as $item) : ?>
                              <option value="<?= $item["KODE_UPLOADER"]; ?>"><?= $item["KODE_UPLOADER"]; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="formControlId_Wisata" class="form-label">Id Wisata</label>
                          <select class="form-select" name="id_wisata" aria-label="Default select example" id="formControlId_Wisata">
                            <option selected value="<?= $row["ID"]; ?>"><?= $row["ID"]; ?></option>
                            <?php foreach ($id_wisata as $item) : ?>
                              <option value="<?= $item["ID"]; ?>"><?= $item["ID"]; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="formControlKode_jam" class="form-label">Jam Operasional</label>
                          <select class="form-select" name="kode_jam" aria-label="Default select example" id="formControlKode_jam">
                            <option selected value="<?= $row["KODE_JAM_OPERASI"]; ?>"><?= $row["KODE_JAM_OPERASI"]; ?></option>
                            <?php foreach ($kode_jam as $item) : ?>
                              <option value="<?= $item["KODE_JAM_OPERASI"]; ?>"><?= $item["KODE_JAM_OPERASI"]; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="formControlDays" class="form-label">hari operasional</label>
                          <input type="text" class="form-control" name="hari_operasional" id="formControlDays" value="<?= $row["HARI_OPERASIONAL"] ?>">
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
      'Good job!',
      data,
      'success'
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
          window.location.href = `https://site.com/Dashboard/harioperasi/${getID}/delete`;
        }
      })
    })
  }
</script>
<?= $this->endSection(); ?>