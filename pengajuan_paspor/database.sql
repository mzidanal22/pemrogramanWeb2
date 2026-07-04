-- =========================================================
-- DATABASE: db_paspor
-- Aplikasi Pengajuan Paspor - Kantor Imigrasi Cabang
-- =========================================================

CREATE DATABASE IF NOT EXISTS db_paspor;
USE db_paspor;

-- ---------------------------------------------------------
-- Tabel 1: pendaftar (Modul: Daftar)
-- ---------------------------------------------------------
CREATE TABLE pendaftar (
    no_daftar INT AUTO_INCREMENT PRIMARY KEY,
    nama_pemohon VARCHAR(100) NOT NULL,
    tgl_daftar DATE NOT NULL,
    hari VARCHAR(20) NOT NULL,       -- Hari datang (hasil hitung kapasitas)
    tanggal DATE NOT NULL            -- Tanggal datang (hasil hitung kapasitas)
);

-- ---------------------------------------------------------
-- Tabel 2: daftar_ulang (Modul: Daftar Ulang)
-- ---------------------------------------------------------
CREATE TABLE daftar_ulang (
    id_daftar_ulang INT AUTO_INCREMENT PRIMARY KEY,
    no_daftar INT NOT NULL,
    nama_pemohon VARCHAR(100) NOT NULL,
    keperluan VARCHAR(50) NOT NULL,       -- Wnri / Wna / Perpanjangan, dll
    hari_daftar_ulang VARCHAR(20) NOT NULL,
    tgl_daftar_ulang DATE NOT NULL,
    ktp ENUM('Ada','Tidak') NOT NULL DEFAULT 'Tidak',
    kk ENUM('Ada','Tidak') NOT NULL DEFAULT 'Tidak',
    ijazah_akta ENUM('Ada','Tidak') NOT NULL DEFAULT 'Tidak',
    keterangan ENUM('OK','tidak') NOT NULL,
    no_antrian INT DEFAULT NULL,
    FOREIGN KEY (no_daftar) REFERENCES pendaftar(no_daftar)
);

-- ---------------------------------------------------------
-- Tabel 3: pengurusan (Modul: Pengurusan)
-- ---------------------------------------------------------
CREATE TABLE pengurusan (
    id_pengurusan INT AUTO_INCREMENT PRIMARY KEY,
    id_daftar_ulang INT NOT NULL,
    no_antrian INT NOT NULL,
    no_daftar INT NOT NULL,
    nama_pemohon VARCHAR(100) NOT NULL,
    berkas VARCHAR(20) NOT NULL,        -- 'lengkap' / 'tidak lengkap'
    status VARCHAR(20) NOT NULL,        -- 'diterima' / 'ditolak'
    keterangan VARCHAR(20) NOT NULL,    -- 'OK' / 'kurang lengkap'
    pembayaran INT NOT NULL DEFAULT 0,
    FOREIGN KEY (id_daftar_ulang) REFERENCES daftar_ulang(id_daftar_ulang)
);
