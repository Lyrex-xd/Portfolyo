<?php
include("./assets/database/conn.php");


if($_SESSION['durum'] != 1){
    header("Location: ./login.php");
}

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terzi Takip Sistemi</title>
    <?php include("./assets/include/include_css.php") ?>
</head>

<body>
    <div class="ana">
        <div class="baslik">
            <h1>TERZİ MÜŞTERİ TAKİP SİSTEMİ </h1>
            <a href="./assets/process/logout.php" class="exitButton"><img src="./assets/image/exit.png" alt="Çıkış butonu"></a>
        </div>
        <div class="content">
            <div class="ana-div" id="div1">
                <div class="contentBox">
                    <button onclick="yonlendir('./musterileriGoruntule.php')" class="mainTitle">
                        <i class="fa-solid fa-user fa-2xl"></i> Müşterileri Görüntüle
                    </button>
                    <div class="button-container">
                        <a onclick="yonlendir('./musterikaydet.php')" class="little-button">Yeni Müşteri Kaydet</a>
                        <a onclick="yonlendir('./assets/process/index.php?musterileriYedekle=1')" class="little-button">Müşterileri Yedekle</a>
                        <a onclick="yonlendir('./assets/process/index.php?musterileriSil=1')" class="little-button">Müşter Tablosunu Sil</a>
                    </div>
                </div>
            </div>
            <div class="ana-div" id="div2">
                <div class="contentBox">
                    <button class="centerTitle mainTitle" onclick="yonlendir('./raporGoruntule.php')">
                        <i class="fa-solid fa-newspaper fa-2xl"></i> Rapor Görüntüle
                    </button>
                </div>
            </div>
            <div class="ana-div" id="div3">
                <div class="contentBox">
                    <button class="mainTitle" onclick="yonlendir('./olculeriGoruntuler.php')">
                        <i class="fa-solid fa-scissors fa-2xl"></i> Ölçüleri Görüntüle
                    </button>
                    <div class="button-container">
                        <a href="./olcuKaydet.php" class="little-button">Yeni Ölçü Kaydet </a>
                        <a onclick="yonlendir('./assets/process/index.php?olcuYedekle=1')" class="little-button">Ölçüleri Yedekle</a>
                        <a onclick="yonlendir('./assets/process/index.php?olcuSil=1')" class="little-button">Ölçü Verilerini Sil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets/js/script.js"></script>
</body>
</html>
