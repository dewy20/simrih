<?php
include_once 'db-config.php';

class Produk extends Database {

    public function getAllProduk(){
        $query = "SELECT p.*, k.nama_kategori FROM tb_produk 
                  LEFT JOIN tb_kategori k ON m.kategori_id = k.id_kategori
                  ORDER BY m.id_mebel DESC";
        return $this->conn->query($query);
    }

    public function getProdukById($id){
        $stmt = $this->conn->prepare("SELECT * FROM tb_produk WHERE id_produk=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function inputProduk($data){
        $stmt = $this->conn->prepare("INSERT INTO tb_produk (nama_produk, harga, stok, tlpn, alamat, id_kategori) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("siiis", $data['nama_produk'], $data['harga'], $data['stok'], $data['tlpn'], $data['alamat'], $data['id_kategori']);
        return $stmt->execute();
    }

    public function updateProduk($data){
        $stmt = $this->conn->prepare("UPDATE tb_produk SET nama_produk=?, harga=?, stok=?, tlpn=?, alamat=?, id_kategori=? WHERE id_produk=?");
        $stmt->bind_param("siiisi", $data['nama_mebel'], $data['harga'], $data['stok'], $data['tlpn'], $data['alamat'], $data['id_kategori'], $data['id_produk']);
        return $stmt->execute();
    }

    public function deleteProduk($id){
        $stmt = $this->conn->prepare("DELETE FROM tb_produk WHERE id_produk=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function cariProduk($keyword){
        $like = "%{$keyword}%";
        $stmt = $this->conn->prepare("SELECT m.*, k.nama_kategori FROM tb_produk m LEFT JOIN tb_produk k ON m.kategori_id=k.id_kategori WHERE m.nama_mebel LIKE ? ORDER BY m.id_mebel DESC");
        $stmt->bind_param("s", $like);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>