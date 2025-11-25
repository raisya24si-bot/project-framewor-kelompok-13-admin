<!-- plugins:js -->
<script src="{{ asset('fasilitas-admin/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<script src="{{ asset('fasilitas-admin/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('fasilitas-admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('fasilitas-admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('fasilitas-admin/js/dataTables.select.min.js') }}"></script>
<!-- End plugin js -->

<!-- inject:js -->
<script src="{{ asset('fasilitas-admin/js/off-canvas.js') }}"></script>
<script src="{{ asset('fasilitas-admin/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('fasilitas-admin/js/template.js') }}"></script>
<script src="{{ asset('fasilitas-admin/js/settings.js') }}"></script>
<script src="{{ asset('fasilitas-admin/js/todolist.js') }}"></script>
<!-- endinject -->

<!-- Custom js for this page -->
<script src="{{ asset('fasilitas-admin/js/dashboard.js') }}"></script>
<script src="{{ asset('fasilitas-admin/js/Chart.roundedBarCharts.js') }}"></script>
<!-- End custom js -->


<!-- ============================================================
    🔥 FIX FINAL: MATIKAN DATATABLES KHUSUS HALAMAN FASILITAS
=============================================================== -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    // Jika halaman URL mengandung "/fasilitas", matikan DataTables
    if (window.location.pathname.includes('/fasilitas')) {

        console.log("🔴 DataTables dimatikan untuk halaman Fasilitas.");

        // MATIKAN plugin DataTables agar tidak auto-initialize
        $.fn.dataTable = undefined;
        $.fn.DataTable = undefined;

        // Hapus wrapper DataTables jika sudah terlanjur terbentuk
        $('.dataTables_wrapper').remove();
    }

    // =============================================================
    // ⚠️ Nonaktifkan inisialisasi DataTables global di fasilitas
    // =============================================================
    const fasilitasTable = $('#fasilitas-table');
    if (fasilitasTable.length && !window.location.pathname.includes('/fasilitas')) {

        // Ini hanya aktif untuk halaman lain, bukan fasilitas
        fasilitasTable.DataTable({
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data ditemukan",
                info: "Menampilkan _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data tersedia",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "›",
                    previous: "‹"
                }
            },
            pageLength: 5,
            responsive: true
        });
    }
});
</script>
<!-- Placeholder untuk script tambahan dari halaman tertentu -->
@stack('scripts')
