<?php
include_once '../config/class-master.php'; // pastikan path benar

$produk = new MasterData(); // buat objek dari class MasterData
$kategori = $produk->getAllKategori(); // ambil semua kategori (untuk dropdown nanti)

// Cek jika tombol "Simpan" ditekan
if (isset($_POST['simpan'])) {
    if ($produk->insertProduk($_POST)) {
        echo "<script>alert('Produk berhasil disimpan!'); window.location='produk-list.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan produk!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Produk - SIMRIH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h3>Input Data Produk</h3>
    <form method="POST">
        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>No. Telepon</label>
            <input type="text" name="tlpn" class="form-control">
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <select name="id_kategori" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                <?php while ($row = $kategori->fetch_assoc()) { ?>
                    <option value="<?= $row['id_kategori'] ?>"><?= $row['nama_kategori'] ?></option>
                <?php } ?>
            </select>
        </div>
        <button class="btn btn-primary" name="simpan">Simpan</button>
        <a href="../index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
