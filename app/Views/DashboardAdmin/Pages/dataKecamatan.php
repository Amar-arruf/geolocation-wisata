<?= $this->extend("DashboardAdmin/layoutAdmin"); ?>
<?php $session = \Config\Services::session(); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
  <div id="flash" data-flash="<?= $session->getFlashdata('success') ? $session->getFlashdata('success') : $session->getFlashdata('failed') ?>"></div>
  <!-- data user example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Kecamatan</h6>
    </div>
    <div class="card-body">
      <!--search dan tambah -->
      <div class="d-flex align-items-center">
        <button class="btn btn-success btn-sm btn-icon-split" type="button" data-bs-toggle="modal" data-bs-target="#tambahModal">
          <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
          </span>
          <span class="text">tambah</span>
        </button>
        <div class="w-25 mb-3 ms-auto card rounded shadow">
          <form action="<?= base_url('admin/kecamatan/search') ?>" method="get" autocomplete="off">
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
              <th class="table-info text-center">Kode Pos</th>
              <th class="table-info text-center">Kecamatan</th>
              <th class="table-info text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($datakecamatan as $row) : ?>
              <tr>
                <td class="text text-center"><?= $row["KODE_POS"]; ?></td>
                <td class="text text-center"><?= $row["KECAMATAN"]; ?></td>
                <td class="text-center" width="300px">
                  <button class="btn btn-success btn-sm btn-icon-split" type="button" data-bs-toggle="modal" data-bs-target="#EditModal-<?= $row["KODE_POS"] ?>">
                    <span class="icon text-white-50">
                      <i class="fas fa-pen-to-square"></i>
                    </span>
                    <span class="text">edit kecamatan</span>
                  </button>
                  <button data-id="<?= $row["KODE_POS"]; ?>" class="btn btn-danger btn-sm btn-icon-split delete">
                    <span class="icon text-white-50">
                      <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Hapus</span>
                  </button>
                </td>
              </tr>
              <!-- modal Edit -->
              <div class="modal fade" id="EditModal-<?= $row["KODE_POS"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title font-weight-bold text-gray-800" id="exampleModalLabel">Edit Data Kecamatan dengan kode pos <?= $row["KODE_POS"]; ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="<?= base_url('admin/kecamatan/' . $row["KODE_POS"] . '/edit') ?>" method="post">
                        <div class="mb-3">
                          <label for="formControlID" class="form-label">Kode Pos</label>
                          <input type="text" class="form-control" name="id" id="formControlID" placeholder="ID" value="<?= $row["KODE_POS"] ?>" disabled readonly>
                        </div>
                        <div class="mb-3">
                          <label for="formControlname" class="form-label">Kecamatan</label>
                          <input type="text" class="form-control" name="kecamatan" id="formControlname" placeholder="Nama Wisata">
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
        <?= $datapager->links('default', 'custom_template') ?>
      </div>
    </div>
  </div>
  <!-- modal tambah -->
  <div class="modal fade" id="#tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold text-gray-800" id="exampleModalLabel">tambah Data Kecamatan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('admin/kecamatan/add') ?>" method="post">
            <div class="mb-3">
              <label for="formControlID" class="form-label">Kode Pos</label>
              <input type="text" class="form-control" name="id" id="formControlID" placeholder="kode pos">
            </div>
            <div class="mb-3">
              <label for="formControlname" class="form-label">Kecamatan</label>
              <input type="text" class="form-control" name="kecamatan" id="formControlname" placeholder="nama Kecamatan" value="<?= $row["KECAMATAN"] ?>">
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
            window.location.href = `https://geolocationwisata6-lesn7050.b4a.run/Dashboard/tabelwisata/${getID}/${publicIdImg}/${publicIdVid}/delete`;
          }
        })
      })
    }
  </script>
  <?= $this->endSection(); ?>