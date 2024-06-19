<?php
include("./assets/database/conn.php");

if(isset($_SESSION['durum']) && $_SESSION['durum'] == 1){
    header("Location: ./");
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Kayıt Olma Ekranı</title>
    <link rel="stylesheet" href="./assets/css/login.css">
</head>
<body>

<div class="container">
    <form action="./assets/process/" method="post">
        <h2>Giriş Yap</h2>
        <input type="hidden" name="girisYap">
        <div class="form-group">
            <label for="email">E-posta:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="sifre">Şifre:</label>
            <input type="password" id="sifre" name="sifre" required>
        </div>

        <?php
        if(isset($_GET['status']) && $_GET['status'] == "001") {
            ?>
            <p style="color:#ff0000;"></p>Kullanıcı adı veya şifre yanlış</p>
        <?php
        }
        ?>
        <input type="submit" value="Giriş Yap">
    </form>
</div>


<script>
    function refreshPageWithPostData() {
        // Formu gönder
        document.getElementById("musteriForm").submit();
        
        // Sayfayı temizle ve yenile
        history.replaceState({}, document.title, window.location.pathname);
        location.reload();
    }
</script>
</body>
</html>