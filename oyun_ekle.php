<?php
session_start();

if (!isset($_SESSION['kullanici_id'])) {
    header("Location: login.php");
    exit();
}

require_once "classes/Game.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $game = new Game();
    $game->oyunEkle(
        $_POST['baslik'],
        $_POST['tur'],
        $_POST['platform'],
        $_POST['yil'],
        $_POST['aciklama'],
        $_SESSION['kullanici_id']
    );
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Oyun Ekle</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav>
    <a href="index.php">🎮 GameTracker</a>
    <a href="logout.php">Çıkış</a>
</nav>

<div class="form-kutu">
    <h2>Yeni Oyun Ekle</h2>

    <form method="POST">
        <label>Oyun Adı:</label>
        <input type="text" name="baslik" required>

        <label>Tür:</label>
        <input type="text" name="tur" placeholder="RPG, FPS, Spor...">

        <label>Platform:</label>
        <input type="text" name="platform" placeholder="PC, PS5, Xbox...">

        <label>Çıkış Yılı:</label>
        <input type="number" name="yil" placeholder="2024">

        <label>Açıklama:</label>
        <textarea name="aciklama" rows="5"></textarea>

        <button type="submit">Ekle</button>
    </form>
</div>

</body>
</html>