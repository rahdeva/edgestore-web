-- CREATE DATABASE PROJECT;
-- USE PROJECT;
CREATE TABLE `tb_barang` ( 
    `id_barang` INT(10) NOT NULL AUTO_INCREMENT , 
    `id_kategori` INT(10) NOT NULL , 
    `nama_barang` VARCHAR(50) NOT NULL , 
    `merk` VARCHAR(30) NOT NULL , 
    `stok` INT(10) NOT NULL , 
    `harga_beli` DECIMAL(10,4) NOT NULL , 
    `harga_jual` DECIMAL(10,4) NOT NULL , 
    `kedaluwarsa` VARCHAR(30) NULL DEFAULT NULL , 
    PRIMARY KEY (`id_barang`)
) ENGINE = InnoDB;

INSERT INTO `tb_barang` (`id_kategori`, `nama_barang`, `merk`, `stok`, `harga_beli`, `harga_jual`, `kedaluwarsa`) VALUES
    (1, 'Pensil', 'Faber Castle', 50, 2500, 3000, '2022-10-13'),
    (1, 'Pulpen', 'Joyko', 55, 5000, 6000, '2022-12-12'),
    (3, 'Permen', 'Mentos', 35, 8500, 9500, '2023-09-05'),
    (4, 'Air Mineral', 'Aqua', 30, 3200, 4000, '2023-10-11'),
    (3, 'Keripik Kentang', 'Qtela', 25, 10500, 11000, '2024-11-23'),
    (3, 'Keripik Kentang', 'Chitato', 25, 13500, 14000, '2024-11-20'),
    (4, 'Kopi', 'Nescafe', 15, 8000, 8500, '2023-07-24'),
    (4, 'Alkohol', 'Bintang', 10, 15000, 17500, '2022-12-12'),
    (2, 'Shampoo', 'Lifeboy', 20, 23000, 25000, '2022-11-12'),
    (2, 'Pasta Gigi', 'Pepsodent', 25, 12000, 15000, '2023-06-18');
-- SELECT * FROM tb_barang;

CREATE TABLE `tb_kategori` ( 
    `id_kategori` INT(10) NOT NULL AUTO_INCREMENT , 
    `nama_kategori` VARCHAR(30) NOT NULL , 
    `deskripsi` VARCHAR(200) NOT NULL , 
    PRIMARY KEY (`id_kategori`)
) ENGINE = InnoDB;

INSERT INTO `tb_kategori` (`nama_kategori`, `deskripsi`) VALUES
    ('ATK', 'Alat tulis kertas atau keperluan tulis-menulis lainnya'),
    ('MCK', 'Barang yang berhubungan dengan keperluan mandi, cuci dan buang air'),
    ('Makanan Ringan', 'Berbagai makanan ringan seperti biskuit, snack dan jajanan lainnya'),
    ('Minuman', 'Minuman dalam botol atau kemasan lainnya, jenisnya bisa susu, kopi atau lainnya');
-- SELECT * FROM tb_kategori;

CREATE TABLE `tb_transaksi` ( 
    `id_transaksi` INT(10) NOT NULL AUTO_INCREMENT , 
    `id_barang` INT(10) NOT NULL , 
    `jumlah` INT(10) NOT NULL , 
    `total` DECIMAL(20,4) NOT NULL , 
    `kasir` VARCHAR(100) NOT NULL , 
    `waktu_input` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    PRIMARY KEY (`id_transaksi`)
) ENGINE = InnoDB;

