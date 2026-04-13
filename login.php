<?php
session_start();

if (isset($_SESSION['kullanici_id'])) {
    header("Location: index.php");
    exit();
}

require_once "classes/User.php";

$hata = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User();
    $sonuc = $user->girisYap($_POST['email'], $_POST['sifre']);

    if ($sonuc === true) {
        header("Location: index.php");
        exit();
    } else {
        $hata = $sonuc;
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav>
    <a href="index.php">GameTracker</a>
    <a href="register.php">Kayıt Ol</a>
</nav>

<div class="form-kutu">
    <h2>Giriş Yap</h2>

    <?php if ($hata != "") echo "<p class='hata'>$hata</p>"; ?>

    <form method="POST">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Şifre:</label>
        <input type="password" name="sifre" required>

        <button type="submit">Giriş Yap</button>
    </form>

    <p>Hesabın yok mu? <a href="register.php">Kayıt ol</a></p>
</div>

</body>
</html>