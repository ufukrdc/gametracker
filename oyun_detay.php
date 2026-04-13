<?php
session_start();
require_once "classes/Game.php";

$id = $_GET['id'];
$game = new Game();

$oyun = $game->oyunGetir($id);
$yorumlar = $game->yorumlariGetir($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['kullanici_id'])) {
    $game->yorumEkle(
        $_SESSION['kullanici_id'],
        $id,
        $_POST['puan'],
        $_POST['yorum']
    );
    header("Location: oyun_detay.php?id=$id");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title><?= $oyun['baslik'] ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav>
    <a href="index.php">GameTracker</a>
    <?php if (isset($_SESSION['kullanici_id'])): ?>
        <a href="logout.php">Çıkış</a>
    <?php else: ?>
        <a href="login.php">Giriş Yap</a>
    <?php endif; ?>
</nav>

<div class="sayfa">
    <div class="oyun-detay">
        <h1><?= $oyun['baslik'] ?></h1>
        <p><strong>Tür:</strong> <?= $oyun['tur'] ?></p>
        <p><strong>Platform:</strong> <?= $oyun['platform'] ?></p>
        <p><strong>Yıl:</strong> <?= $oyun['yil'] ?></p>
        <p><?= $oyun['aciklama'] ?></p>
    </div>

    <?php if (isset($_SESSION['kullanici_id'])): ?>
    <div class="yorum-form">
        <h3>Yorum Yaz</h3>
        <form method="POST">
            <label>Puan (1-10):</label>
            <input type="number" name="puan" min="1" max="10" required>

            <label>Yorumun:</label>
            <textarea name="yorum" rows="4" required></textarea>

            <button type="submit">Gönder</button>
        </form>
    </div>
    <?php else: ?>
        <p><a href="login.php">Giriş yaparak</a> yorum yazabilirsiniz.</p>
    <?php endif; ?>

    <div class="yorumlar">
        <h3>Yorumlar (<?= count($yorumlar) ?>)</h3>

        <?php foreach ($yorumlar as $y): ?>
        <div class="yorum-kart">
            <strong><?= $y['kullanici_adi'] ?></strong>
            <span class="puan">⭐ <?= $y['puan'] ?>/10</span>
            <p><?= $y['yorum'] ?></p>
            <small><?= $y['tarih'] ?></small>
        </div>
        <?php endforeach; ?>

        <?php if (empty($yorumlar)): ?>
            <p>Henüz yorum yok.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>