<?php
include_once 'db-config.php';

class Kategori extends Database {

    // =========================================================
    // BAGIAN KATEGORI
    // =========================================================

    // Ambil semua kategori
    public function getAllKategori() {
        $query = "SELECT * FROM tb_kategori ORDER BY nama_kategori ASC";
        return $this->conn->query($query);
    }

    // Tambah kategori baru
    public function insertKategori($nama) {
        $stmt = $this->conn->prepare("INSERT INTO tb_kategori (nama_kategori) VALUES (?)");
        $stmt->bind_param("s", $nama);
        return $stmt->execute();
    }

    // Hapus kategori berdasarkan ID
    public function deleteKategori($id) {
        $stmt = $this->conn->prepare("DELETE FROM tb_kategori WHERE id_kategori = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Ambil kategori berdasarkan ID (bisa untuk edit)
    public function getKategoriById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM tb_kategori WHERE id_kategori = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Update nama kategori
    public function updateKategori($id, $nama) {
        $stmt = $this->conn->prepare("UPDATE tb_kategori SET nama_kategori=? WHERE id_kategori=?");
        $stmt->bind_param("si", $nama, $id);
        return $stmt->execute();
    }

    // =========================================================
    // BAGIAN PRODUK
    // =========================================================

    // Ambil semua produk (join dengan kategori)
    public function getAllProduk() {
        $query = "
            SELECT p.*, k.nama_kategori 
            FROM tb_produk p 
            LEFT JOIN tb_kategori k ON p.id_kategori = k.id_kategori
            ORDER BY p.id_produk DESC
        ";
        return $this->conn->query($query);
    }

    // Ambil satu produk berdasarkan ID
    public function getProdukById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM tb_produk WHERE id_produk = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Tambah produk baru
    public function insertProduk($data) {
        $stmt = $this->conn->prepare("
            INSERT INTO tb_produk (nama_produk, harga, stok, tlpn, alamat, id_kategori)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "siissi",
            $data['nama_produk'],
            $data['harga'],
            $data['stok'],
            $data['tlpn'],
            $data['alamat'],
            $data['id_kategori']
        );
        return $stmt->execute();
    }

    // Update produk
    public function updateProduk($data) {
        $stmt = $this->conn->prepare("
            UPDATE tb_produk 
            SET nama_produk=?, harga=?, stok=?, tlpn=?, alamat=?, id_kategori=? 
            WHERE id_produk=?
        ");
        $stmt->bind_param(
            "siisiii",
            $data['nama_produk'],
            $data['harga'],
            $data['stok'],
            $data['tlpn'],
            $data['alamat'],
            $data['id_kategori'],
            $data['id_produk']
        );
        return $stmt->execute();
    }

    // Hapus produk
    public function deleteProduk($id) {
        $stmt = $this->conn->prepare("DELETE FROM tb_produk WHERE id_produk=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
