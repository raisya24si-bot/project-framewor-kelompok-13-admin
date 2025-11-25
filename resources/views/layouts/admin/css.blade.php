<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>@yield('title', 'Skydash Admin')</title>

<!-- plugins:css -->
<link rel="stylesheet" href="{{ asset('fasilitas-admin/vendors/feather/feather.css') }}">
<link rel="stylesheet" href="{{ asset('fasilitas-admin/vendors/ti-icons/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('fasilitas-admin/vendors/css/vendor.bundle.base.css') }}">
<!-- endinject -->

<!-- Plugin css for this page -->
<link rel="stylesheet" href="{{ asset('fasilitas-admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('fasilitas-admin/js/select.dataTables.min.css') }}">
<!-- End plugin css -->

<!-- inject:css -->
<link rel="stylesheet" href="{{ asset('fasilitas-admin/css/vertical-layout-light/style.css') }}">
<!-- endinject -->

<link rel="shortcut icon" href="{{ asset('fasilitas-admin/images/favicon.png') }}" />

<!-- ✅ Custom CSS tambahan untuk tampilan modern -->
<style>
/* ===================================
   GLOBAL LAYOUT
=================================== */
body {
    background-color: #f8f9fc;
}

.content-wrapper {
    padding: 2rem 2.5rem;
}

.page-header {
    margin-bottom: 1.5rem;
}

/* ===================================
   CARD STYLE
=================================== */
.card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.card-body {
    padding: 2rem 2.5rem;
}

/* ===================================
   FORM ELEMENTS
=================================== */
label {
    color: #4b4b4b;
    font-weight: 600;
    margin-bottom: 6px;
    font-size: 0.9rem;
}

.form-control,
.form-select {
    border-radius: 8px;
    border: 1px solid #dcdcdc;
    box-shadow: none;
    transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.form-control:focus,
.form-select:focus {
    border-color: #6f42c1;
    box-shadow: 0 0 0 0.15rem rgba(111, 66, 193, 0.25);
}

textarea.form-control {
    resize: none;
}

/* ===================================
   BUTTONS
=================================== */
.btn {
    border-radius: 10px;
    padding: 0.6rem 1.2rem;
    transition: all 0.2s ease-in-out;
    font-weight: 600;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.btn-primary {
    background-color: #6f42c1;
    border-color: #6f42c1;
}

.btn-primary:hover {
    background-color: #59339b;
    border-color: #59339b;
}

.btn-sm {
    padding: 6px 12px !important;
    border-radius: 8px !important;
}

/* ===================================
   FILTER FASILITAS (KHUSUS HALAMAN FASILITAS)
=================================== */
#filter-fasilitas .form-row {
    display: flex;
    gap: 12px;
    align-items: center;
}

#filter-fasilitas input.form-control,
#filter-fasilitas select.form-control {
    height: 45px;
    border-radius: 10px;
}

#filter-fasilitas .col-md-4,
#filter-fasilitas .col-md-3,
#filter-fasilitas .col-md-2 {
    margin-bottom: 0 !important;
}

/* ===================================
   TABLE FIX
=================================== */
table.table thead th {
    background: #f1f1f7 !important;
    color: #333;
    font-weight: 700;
    padding: 18px 12px;
}

table.table tbody tr {
    border-bottom: 1px solid #e5e5e5;
}

table.table tbody tr:hover {
    background: #f9f9fc;
}

.table-responsive {
    padding: 0 5px;
}

/* ===================================
   PAGINATION
=================================== */
.pagination {
    gap: 6px;
}

.page-item .page-link {
    border-radius: 8px !important;
    padding: 8px 14px;
    font-weight: 600;
}

.page-item .page-link:hover {
    background: #6f42c1 !important;
    color: white !important;
}

.page-item.active .page-link {
    background: #6f42c1 !important;
    border-color: #6f42c1 !important;
}

/* ===================================
   RESPONSIVE FIX
=================================== */
@media (max-width: 992px) {
    .content-wrapper {
        padding: 1.5rem 1rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    #filter-fasilitas .form-row {
        flex-direction: column;
        gap: 10px;
    }
}

@media (max-width: 576px) {
    .page-header h3 {
        font-size: 1.2rem;
    }

    label {
        font-size: 0.85rem;
    }

    .form-control,
    .form-select {
        font-size: 0.85rem;
    }
}
</style>
