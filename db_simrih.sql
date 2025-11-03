CREATE DATABASE IF NOT EXISTS db_simrih;
USE db_simrih;

CREATE TABLE tb_kategori (
  id_kategori INT AUTO_INCREMENT PRIMARY KEY,
  nama_kategori VARCHAR(100) NOT NULL
);

CREATE TABLE tb_produk (
  id_produk INT AUTO_INCREMENT PRIMARY KEY,
  nama_produk VARCHAR(100) NOT NULL,
  harga INT NOT NULL,
  stok INT NOT NULL,
  tlpn VARCHAR(20),
  alamat TEXT,
  id_kategori INT,
  FOREIGN KEY (id_kategori) REFERENCES tb_kategori(id_kategori) ON DELETE SET NULL
);

-- contoh data kategori
INSERT INTO tb_kategori (nama_kategori) VALUES ('Elektronik'), ('Pakaian'), ('Makanan');
