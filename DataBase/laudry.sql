-- Membuat Tabel Kecamatan
CREATE TABLE TabelKecamatan
(
    id SERIAL PRIMARY KEY,  -- Using SERIAL for auto-increment
    nama VARCHAR(15)
);

-- Membuat Indeks Tabel Kecamatan
CREATE INDEX idx_id_kecamatan ON TabelKecamatan(id);

-- Membuat Tabel Kelurahan
CREATE TABLE TabelKelurahan
(
    id SERIAL PRIMARY KEY,  -- Using SERIAL for auto-increment
    nama VARCHAR(15),
    idKecamatan INT
);

-- Membuat Indeks Tabel Kelurahan
CREATE INDEX idx_id_kelurahan ON TabelKelurahan(id);

-- Menambahkan FK dari TabelKelurahan ke TabelKecamatan
ALTER TABLE TabelKelurahan
    ADD CONSTRAINT FK_Kelurahan_Kecamatan
    FOREIGN KEY (idKecamatan)
    REFERENCES TabelKecamatan(id);

-- Membuat Tabel Pegawai
CREATE TABLE TabelPegawai
(
    id SERIAL PRIMARY KEY,  -- Using SERIAL for auto-increment
    nama VARCHAR(15),
    status CHAR(8),
    password VARCHAR(10)  -- Lowercase 'password' to avoid conflict with reserved keyword
);

-- Membuat Indeks Tabel Pegawai
CREATE INDEX idx_id_pegawai ON TabelPegawai(id);

-- Membuat Tabel Pelanggan
CREATE TABLE Pelanggan
(
    id SERIAL PRIMARY KEY,  -- Using SERIAL for auto-increment
    nama VARCHAR(15),
    HP CHAR(12),
    email VARCHAR(20),
    idKelurahan INT
);

-- Membuat Indeks Tabel Pelanggan
CREATE INDEX idx_id_pelanggan ON TabelPelanggan(id);

-- Menambahkan FK dari TabelPelanggan ke TabelKelurahan
ALTER TABLE TabelPelanggan
    ADD CONSTRAINT FK_Pelanggan_Kelurahan
    FOREIGN KEY (idKelurahan)
    REFERENCES TabelKelurahan(id);

-- Membuat Tabel Mesin Cuci
CREATE TABLE TabelMesinCuci
(
    Nama VARCHAR(10) PRIMARY KEY,
    Kapasitas INT,
    Merek VARCHAR(10),
    status VARCHAR(9),
    harga_per_15_menit MONEY
);

-- Membuat Indeks Tabel Mesin Cuci
CREATE INDEX idx_id_mesin_cuci ON TabelMesinCuci(Nama);

-- Membuat Tabel Transaksi
CREATE TABLE TabelTransaksi
(
    id SERIAL PRIMARY KEY,  -- Using SERIAL for auto-increment
    TanggalTransaksi DATE,
    WaktuMulai TIME,
    WaktuSelesai TIME,
    idPelanggan INT,
    idPegawai INT,
    namaMesinCuci VARCHAR(10),
    total INT
);

-- Membuat Indeks Tabel Transaksi
CREATE INDEX idx_id_transaksi ON TabelTransaksi(id);

-- Menambahkan FK dari TabelTransaksi ke TabelPelanggan
ALTER TABLE TabelTransaksi
    ADD CONSTRAINT FK_Tranksaksi_Pelanggan
    FOREIGN KEY (idPelanggan)
    REFERENCES TabelPelanggan(id);

-- Menambahkan FK dari TabelTransaksi ke TabelPegawai
ALTER TABLE TabelTransaksi
    ADD CONSTRAINT FK_Tranksaksi_Pegawai
    FOREIGN KEY (idPegawai)
    REFERENCES TabelPegawai(id);

-- Menambahkan FK dari TabelTransaksi ke TabelMesinCuci
ALTER TABLE TabelTransaksi
    ADD CONSTRAINT FK_Tranksaksi_MesinCuci
    FOREIGN KEY (namaMesinCuci)
    REFERENCES TabelMesinCuci(Nama);

-- Membuat Tabel Mengelola
CREATE TABLE Mengelola
(
    idPegawai INT,
    namaMesinCuci VARCHAR(10)
);

-- Menambahkan FK dari Mengelola ke TabelPegawai
ALTER TABLE Mengelola
    ADD CONSTRAINT FK_Pegawai
    FOREIGN KEY (idPegawai)
    REFERENCES TabelPegawai(id);

