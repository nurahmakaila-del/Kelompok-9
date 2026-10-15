CREATE DATABASE IF NOT EXISTS laundry_db;
USE laundry_db;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS paket_layanan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_paket VARCHAR(100) NOT NULL,
  jenis ENUM('Kiloan','Satuan','Express') NOT NULL,
  harga INT NOT NULL,
  estimasi_jam INT NOT NULL,
  deskripsi TEXT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO paket_layanan (nama_paket, jenis, harga, estimasi_jam, deskripsi) VALUES
('Cuci Kiloan Reguler', 'Kiloan', 7000, 48, 'Cuci + lipat, per kg'),
('Cuci Setrika', 'Kiloan', 9000, 48, 'Cuci + setrika, per kg'),
('Jas / Blazer', 'Satuan', 25000, 72, 'Per potong'),
('Cuci Express', 'Express', 12000, 6, 'Selesai dalam hari yang sama, per kg');
