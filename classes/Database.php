<?php
class Database {
    private $baglanti;

    public function __construct() {
        $this->baglanti = mysqli_connect("localhost", "root", "", "gametracker");

        if (!$this->baglanti) {
            die("Bağlantı hatası: " . mysqli_connect_error());
        }

        mysqli_set_charset($this->baglanti, "utf8");
    }

    public function sorgu($sql) {
        $sonuc = mysqli_query($this->baglanti, $sql);
        return $sonuc;
    }

    public function tekSatir($sql) {
        $sonuc = mysqli_query($this->baglanti, $sql);
        return mysqli_fetch_assoc($sonuc);
    }

    public function tumSatirlar($sql) {
        $sonuc = mysqli_query($this->baglanti, $sql);
        $dizi = [];
        while ($satir = mysqli_fetch_assoc($sonuc)) {
            $dizi[] = $satir;
        }
        return $dizi;
    }

    public function getBaglanti() {
        return $this->baglanti;
    }
}