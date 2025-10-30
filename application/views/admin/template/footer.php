</div> <!-- page -->
</div> <!-- kt_app_root -->

<!-- Metronic JS -->
<script>var hostUrl = "assets/";</script>
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>

<!-- DataTables Init -->
<script>
    $(document).ready(function() {
        if ($('#kt_table_users').length) {
            $('#kt_table_users').DataTable();
        }
    });
</script>

<!-- Flash Message -->
<?php if ($this->session->flashdata('success')): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Thành công!',
        text: '<?= $this->session->flashdata('success') ?>',
        timer: 3000,
        showConfirmButton: false
    });
</script>
<?php endif; ?>

</body>
</html>