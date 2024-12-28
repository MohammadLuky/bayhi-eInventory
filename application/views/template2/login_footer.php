<script src="<?= base_url('assets/') ?>sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?= base_url('assets/') ?>js/vendor-all.min.js"></script>
<script src="<?= base_url('assets/') ?>js/plugins/bootstrap.min.js"></script>
<script src="<?= base_url('assets/') ?>admin2/js/pcoded.min.js"></script>
<script src="<?= base_url('assets/') ?>admin2/js/notif_alert.js"></script>
<!-- <script src="<?= base_url('assets/') ?>js/pcoded.min.js"></script> -->

<script>
    $(document).ready(function() {
        $(".toggle-password").click(function() {
            var input = $($(this).attr("toggle"));
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    });
</script>

</body>

</html>