<?php
// Simple router to pages folder
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIMRIH - Sistem Informasi Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="d-flex" id="wrapper">
    <div class="border-end bg-dark text-white" id="sidebar-wrapper">
        <div class="sidebar-heading text-center py-4 fs-4 fw-bold border-bottom">
            <i class="bi bi-box-seam"></i> SIMRIH
        </div>
        <div class="list-group list-group-flush my-3">
            <a href="index.php" class="list-group-item list-group-item-action bg-dark text-white">
                <i class="bi bi-house"></i> Beranda
            </a>
            <a href="pages/produk-input.php" class="list-group-item list-group-item-action bg-dark text-white">
                <i class="bi bi-plus-circle"></i> Input Produk
            </a>
            <a href="pages/produk-list.php" class="list-group-item list-group-item-action bg-dark text-white">
                <i class="bi bi-table"></i> Daftar Produk
            </a>
            <a href="pages/kategori.php" class="list-group-item list-group-item-action bg-dark text-white">
                <i class="bi bi-tags"></i> Kategori
            </a>
        </div>
    </div>

    <div id="page-content-wrapper" class="w-100">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary" id="menu-toggle"><i class="bi bi-list"></i></button>
                <a class="navbar-brand ms-3" href="#">Beranda</a>
            </div>
        </nav>

        <div class="container-fluid p-4">
            <h3 class="fw-bold">Aplikasi SIMRIH</h3>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Selamat Datang!</h5>
                    <p>Sistem Informasi Manajemen Produk (SIMRIH) adalah aplikasi CRUD untuk mengelola data produk dan kategori menggunakan PHP OOP.</p>
                    <a href="pages/produk-input.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Input Produk</a>
                    <a href="pages/produk-list.php" class="btn btn-success"><i class="bi bi-table"></i> Lihat Daftar Produk</a>
                    <a href="pages/kategori.php" class="btn btn-warning"><i class="bi bi-tags"></i> Kelola Kategori</a>
                </div>
            </div>
        </div>

        <footer class="text-center py-3 mt-4 border-top">
            <small>Copyright © 2025 SIMRIH Developer.</small>
        </footer>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const toggleButton = document.getElementById('menu-toggle');
const wrapper = document.getElementById('wrapper');
toggleButton.addEventListener('click', () => wrapper.classList.toggle('toggled'));
</script>
</body>
</html>

