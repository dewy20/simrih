<?php
// Perbaikan utama: path file harus naik 1 folder dari /pages ke /config
include_once __DIR__ . '/../config/class-master.php';

// Buat objek dari class MasterData
$master = new MasterData();

// Cek apakah parameter id dikirim dari URL
if (!isset($_GET['id'])) {
    header('Location: produk-list.php');
    exit;
}

$id = (int) $_GET['id'];

// Ambil data produk berdasarkan ID
$produk = $master->getProdukById($id);

// Ambil semua kategori untuk dropdown
$kategori = $master->getAllKategori();

// Jika produk tidak ditemukan
if (!$produk) {
    echo "<script>alert('Produk tidak ditemukan!');window.location='produk-list.php';</script>";
    exit;
}

// Jika tombol update ditekan
if (isset($_POST['update'])) {
    $_POST['id_produk'] = $id; // tambahkan id ke data yang dikirim
    if ($master->updateProduk($_POST)) {
        echo "<script>alert('Produk berhasil diperbarui!');window.location='produk-list.php';</script>";
        exit;
    } else {
        echo "<script>alert('Gagal memperbarui produk!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk - SIMRIH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h3>Edit Produk</h3>
    <form method="POST">
        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required
                   value="<?= htmlspecialchars($produk['nama_produk']) ?>">
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required
                   value="<?= htmlspecialchars($produk['harga']) ?>">
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" required
                   value="<?= htmlspecialchars($produk['stok']) ?>">
        </div>
        <div class="mb-3">
            <label>No. Telepon</label>
            <input type="text" name="tlpn" class="form-control"
                   value="<?= htmlspecialchars($produk['tlpn']) ?>">
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"><?= htmlspecialchars($produk['alamat']) ?></textarea>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <select name="id_kategori" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                <?php while ($row = $kategori->fetch_assoc()) { ?>
                    <option value="<?= $row['id_kategori'] ?>"
                        <?= ($row['id_kategori'] == $produk['id_kategori']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['nama_kategori']) ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <button class="btn btn-primary" name="update">Perbarui</button>
        <a href="produk-list.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
