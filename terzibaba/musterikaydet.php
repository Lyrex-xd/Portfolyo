<?php
include("./assets/database/conn.php");

if($_SESSION['durum'] != 1){
    header("Location: ./login.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Müşteri Kaydet</title>
    <?php include("./assets/include/include_css.php") ?>
</head>
<body>
<a href="./" class="anaSayfa"><i class="fas fa-home"></i></a>
    <div class="baslik">
        <h1 style="font-weight: bolder;">TERZİ MÜŞTERİ TAKİP SİSTEMİ </h1>
    </div>
    <div class="proccesBgBox" style="width: 40%;">
        
    <div class="container">
        <form action="./assets/process/" method="post">
            <h2>Müşteri Ekle</h2>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <label for="adi_soyadi" class="formLabel">Adınız Soyadınız:</label>
                    <input type="text" id="adi_soyadi" class="formInputText" name="adiSoyadi" placeholder="Örn: Aynur Köycü">
                    <label for="tel" class="formLabel">Telefon Numarası:</label>
                    <input type="number" id="tel" maxlength="10" class="formInputText" name="tel" placeholder="Örn: 5XXXXXXXXX">
                </div>
                <div class="col-md-6">
                    <label for="adress" class="formLabel">Adress:</label>
                    <input type="text" id="adress" class="formInputText" name="adress" placeholder="Örn:XXX Mah. XXX Mah. No: XXX Kat: XXX">
                    <label for="aciklama" class="formLabel">Açıklama:</label>
                    <input type="text" id="aciklama" class="formInputText" name="aciklama" placeholder="Açıklamanız">
                </div>
            </div>
                <input type="hidden" name="musteriKaydet">
                <input type="submit" class="proccesButton" value="Kaydet">
        </form>
    </div>
    <script src="./assets/js/script.js"></script>
</body>
</html>






