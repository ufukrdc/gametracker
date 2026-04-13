<?php
require_once "Database.php";

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // kayıt ol
    public function kayitOl($kullanici_adi, $email, $sifre) {
        $kontrol = $this->db->tekSatir("SELECT id FROM kullanicilar WHERE email = '$email'");
        if ($kontrol) {
            return "Bu email zaten kayıtlı!";
        }

        $hashli_sifre = password_hash($sifre, PASSWORD_DEFAULT);

        $sql = "INSERT INTO kullanicilar (kullanici_adi, email, sifre) 
                VALUES ('$kullanici_adi', '$email', '$hashli_sifre')";
        $this->db->sorgu($sql);

        return true;
    }

    // giriş yap
    public function girisYap($email, $sifre) {
        $kullanici = $this->db->tekSatir("SELECT * FROM kullanicilar WHERE email = '$email'");

        if (!$kullanici) {
            return "Bu email ile kayıtlı kullanıcı bulunamadı.";
        }

        if (!password_verify($sifre, $kullanici['sifre'])) {
            return "Şifre yanlış!";
        }

        session_start();
        $_SESSION['kullanici_id'] = $kullanici['id'];
        $_SESSION['kullanici_adi'] = $kullanici['kullanici_adi'];

        return true;
    }

    public function getKullanici($id) {
        return $this->db->tekSatir("SELECT * FROM kullanicilar WHERE id = $id");
    }
}