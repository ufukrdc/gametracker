CREATE DATABASE gametracker;
USE gametracker;

CREATE TABLE kullanicilar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kullanici_adi VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    sifre VARCHAR(255) NOT NULL,
    kayit_tarihi DATETIME DEFAULT NOW()
);

CREATE TABLE oyunlar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    baslik VARCHAR(200) NOT NULL,
    tur VARCHAR(100),
    platform VARCHAR(100),
    yil INT,
    aciklama TEXT,
    ekleyen_id INT,
    eklenme_tarihi DATETIME DEFAULT NOW()
);

CREATE TABLE yorumlar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kullanici_id INT,
    oyun_id INT,
    puan INT,
    yorum TEXT,
    tarih DATETIME DEFAULT NOW()
);