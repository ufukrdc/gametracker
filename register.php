<?php
session_start();
require_once "classes/User.php";

$hata = "";
$basari = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User();
    $sonuc = $user->kayitOl($_POST['kullanici_adi'], $_POST['email'], $_POST['sifre']);

    if ($sonuc === true) {
        $basari = "Kayıt başarılı! Giriş yapabilirsiniz.";
    } else {
        $hata = $sonuc;
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav>
    <a href="index.php">🎮 GameTracker</a>
    <a href="login.php">Giriş Yap</a>
</nav>

<div class="form-kutu">
    <h2>Kayıt Ol</h2>

    <?php if ($hata != "") echo "<p class='hata'>$hata</p>"; ?>
    <?php if ($basari != "") echo "<p class='basari'>$basari</p>"; ?>

    <form method="POST">
        <label>Kullanıcı Adı:</label>
        <input type="text" name="kullanici_adi" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Şifre:</label>
        <input type="password" name="sifre" required>

        <button type="submit">Kayıt Ol</button>
    </form>

    <p>Zaten hesabın var mı? <a href="login.php">Giriş yap</a></p>
</div>

</body>
</html>