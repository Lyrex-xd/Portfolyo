<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My PHP Page</title>
    <?php require_once("./include/header.php") ?>
</head>
<body>
<a href="./" class="backArrow">&#x21e6;</a>
<?php
// Form gönderildi mi kontrol et
if (isset($_GET['status']) && $_GET['status'] == "003") {
    ?>
    <div class="bildirimKutusu">
        <p>Kayıtlı Araçlar Silindi</p>
        <button type="button" onclick="refreshPageWithPostData()">Tamam</button>
    </div>
    <?php
}
else if (isset($_GET['status']) && $_GET['status'] == "004") {
    ?>
    <div class="bildirimKutusu">
        <p>Veri Tabanı Yedeği Alındı</p>
        <button type="button" onclick="refreshPageWithPostData()">Tamam</button>
    </div>
    <?php
}else if (isset($_GET['status']) && $_GET['status'] == "002") {
    ?>
    <div class="bildirimKutusu">
        <p>Yollanan Araç Verisi Tablosu Silindi</p>
        <button type="button" onclick="refreshPageWithPostData()">Tamam</button>
    </div>
    <?php
}else if (isset($_GET['status']) && $_GET['status'] == "001") {
    ?>
    <div class="bildirimKutusu">
        <p>Kayıtlı Arama listesi Temizlendi</p>
        <button type="button" onclick="refreshPageWithPostData()">Tamam</button>
    </div>
    <?php
}
?>

<div class="box"style="width: 1000px; height: 790px; background-color: white; margin-top: 10px; margin-left: 260px; border-radius: 1rem;">
<div class=" box"style="border-radius:0.5rem; width: 900px; height: 110px; background-color: gray; margin-top: 20px; margin-left: 40px; border-radius: 1rem;" ><img src="img/yedek1.png">
<p  style="margin-top:-65px; margin-left:170px;font-weight:bold; width:315px">Kayıtlı bulunan gelen arama listesini temizler.</p>
<form action="./process/" id="GetCleaner" method="post">
    <button type="submit" style="border-radius:0.5rem; background-color: yellow; width: 210px; height: 37px; position: relative; top: -40px; margin-left: 430px;" name="notTemizleme">Notları Listesini Temizle</button>
</form>

<div class=" box"style="width: 900px; height: 110px; background-color: gray; margin-top: 5px; margin-left: -10px; border-radius: 1rem;"><img src="img/yedek2.png">
<p  style="margin-top:-65px;font-weight:bold; margin-left:170px; width:300px">Yollanan Araç yerlerini temizler.</p>
<form action="./process/" id="GetCleaner" method="post">
    <button type="submit" style="border-radius:0.5rem; background-color: yellow; width: 210px; height: 37px; position: relative; top: -40px; margin-left: 430px;" name="yollananAracıTemizle">Araç Hareketlerini Temizle</button>
</form>

<div class=" box"style="border-radius:0.5rem; width: 900px; height: 110px; background-color: gray; margin-top:5px; margin-left: -10px; border-radius: 1rem;"><img src="img/yedek3.png">
<p  style="font-weight:bold; margin-top:-65px; margin-left:170px; width:300px">Kayıtlı bulunan araçları temizler.</p>
<form action="./process/" id="GetCleaner" method="post">
    <button type="submit" style="border-radius:0.5rem; background-color: yellow; width: 210px; height: 37px; position: relative; top: -40px; margin-left: 430px;" name="aracTemizleme">Kayıtlı Araçları Temizle</button>
</form>

<div class=" box"style="border-radius:0.5rem; width: 900px; height: 110px; background-color: gray; margin-top:5px; margin-left: -10px; border-radius: 1rem;"><img src="img/yedek3.png">
<p  style="font-weight:bold; margin-top:-65px; margin-left:170px; width:300px">Kayıtlı bulunan araçları temizler.</p>
<form action="./process/" id="GetCleaner" method="post">
    <button type="submit" style="border-radius:0.5rem; background-color: yellow; width: 210px; height: 37px; position: relative; top: -40px; margin-left: 430px;" name="aracTemizleme">Kayıtlı Araçları Temizle</button>
</form>

<div class=" box"style="border-radius:0.5rem; width: 900px; height: 110px; background-color: gray; margin-top: 5px; margin-left: -10px; border-radius: 1rem;"><img src="img/yedek4.png">
<p  style="font-weight:bold; margin-top:-65px; margin-left:170px; width:300px">Tüm bilgileriniz yedekler.</p>
<form action="./process/" id="GetCleaner" method="post">
    <button type="submit" style="border-radius:0.5rem; background-color: yellow; width: 210px; height: 37px; position: relative; top: -40px; margin-left: 430px;" name="backup">Veritabanı Yedeği Al</button>
</form>
</div>
</body>
</html>

<script>
    function refreshPageWithPostData() {
        // Formu gönder
        document.getElementById("GetCleaner").submit();
        
        // Sayfayı temizle ve yenile
        history.replaceState({}, document.title, window.location.pathname);
        location.reload();
    }
</script>
