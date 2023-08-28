<?= $this->extend('DashboardAdmin/layoutAdmin'); ?>
<?php $session = \Config\Services::session() ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
  <div id="flash" data-flash="<?= $session->getFlashdata('success') ? $session->getFlashdata('success') : $session->getFlashdata('failed') ?>"></div>
  <!-- data user example -->
  <div class="card shadow mb-4 px-3">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Wisata user</h6>
    </div>
    <div class="card-body">
      <!--search -->
      <div class="w-25 mb-3 ms-auto card rounded shadow">
        <form action="<?= base_url('admin/datawisata/search') ?>" method="get" autocomplete="off">
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
            <th class="table-info text-center">ID Wisata</th>
            <th class="table-info text-center">Nama Wisata</th>
            <th class="table-info text-center">Video</th>
            <th class="table-info text-center">Deskripsi text</th>
            <th class="table-info text-center">Gambar</th>
            <th class="table-info text-center">Username</th>
            <th class="table-info text-center">Gambar Profil</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($dataDesa as $row) : ?>
            <tr>
              <td class="text text-center"><?= $row["ID"]; ?></td>
              <td class="text text-center"><?= $row["NAMA"]; ?></td>
              <td class="text text-center"><?= $row["VIDEO"]; ?></td>
              <td class="text text-center"><?= substr($row["DESKRIPSI_TEXT"], 0, 30); ?></td>
              <td class="text text-center"><?= $row["GAMBAR"]; ?></td>
              <td class="text text-center"><?= $row["USERNAME"]; ?></td>
              <td class="text text-center">
                <?php if ($row["GAMBAR_PROFIL"] != "") : ?>
                  <img src="<?= $row["GAMBAR_PROFIL"] ?>" class="rounded-circle" style="width: 50px ;height: 50px ;" alt="<?= $row["USERNAME"] ?>">
                <?php else : ?>
                  <div><i class="fa-solid fa-circle-user fa-3x text-gray-400"></i></div>
                <?php endif; ?>
              </td>
            </tr>

          <?php endforeach; ?>
        </tbody>
      </table>
      <!-- pagination -->
      <?= $datapager->links('default', 'custom_template') ?>
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
          window.location.href = `https://site.com/admin/desa/${getID}/hapus`;
        }
      })
    })
  }
</script>
<?= $this->endSection(); ?>