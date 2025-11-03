<?php
include_once __DIR__ . '/../config/class-master.php';
$master = new MasterData();
$data = $master->getAllProduk();

if(isset($_GET['hapus'])){
    $master->deleteProduk($_GET['hapus']);
    echo "<script>alert('Produk dihapus!');window.location='produk-list.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk - SIMRIH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h3>Daftar Produk</h3>
    <a href="produk-input.php" class="btn btn-primary mb-3">Tambah Produk</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Nama Produk</th><th>Harga</th><th>Stok</th><th>Telp</th><th>Alamat</th><th>Kategori</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $data->fetch_assoc()){ ?>
            <tr>
                <td><?= $row['id_produk'] ?></td>
                <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                <td><?= number_format($row['harga']) ?></td>
                <td><?= $row['stok'] ?></td>
                <td><?= htmlspecialchars($row['tlpn']) ?></td>
                <td><?= htmlspecialchars($row['alamat']) ?></td>
                <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
                <td>
                    <a href="produk-edit.php?id=<?= $row['id_produk'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="?hapus=<?= $row['id_produk'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
