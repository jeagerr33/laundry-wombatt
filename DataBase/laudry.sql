DROP TABLE IF EXISTS Pelanggan
DROP TABLE IF EXISTS Pegawai
DROP TABLE IF EXISTS Mesin_Cuci
DROP TABLE IF EXISTS kecamatan
DROP TABLE IF EXISTS kelurahan

CREATE TABLE Pelanggan (
    id SERIAL PRIMARY KEY, -- Nomor identitas pelanggan, bersifat unik.
    nama VARCHAR(100) NOT NULL, -- Nama pelanggan.
    noHP VARCHAR(15) UNIQUE NOT NULL, -- Nomor HP pelanggan, harus unik.
    email VARCHAR(100) UNIQUE NOT NULL -- Email pelanggan, harus unik.
);

INSERT INTO Pelanggan (nama, noHP, email)
VALUES
    ('Andi Pratama', '081234567890', 'andi.pratama@gmail.com'),
    ('Budi Santoso', '082345678901', 'budi.santoso@yahoo.com'),
    ('Citra Dewi', '083456789012', 'citra.dewi@hotmail.com'),
    ('Diana Putri', '084567890123', 'diana.putri@outlook.com'),
    ('Eka Saputra', '085678901234', 'eka.saputra@gmail.com');


CREATE TABLE Pegawai (
    id SERIAL PRIMARY KEY, -- Nomor identitas pengguna, bersifat unik.
    status VARCHAR(50) NOT NULL, -- Peran pengguna (misalnya pemilik atau pegawai).
    nama VARCHAR(100) NOT NULL, -- Nama pengguna.
    password VARCHAR(50) NOT NULL -- Password pengguna.
);

UPDATE pelanggan
SET kelurahan_id = 3 -- Sesuaikan dengan ID kelurahan yang sesuai untuk pelanggan 2
WHERE id = 5;


INSERT INTO Pegawai (status, nama, password)
VALUES
    ('pemilik', 'Andi Wijaya', '123'),
    ('pegawai', 'Siti Rahmawati', '456'),
    ('pegawai', 'Budi Santoso', '789'),
    ('pegawai', 'Ani Prasetyo', 'abc'),
    ('pegawai', 'Rizky Kurniawan', 'efg');


CREATE TABLE Mesin_Cuci (
    nama VARCHAR(100) PRIMARY KEY, -- Nama mesin cuci, bersifat unik sehingga menjadi primary key.
    kapasitas INT NOT NULL, -- Kapasitas mesin cuci (dalam kilogram).
    status VARCHAR(20) NOT NULL, -- Keterangan status mesin (kosong atau isi).
    merek VARCHAR(100) NOT NULL, -- Merek mesin cuci.
    harga_per_15_menit DECIMAL(10, 2) NOT NULL -- Harga per 15 menit penggunaan mesin cuci.
);

-- Contoh untuk memasukkan data mesin cuci:
INSERT INTO Mesin_Cuci (nama, kapasitas, status, merek, harga_per_15_menit)
VALUES
    ('Lulu', 7, 'kosong', 'Samsung', 5000),
    ('Coco', 10, 'isi', 'LG', 6000),
    ('Lupi', 5, 'kosong', 'Sharp', 4000),
    ('Dodo', 8, 'kosong', 'Panasonic', 5500),
    ('Wombit', 6, 'isi', 'Bosch', 7000);


-- Membuat tabel Kecamatan
CREATE TABLE kecamatan (
    id SERIAL PRIMARY KEY, -- Nomor identitas kecamatan, auto-increment
    nama VARCHAR(100) NOT NULL -- Nama kecamatan, wajib diisi
);

-- Membuat tabel Kelurahan
CREATE TABLE kelurahan (
    id SERIAL PRIMARY KEY, -- Nomor identitas kelurahan, auto-increment
    nama VARCHAR(100) NOT NULL, -- Nama kelurahan, wajib diisi
    kecamatan_id INT NOT NULL, -- Foreign key ke tabel Kecamatan
    CONSTRAINT fk_kecamatan FOREIGN KEY (kecamatan_id) REFERENCES kecamatan (id)
        ON DELETE CASCADE -- Hapus kelurahan jika kecamatannya dihapus
        ON UPDATE CASCADE -- Perbarui relasi jika id kecamatan berubah
	
);

INSERT INTO kecamatan (nama) VALUES 
('Cimenyan'),
('Cileunyi'),
('Bojongsoang'),
('Ciparay'),
('Rancaekek');

INSERT INTO kelurahan (nama, kecamatan_id) VALUES 
-- Kelurahan di Kecamatan Cimenyan
('Ciburial', 1),
('Mekarsaluyu', 1),
('Sindanglaya', 1),

-- Kelurahan di Kecamatan Cileunyi
('Cimekar', 2),
('Cibiru Hilir', 2),
('Cileunyi Kulon', 2),

-- Kelurahan di Kecamatan Bojongsoang
('Lengkong', 3),
('Bojongsari', 3),
('Sukapura', 3),

-- Kelurahan di Kecamatan Ciparay
('Ciparay', 4),
('Sumbersari', 4),
('Manggungharja', 4),

-- Kelurahan di Kecamatan Rancaekek
('Bojongloa', 5),
('Sukamulya', 5),
('Linggar', 5);

SELECT kelurahan.nama AS kelurahan, kecamatan.nama AS kecamatan
FROM kelurahan
JOIN kecamatan ON kelurahan.kecamatan_id = kecamatan.id;

SELECT 
    p.id AS pelanggan_id,
    p.nama AS pelanggan_nama,
    p.noHP AS pelanggan_noHP,
    p.email AS pelanggan_email,
    k.id AS kelurahan_id,
    k.nama AS kelurahan_nama
FROM 
    pelanggan p
JOIN 
    kelurahan k ON p.kelurahan_id = k.id;