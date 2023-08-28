<div id="sidebarmodal" class="position-absolute bg-body-secondary rounded-4 shadow overflow-hidden">
  <div class="p-2 text-center text-uppercase text-light bg-primary" style="font-family: sans-serif;">
    <h6> list wisata</h6>
  </div>
  <div id="listing" class="m-2 overflow-auto ">
    <?php if (count($getData) === 0) : ?>
      <h6 class="text-center">Data Belum ada</h6>
    <?php endif; ?>
  </div>

</div>