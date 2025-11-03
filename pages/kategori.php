<?php
// Panggil class MasterData
include_once __DIR__ . '/../config/class-Kategori.php';
$kategori = new Kategori();

// Tambah kategori baru
if(isset($_POST['tambah'])){
    $nama_kategori = $_POST['nama_kategori'];
    $kategori->insertKategori($nama_kategori);
    header('Location: kategori.php');
    exit;
}

// Ambil semua kategori dari database
$kategori = $Kategori->getAllKategori();
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
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $kategori->fetch_assoc()){ ?>
                <tr>
                    <td><?= $row['id_kategori'] ?></td>
                    <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
