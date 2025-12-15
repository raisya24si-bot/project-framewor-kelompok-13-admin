<!-- ================= SCRIPT GLOBAL ================= -->

<!-- plugins:js -->
<script src="{{ asset('fasilitas-admin/vendors/js/vendor.bundle.base.js') }}"></script>

<!-- Chart.js (SATU-SATUNYA, JANGAN DOUBEL) -->
<script src="{{ asset('fasilitas-admin/vendors/chart.js/Chart.min.js') }}"></script>

<!-- Template core -->
<script src="{{ asset('fasilitas-admin/js/off-canvas.js') }}"></script>
<script src="{{ asset('fasilitas-admin/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('fasilitas-admin/js/template.js') }}"></script>
<script src="{{ asset('fasilitas-admin/js/settings.js') }}"></script>
<script src="{{ asset('fasilitas-admin/js/todolist.js') }}"></script>

<!-- SCRIPT DARI HALAMAN (Dashboard, dll) -->
@stack('scripts')
