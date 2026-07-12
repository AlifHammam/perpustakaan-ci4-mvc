-- ============================================================
-- Mini Project: Sistem Manajemen Buku Perpustakaan (CodeIgniter 4)
-- Nama  : Alif Hamammam Multazam
-- NIM   : 240401010043
-- Kelas : IF403
-- ============================================================

CREATE DATABASE IF NOT EXISTS perpustakaan_ci4;
USE perpustakaan_ci4;

DROP TABLE IF EXISTS buku;

CREATE TABLE buku (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    isbn        VARCHAR(20)  NOT NULL UNIQUE,
    judul       VARCHAR(255) NOT NULL,
    penulis     VARCHAR(100) NOT NULL,
    tahun       SMALLINT     NOT NULL,
    stok        INT          NOT NULL DEFAULT 0,
    created_at  DATETIME NULL,
    updated_at  DATETIME NULL
);

-- Data contoh (opsional, untuk demo)
INSERT INTO buku (isbn, judul, penulis, tahun, stok, created_at, updated_at) VALUES
('9786020399456', 'Laskar Pelangi', 'Andrea Hirata', 2005, 12, NOW(), NOW()),
('9789794336489', 'Bumi Manusia', 'Pramoedya Ananta Toer', 1980, 8, NOW(), NOW()),
('9786020329997', 'Filosofi Teras', 'Henry Manampiring', 2018, 15, NOW(), NOW());
