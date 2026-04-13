<?php
require_once "Database.php";

class Game {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function tumOyunlar() {
        return $this->db->tumSatirlar("SELECT * FROM oyunlar ORDER BY id DESC");
    }

    public function oyunGetir($id) {
        return $this->db->tekSatir("SELECT * FROM oyunlar WHERE id = $id");
    }

    public function oyunEkle($baslik, $tur, $platform, $yil, $aciklama, $kullanici_id) {
        $sql = "INSERT INTO oyunlar (baslik, tur, platform, yil, aciklama, ekleyen_id) 
                VALUES ('$baslik', '$tur', '$platform', '$yil', '$aciklama', '$kullanici_id')";
        $this->db->sorgu($sql);
    }

    public function yorumlariGetir($oyun_id) {
        return $this->db->tumSatirlar(
            "SELECT y.*, k.kullanici_adi FROM yorumlar y 
             JOIN kullanicilar k ON y.kullanici_id = k.id 
             WHERE y.oyun_id = $oyun_id 
             ORDER BY y.tarih DESC"
        );
    }

    public function yorumEkle($kullanici_id, $oyun_id, $puan, $yorum) {
        $sql = "INSERT INTO yorumlar (kullanici_id, oyun_id, puan, yorum) 
                VALUES ('$kullanici_id', '$oyun_id', '$puan', '$yorum')";
        $this->db->sorgu($sql);
    }
}