-- Menambahkan FK dari Mengelola ke TabelMesinCuci
ALTER TABLE Mengelola
    ADD CONSTRAINT FK_MesinCuci
    FOREIGN KEY (namaMesinCuci)
    REFERENCES TabelMesinCuci(Nama);

-- Inserting Data into TabelPelanggan
INSERT INTO TabelPelanggan (nama, HP, email, idKelurahan)
VALUES
    ('Andi Pratama', '081234567890', 'andi.pratama@gmail.com', 1),
    ('Budi Santoso', '082345678901', 'budi.santoso@yahoo.com', 2),
    ('Citra Dewi', '083456789012', 'citra.dewi@hotmail.com', 3),
    ('Diana Putri', '084567890123', 'diana.putri@outlook.com', 4),
    ('Eka Saputra', '085678901234', 'eka.saputra@gmail.com', 5);

-- Inserting Data into TabelPegawai
INSERT INTO TabelPegawai (nama, status, password)
VALUES
    ('Andi Wijaya', 'pemilik', '123'),
    ('Siti Rahmawati', 'pegawai', '456'),
    ('Budi Santoso', 'pegawai', '789'),
    ('Ani Prasetyo', 'pegawai', 'abc'),
    ('Rizky Kurniawan', 'pegawai', 'efg');

-- Inserting Data into TabelMesinCuci
INSERT INTO TabelMesinCuci (Nama, Kapasitas, status, Merek, harga_per_15_menit)
VALUES
    ('Lulu', 7, 'kosong', 'Samsung', 5000),
    ('Coco', 10, 'isi', 'LG', 6000),
    ('Lupi', 5, 'kosong', 'Sharp', 4000),
    ('Dodo', 8, 'kosong', 'Panasonic', 5500),
    ('Wombit', 6, 'isi', 'Bosch', 7000);

INSERT INTO TabelPegawai (nama, status, password)
VALUES
    ('Andi Wijaya', 'pemilik', '123'),
    ('Siti Rahmawati', 'pegawai', '456'),
    ('Budi Santoso', 'pegawai', '789'),
    ('Ani Prasetyo', 'pegawai', 'abc'),
    ('Rizky Kurniawan', 'pegawai', 'efg');

-- Inserting Data into TabelMesinCuci
INSERT INTO TabelMesinCuci (Nama, Kapasitas, status, Merek, harga_per_15_menit)
VALUES
    ('Wiwi', 7, 'kosong', 'Samsung', 5000),
    ('Cici', 10, 'isi', 'LG', 6000),
    ('Lopi', 5, 'kosong', 'Sharp', 4000),
    ('Dodot', 8, 'kosong', 'Panasonic', 5500),
    ('Wombat', 6, 'isi', 'Bosch', 7000);


-- Inserting Data into TabelKecamatan (Sub-Districts in Bandung)
INSERT INTO TabelKecamatan (id, nama)
VALUES
    (1, 'Andir'),
    (2, 'Arcamanik'),
    (3, 'Astana Anyar'),
    (4, 'Babakan Ciparay'),
    (5, 'Bandung Kidul'),
    (6, 'Bandung Kulon'),
    (7, 'Bandung Wetan'),
    (8, 'Coblong'),
    (9, 'Cidadap'),
    (10, 'Cibiru'),
    (11, 'Cimahi Selatan'),
    (12, 'Cimahi Utara'),
    (13, 'Lengkong'),
    (14, 'Mandalajati'),
    (15, 'Panyileukan'),
    (16, 'Rancasari'),
    (17, 'Regol'),
    (18, 'Sumur Bandung'),
    (19, 'Kiaracondong'),
    (20, 'Bojongloa Kaler'),
    (21, 'Bojongloa Kidul');

INSERT INTO TabelKelurahan (id, nama, idKecamatan)
VALUES
    (1, 'Andir', 1),
    (2, 'Arcamanik', 2),
    (3, 'Astana Anyar', 3),
    (4, 'Babakan Cipray', 4),
    (5, 'Bandung Kidul', 5),
    (6, 'Bandung Kulon', 6),
    (7, 'Bandung Wetan', 7),
    (8, 'Coblong', 8),
    (9, 'Cidadap', 9),
    (10, 'Cibiru', 10),
    (11, 'Cimahi Sel', 11),
    (12, 'Cimahi Utara', 12),
    (13, 'Lengkong', 13),
    (14, 'Mandalajati', 14),
    (15, 'Panyileukan', 15),
    (16, 'Rancasari', 16),
    (17, 'Regol', 17),
    (18, 'Sumur Band', 18),
    (19, 'Kiaracondong', 19),
    (20, 'Bojongloa Kal', 20),
    (21, 'Bojongloa Kidul', 21);
