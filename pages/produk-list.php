<?php
// ======================================================
// BAGIAN AWAL: Koneksi ke class MasterData (CRUD utama)
// ======================================================

// Memanggil file class-master.php yang berisi class Database & MasterData
include_once __DIR__ . '/../config/class-master.php';

// Membuat objek dari class MasterData
$master = new MasterData();

// Memanggil fungsi getAllProduk() untuk mengambil semua data produk dari database
$data = $master->getAllProduk();

// ======================================================
// PROSES HAPUS PRODUK
// ======================================================
// Jika terdapat parameter 'hapus' di URL (misal: ?hapus=3)
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']); // Mengubah nilai menjadi integer untuk keamanan

    // Memanggil fungsi deleteProduk() dari class MasterData
    if ($master->deleteProduk($id)) {
        // Jika berhasil, tampilkan pesan dan reload halaman daftar produk
        echo "<script>
                alert('Produk berhasil dihapus!');
                window.location='produk-list.php';
              </script>";
    } else {
        // Jika gagal, tampilkan alert gagal
        echo "<script>alert('Gagal menghapus produk!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk - SIMEBEL</title>
    <!-- Bootstrap CSS untuk tampilan tabel dan tombol -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <script src="https://kit.fontawesome.com/a2e0e9e64b.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
<div class="container mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="fas fa-table"></i> Daftar Produk</h3>
        <a href="produk-input.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
    </div>

    <!-- Tabel Produk -->
    <table class="table table-bordered table-striped table-hover shadow-sm">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Telp</th>
                <th>Alamat</th>
                <th>Kategori</th>
                <th width="150px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($data && $data->num_rows > 0) { ?>
                <?php while ($row = $data->fetch_assoc()) { ?>
                <tr>
                    <td class="text-center"><?= $row['id_produk'] ?></td>
                    <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                    <td class="text-end">Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
                    <td class="text-center"><?= $row['stok'] ?></td>
                    <td><?= htmlspecialchars($row['tlpn']) ?></td>
                    <td><?= htmlspecialchars($row['alamat']) ?></td>
                    <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
                    <td class="text-center">
                        <!-- Tombol Edit -->
                        <a href="produk-edit.php?id=<?= $row['id_produk'] ?>" 
                           class="btn btn-sm btn-warning me-1">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <!-- Tombol Hapus -->
                        <a href="?hapus=<?= $row['id_produk'] ?>" 
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Yakin ingin menghapus produk ini?')">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="8" class="text-center text-muted">
                        <i>Tidak ada data produk</i>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Tombol kembali ke beranda -->
    <a href="../index.php" class="btn btn-secondary mt-3">
        <i class="fas fa-arrow-left"></i> Kembali ke Beranda
    </a>
</div>
</body>
</html>

