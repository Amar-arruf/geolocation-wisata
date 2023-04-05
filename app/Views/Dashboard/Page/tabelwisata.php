<?= $this->extend('Dashboard/layout'); ?>

<?= $this->section('content') ?>
  <div class="container-fluid">
      <!-- data tables example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data Table Wisata</h6>
        </div>
        <div class="card-body">
          <!--search -->
          <div class="w-25 mb-3 ms-auto card rounded shadow">
            <form action="<?= base_url('Dashboard/tabelwisata/search')?>" method="get" autocomplete="off">
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
                <?php foreach($pagerWisata as $row) :?>
                  <tr>
                    <td class="text"><?= $row["ID"]; ?></td>
                    <td class="text"><?= $row["NAMA"]; ?></td>
                    <td class="text"><?= $row["VIDEO"]; ?></td>
                    <td class="text"><?= substr($row["DESKRIPSI_TEXT"],0,40); ?>...</td>
                    <td class="text"><?= $row["GAMBAR"]; ?></td>
                    <td>
                      <a href="#" class="btn btn-success btn-sm btn-icon-split">
                          <span class="icon text-white-50">
                              <i class="fas fa-pen-to-square"></i>
                          </span>
                          <span class="text">Edit</span>
                      </a>
                      <a href="#" class="btn btn-danger btn-sm btn-icon-split">
                          <span class="icon text-white-50">
                              <i class="fas fa-trash"></i>
                          </span>
                          <span class="text">Hapus</span>
                      </a>

                    </td>
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table>
            <!-- pagination -->
            <?= $pager->links('default', 'custom_template') ?>
          </div>
        </div>
      </div>
  </div>

<?= $this->endSection(); ?>