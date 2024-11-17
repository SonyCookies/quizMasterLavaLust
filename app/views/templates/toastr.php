<script>
  <?php
  $_lava = &lava_instance();

  if ($_lava->session->flashdata('success')): ?>
    toastr.success('<?php echo $_lava->session->flashdata('success'); ?>');
  <?php endif; ?>
  <?php if ($_lava->session->flashdata('error')): ?>
    toastr.error('<?php echo $_lava->session->flashdata('error'); ?>');
  <?php endif; ?>

  <?php if ($_lava->session->flashdata('info')): ?>
    toastr.info('<?php echo $_lava->session->flashdata('info'); ?>');
  <?php endif; ?>

  <?php if ($_lava->session->flashdata('warning')): ?>
    toastr.warning('<?php echo $_lava->session->flashdata('warning'); ?>');
  <?php endif; ?>
</script>