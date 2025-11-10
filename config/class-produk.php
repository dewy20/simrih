<?php
include_once 'db-config.php';

class Produk extends Database {

    // Ambil semua produk + nama kategori
    public function getAllProduk(){
        $query = "SELECT p.*, k.nama_kategori 
                  FROM tb_produk p 
                  LEFT JOIN tb_kategori k ON p.id_kategori = k.id_kategori 
                  ORDER BY p.id_produk DESC";
        return $this->conn->query($query);
    }

    // Ambil 1 produk berdasarkan ID
    public function getProdukById($id){
        $stmt = $this->conn->prepare("SELECT * FROM tb_produk WHERE id_produk = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Tambah produk baru
    public function inputProduk($data){
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
    public function updateProduk($data){
        $stmt = $this->conn->prepare("
            UPDATE tb_produk 
            SET nama_produk=?, harga=?, stok=?, tlpn=?, alamat=?, id_kategori=? 
            WHERE id_produk=?
        ");
        $stmt->bind_param(
            "siissii", 
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
    public function deleteProduk($id){
        $stmt = $this->conn->prepare("DELETE FROM tb_produk WHERE id_produk = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Cari produk berdasarkan nama
    public function cariProduk($keyword){
        $like = "%{$keyword}%";
        $stmt = $this->conn->prepare("
            SELECT p.*, k.nama_kategori 
            FROM tb_produk p 
            LEFT JOIN tb_kategori k ON p.id_kategori = k.id_kategori 
            WHERE p.nama_produk LIKE ? 
            ORDER BY p.id_produk DESC
        ");
        $stmt->bind_param("s", $like);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
