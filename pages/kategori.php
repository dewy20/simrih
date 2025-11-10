<?php
// Panggil class Kategori
include_once __DIR__ . '/../config/class-Kategori.php';
$kategoriObj = new Kategori();

// Tambah kategori baru
if (isset($_POST['tambah'])) {
    $nama_kategori = $_POST['nama_kategori'];
    $kategoriObj->insertKategori($nama_kategori);
    header('Location: kategori.php');
    exit;
}

// Hapus kategori (jika ada parameter ?hapus=id)
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $kategoriObj->deleteKategori($id);
    header('Location: kategori.php');
    exit;
}

// Ambil semua kategori dari database
$dataKategori = $kategoriObj->getAllKategori();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kategori - SIMRIH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h3>Kelola Kategori</h3>

    <!-- Form tambah kategori -->
    <form method="POST" class="mb-3">
        <div class="input-group">
            <input type="text" name="nama_kategori" class="form-control" placeholder="Nama kategori" required>
            <button class="btn btn-success" name="tambah">Tambah</button>
        </div>
    </form>

    <!-- Tabel daftar kategori -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th width="60">ID</th>
                <th>Nama Kategori</th>
                <th width="120">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($dataKategori->num_rows > 0): ?>
                <?php while($row = $dataKategori->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id_kategori'] ?></td>
                        <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
                        <td>
                            <a href="kategori.php?hapus=<?= $row['id_kategori'] ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin ingin menghapus kategori ini?');">
                               Hapus
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="3" class="text-center">Belum ada kategori</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