CREATE TABLE `tb_user` ( 
    `id` INT(10) NOT NULL AUTO_INCREMENT , 
    `username` VARCHAR(30) NOT NULL , 
    `password` VARCHAR(200) NOT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `tb_profil` ( 
    `id_profil` INT(10) NOT NULL AUTO_INCREMENT, 
    `nama_depan` VARCHAR(30) NOT NULL , 
    `nama_belakang` VARCHAR(30) NOT NULL , 
    `alamat` VARCHAR(500) NOT NULL , 
    `tgl_lahir` VARCHAR(30) NOT NULL , 
    `email` VARCHAR(50) NOT NULL , 
    `no_telepon` VARCHAR(20) NOT NULL ,
    `gambar` VARCHAR(100) DEFAULT 'assets/images/user-images/default.png' ,
    PRIMARY KEY (`id_profil`)
) ENGINE = InnoDB;

ALTER TABLE `tb_profil` AUTO_INCREMENT = 4;

CREATE TABLE `tb_admin` ( 
    `id_admin` INT(10) NOT NULL AUTO_INCREMENT , 
    `nama_depan` VARCHAR(30) NOT NULL , 
    `nama_belakang` VARCHAR(30) NOT NULL , 
    `alamat` VARCHAR(500) NOT NULL , 
    `tgl_lahir` VARCHAR(30) NOT NULL , 
    `email` VARCHAR(50) NOT NULL , 
    `no_telepon` VARCHAR(20) NOT NULL ,
    `gambar` VARCHAR(100) DEFAULT 'assets/images/user-images/default.png' ,
    PRIMARY KEY (`id_admin`)
) ENGINE = InnoDB;

INSERT INTO tb_user(id, username, password) 
VALUES 	('1','adminsatu','adminsatu'),
        ('2','admindua','admindua'),
        ('3','admintiga','admintiga');

INSERT INTO tb_admin(id_admin, nama_depan, nama_belakang, alamat, tgl_lahir, email, no_telepon, gambar) 
VALUES 	('1','Admin','Satu','Tokyo','2022-05-31','adminsatu@gmail.com','081904055609','assets/images/user-images/default.png'),
        ('2','Admin','Dua','Wakanda','2022-05-31','admindua@gmail.com','085739850813','assets/images/user-images/default.png'),
        ('3','Admin','Tiga','Zimbabwe','2022-05-31','admintiga@gmail.com','087816983826','assets/images/user-images/default.png');


DELIMITER $$
CREATE TRIGGER PenguranganStok
AFTER INSERT ON `tb_transaksi`
FOR EACH ROW BEGIN
    UPDATE tb_barang SET stok = stok - NEW.jumlah
    WHERE id_barang= NEW.id_barang;
END $$
DELIMITER ;

-- DELIMITER $$
--     CREATE PROCEDURE TabelPageBarang()
--     BEGIN
--         SELECT 
--             tb_barang.id_barang, 
--             tb_kategori.nama_kategori AS 'nama_kategori', 
--             tb_barang.nama_barang, 
--             tb_barang.merk, 
--             tb_barang.stok, 
--             tb_barang.harga_beli, 
--             tb_barang.harga_jual, 
--             tb_barang.kedaluwarsa 
--         FROM tb_barang 
--         INNER JOIN tb_kategori USING(id_kategori);
--     END $$
-- DELIMITER ;

DELIMITER $$
    CREATE PROCEDURE DaftarKasir()
    BEGIN
        SELECT 
            CONCAT(tb_profil.nama_depan, ' ', tb_profil.nama_belakang) AS nama_kasir,
            tb_profil.alamat,
            tb_profil.tgl_lahir,	
            tb_profil.email,
            tb_profil.no_telepon
        FROM tb_profil
        UNION
        SELECT
            CONCAT(tb_admin.nama_depan, ' ', tb_admin.nama_belakang) AS nama_kasir,
            tb_admin.alamat,
            tb_admin.tgl_lahir,	
            tb_admin.email,
            tb_admin.no_telepon
        FROM tb_admin; 
    END $$
DELIMITER ;

CREATE VIEW validasi_lupa_password AS
SELECT tb_user.username, tb_profil.no_telepon, tb_profil.email
FROM tb_user
INNER JOIN tb_profil 
ON tb_user.id = tb_profil.id_profil;

-- SELECT * FROM validasi_lupa_password WHERE username = 'suarno';
