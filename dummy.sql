-- Database: cipdes
CREATE DATABASE IF NOT EXISTS cipdes;
USE cipdes;

-- Table: admin
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Default admin account
INSERT INTO admin (username, password) VALUES 
('admin', MD5('admin123'));

-- Table: profil_desa
CREATE TABLE profil_desa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    isi TEXT NOT NULL,
    gambar VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO profil_desa (judul, isi, gambar) VALUES
('Sejarah Desa', 'Desa Carangrejo berdiri sejak tahun 1800-an...', 'sejarah.jpg'),
('Geografis & Demografis', 'Desa Carangrejo terletak di wilayah...', 'geografis.jpg'),
('Potensi Desa', 'Desa memiliki potensi pertanian, perikanan...', 'potensi.jpg');

-- Table: visi_misi
CREATE TABLE visi_misi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    visi TEXT NOT NULL,
    misi TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO visi_misi (visi, misi) VALUES
('Menjadi desa mandiri, maju, dan sejahtera', '1. Meningkatkan pertanian\n2. Memajukan pendidikan\n3. Memperkuat kebudayaan lokal');

-- Table: kategori_desa
CREATE TABLE kategori_desa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_dusun VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    gambar VARCHAR(255) DEFAULT NULL, -- menyimpan nama file gambar
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO kategori_desa (nama_dusun, deskripsi) VALUES
('Dusun 1', 'Pusat pemerintahan desa'),
('Dusun 2', 'Wilayah pertanian'),
('Dusun 3', 'Wilayah perikanan');

-- Table: berita
CREATE TABLE berita (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    isi TEXT NOT NULL,
    kategori VARCHAR(100) NOT NULL,
    gambar VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO berita (judul, isi, kategori, gambar) VALUES
('Gotong Royong Bersama', 'Warga desa melaksanakan kerja bakti...', 'Kegiatan', 'gotong_royong.jpg'),
('Pengumuman Pemilihan BPD', 'Pemilihan Badan Permusyawaratan Desa akan diadakan...', 'Pengumuman', 'bpd.jpg'),
('Festival Desa 2025', 'Festival desa tahunan akan diselenggarakan...', 'Event', 'festival.jpg');

-- Table: pesan
CREATE TABLE pesan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    pesan TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO pesan (nama, email, pesan) VALUES
('Budi', 'budi@mail.com', 'Apakah kantor desa buka hari Sabtu?'),
('Siti', 'siti@mail.com', 'Bagaimana cara ikut festival desa?');

-- Table: faq
CREATE TABLE faq (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pertanyaan TEXT NOT NULL,
    jawaban TEXT NOT NULL
);

INSERT INTO faq (pertanyaan, jawaban) VALUES
('Jam operasional kantor desa?', 'Senin - Jumat pukul 08.00 - 15.00 WIB'),
('Bagaimana cara mengurus surat keterangan domisili?', 'Silakan datang ke kantor desa membawa fotokopi KTP dan KK.');
