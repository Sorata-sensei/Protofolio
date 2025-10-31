<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toastEls = document.querySelectorAll('.toast');
        toastEls.forEach((toastEl, index) => {
            const delay = 5000 * (index + 1); // Delay toast 5 detik berturut-turut
            const toast = new bootstrap.Toast(toastEl, {
                delay: delay
            });
            toast.show(); // Menampilkan toast
        });
    });
</script>


<!-- Bootstrap core JavaScript-->
<script src="{{ url('admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ url('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ url('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ url('admin/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ url('admin/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ url('admin/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ url('admin/js/demo/chart-pie-demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
