<?= $this->extend("DashboardAdmin/layoutAdmin"); ?>

<?php $session = \Config\Services::session(); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
  <div id="flash" data-flash="<?= $session->getFlashdata('success') ? $session->getFlashdata('success') : $session->getFlashdata('failed') ?>"></div>
  <!-- data user example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
    </div>
    <div class="card-body">
      <!--search -->
      <div class="w-25 mb-3 ms-auto card rounded shadow">
        <form action="<?= base_url('admin/useradata/search') ?>" method="get" autocomplete="off">
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
              <th class="table-info text-center">Id</th>
              <th class="table-info text-center">Username</th>
              <th class="table-info text-center">Gambar Profil</th>
              <th class="table-info text-center">Email</th>
              <th class="table-info text-center">Status</th>
              <th class="table-info text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($datauser as $row) : ?>
              <tr>
                <td class="text text-center"><?= $row["ID_USER"]; ?></td>
                <td class="text text-center"><?= $row["USERNAME"]; ?></td>
                <td class="text text-center">
                  <?php if ($row["GAMBAR_PROFIL"] != "") : ?>
                    <img src="<?= $row["GAMBAR_PROFIL"] ?>" class="rounded-circle" style="width: 50px ;height: 50px ;" alt="<?= $row["USERNAME"] ?>">
                  <?php else : ?>
                    <div><i class="fa-solid fa-circle-user fa-3x text-gray-400"></i></div>
                  <?php endif; ?>
                </td>
                <td class="text text-center"><?= $row["EMAIL"]; ?></td>
                <td class="text text-center"><?= $row["STATUS"]; ?></td>
                <td class="text-center">
                  <button data-id="<?= $row["ID_USER"] ?>" class="btn btn-success btn-sm btn-icon-split edit">
                    <span class="icon text-white-50">
                      <i class="fas fa-pen-to-square"></i>
                    </span>
                    <span class="text">Ubah status</span>
                  </button>
                  <button data-id="<?= $row["ID_USER"]; ?>" class="btn btn-danger btn-sm btn-icon-split delete">
                    <span class="icon text-white-50">
                      <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Hapus</span>
                  </button>
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

      Swal.fire({
        title: 'kamu yakin?',
        text: `ingin menghapus data dengan id ${getID}`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ya, hapus itu!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = `http://geolocationwisata6-lesn7050.b4a.run/admin/userdata/${getID}/hapus`;
        }
      })
    })
  }

  const buttonEdit = document.getElementsByClassName('edit');
  for (const EditItem of buttonEdit) {
    EditItem.addEventListener("click", (e) => {
      e.preventDefault();
      const dapatID = EditItem.getAttribute('data-id');

      Swal.fire({
        title: `kamu ingin mengubah status dari akun dengan id ${dapatID} ?`,
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Simpan',
        denyButtonText: `Batal`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          window.location.href = `http//geolocationwisata6-lesn7050.b4a.run/admin/userdata/${dapatID}/edit`
        } else if (result.isDenied) {
          Swal.fire('Perubahan tidak tersimpan!', '', 'info')
        }
      })
    })

  }
</script>
<?= $this->endSection(); ?>