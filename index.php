<?php
session_start();
require_once "classes/Game.php";

$game = new Game();
$oyunlar = $game->tumOyunlar();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>GameTracker - Ana Sayfa</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav>
    <a href="index.php">🎮 GameTracker</a>
    <div>
        <?php if (isset($_SESSION['kullanici_id'])): ?>
            <a href="oyun_ekle.php">+ Oyun Ekle</a>
            <a href="profil.php"><?= $_SESSION['kullanici_adi'] ?></a>
            <a href="logout.php">Çıkış</a>
        <?php else: ?>
            <a href="login.php">Giriş Yap</a>
            <a href="register.php">Kayıt Ol</a>
        <?php endif; ?>
    </div>
</nav>

<div class="sayfa">
    <h1>Oyunlar</h1>

    <div class="oyun-grid">
        <?php foreach ($oyunlar as $oyun): ?>
            <a href="oyun_detay.php?id=<?= $oyun['id'] ?>" class="oyun-kart">
                <div class="kart-icerik">
                    <h3><?= $oyun['baslik'] ?></h3>
                    <p><?= $oyun['tur'] ?> · <?= $oyun['platform'] ?></p>
                    <small><?= $oyun['yil'] ?></small>
                </div>
            </a>
        <?php endforeach; ?>

        <?php if (empty($oyunlar)): ?>
            <p>Henüz oyun eklenmemiş.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>