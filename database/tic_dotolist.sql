CREATE DATABASE itc_dotolist;
USE itc_dotolist;

CREATE TABLE tbl_users(
 id_users INT(11) PRIMARY KEY AUTO_INCREMENT,
 username VARCHAR(255),
 PASSWORD VARCHAR(255),
 nama VARCHAR(255),
 gender ENUM('L', 'P'),
 alamat TEXT
);

CREATE TABLE tbl_kegiatan(
 id_kegiatan INT(11) PRIMARY KEY AUTO_INCREMENT,
 nama_kegiatan VARCHAR(255),
 tgl_kegiatan DATE,
 deskripsi TEXT,
 STATUS ENUM('terlaksana', 'belum', 'gagal'),
 id_users INT(11),
 
 FOREIGN KEY (id_users) REFERENCES tbl_users(id_users)
);