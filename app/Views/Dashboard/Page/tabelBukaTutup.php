<?= $this->extend('Dashboard/layout'); ?>

<?php $session = \Config\Services::session() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
  <div id="flash" data-flash="<?= $session->getFlashdata('success') ? $session->getFlashdata('success') : $session->getFlashdata('failed')  ?>"></div>
  <!-- data tables example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Table Buku Tutup Wisata</h6>
    </div>
    <div class="card-body">
      <!--search -->
      <div class="d-flex flex-column flex-md-row justify-content-center align-items-center align-items-md-start justify-content-md-end mb-3">
        <div class="min-vw-25 mb-3 card rounded shadow">
          <form action="<?= base_url('/Dashboard/bukatutup/search') ?>" method="get" autocomplete="off">
            <div class="d-flex p-2 align-items-center">
              <input type="text" name="keyword" value="" class="form-control me-2" placeholder="Search">
              <button class="btn btn-primary btn-sm ms-2" type="submit"><i class="fas fa-search"></i></button>
            </div>
          </form>
        </div>
      </div>

      <div class="table-responsive">
        <table class=" table table-bordered" width='100%' cellspacing='0'>
          <thead>
            <tr>
              <th class="table-info text-center">Kode Jam Operasional</th>
              <th class="table-info text-center">Jam Operasional</th>
              <th class="table-info text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($pageropenclose as $row) : ?>
              <tr>
                <td class="text text-center"><?= $row["KODE_JAM_OPERASI"]; ?></td>
                <td class="text text-center"><?= $row["JAM_OPERASIONAL"]; ?></td>
                <td class="text-center">
                  <a href="#" class="btn btn-success btn-sm btn-icon-split" type="button" data-bs-toggle="modal" data-bs-target="#EditModal-<?= $row["KODE_JAM_OPERASI"] ?>">
                    <span class="icon text-white-50">
                      <i class="fas fa-pen-to-square"></i>
                    </span>
                    <span class="text">Edit</span>
                  </a>
                  <button data-id="<?= $row["KODE_JAM_OPERASI"]; ?>" class="btn btn-danger btn-sm btn-icon-split delete">
                    <span class="icon text-white-50">
                      <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Hapus</span>
                  </button>
                </td>
              </tr>
              <!-- modal edit -->
              <div class="modal fade" id="EditModal-<?= $row["KODE_JAM_OPERASI"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title font-weight-bold text-gray-800" id="exampleModalLabel">Edit Buka Tutup dengan ID <?= $row["KODE_JAM_OPERASI"]; ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="<?= base_url('/Dashboard/bukatutup/' . $row["KODE_JAM_OPERASI"] . '/edit') ?>" method="post">
                        <div class="mb-3">
                          <label for="formControlID" class="form-label">Kode Jam Operasi</label>
                          <input type="text" class="form-control" name="kode_jam_operasi" id="formControlID" value="<?= $row["KODE_JAM_OPERASI"] ?>">
                        </div>
                        <div class="mb-3">
                          <label for="formControlJamOperasional" class="form-label">Jam Operasional</label>
                          <input type="text" class="form-control" name="jam_operasional" id="formControlamOperasional" value="<?= $row["JAM_OPERASIONAL"] ?>">
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
          window.location.href = `https://site.com/Dashboard/bukatutup/${getID}/delete`;
        }
      })
    })
  }
</script>
<?= $this->endSection(); ?>