<?php

if($_SESSION['durum'] != 1){
    header("Location: ./login.php");
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olçü Kaydet - Terzi Takip Sistemi</title>
    <?php include("./assets/include/include_css.php") ?>
</head>
<body>
    <a href="./" class="anaSayfa"><i class="fas fa-home"></i></a>
    <div class="baslik">
        <h1 style="font-weight: bolder;">TERZİ MÜŞTERİ TAKİP SİSTEMİ </h1>
    </div>
    <div class="proccesBgBox" style="width: 40%; margin-top: 10px;margin-bottom: 50px;">
        
    <div class="container">
        <form action="./assets/process/" method="post">
            <h2>Ölçü Ekle</h2>
            <hr>
            <div class="container mt-5">
            <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="hirkaBoyu" class="form-label">Hırka Boyu:</label>
                    <input type="number" class="form-control" id="hirkaBoyu" name="hirkaBoyu">
                </div>
                <div class="mb-3">
                    <label for="hirkaGenisligi" class="form-label">Hirka Genişliği</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="hirkaGenisligi hirkaGenisligi1" name="hirkaGenisligi1">
                        <input type="number" class="form-control" id="hirkaGenisligi2" name="hirkaGenisligi2">
                        <input type="number" class="form-control" id="hirkaGenisligi3" name="hirkaGenisligi3">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="kolBoyu" class="form-label">Kol Boyu</label>
                    <input type="number" class="form-control" id="kolBoyu" name="kolBoyu">
                </div>
                <div class="mb-3">
                    <label for="yaka" class="form-label">Yaka</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="yaka yaka1" name="yaka1">
                        <input type="number" class="form-control" id="yaka2" name="yaka2">
                        <input type="number" class="form-control" id="yaka3" name="yaka3">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="yelekBoyu" class="form-label">Yelek Boyu</label>
                    <input type="number" class="form-control" id="yelekBoyu" name="yelekBoyu">
                </div>
                <div class="mb-3">
                    <label for="yelekGenisligi" class="form-label">Yelek Geişliği</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="yelekGenisligi yelekGenisligi1" name="yelekGenisligi1">
                        <input type="number" class="form-control" id="yelekGenisligi2" name="yelekGenisligi2">
                        <input type="number" class="form-control" id="yelekGenisligi3" name="yelekGenisligi3">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="etekBoyu" class="form-label">Etek Boyu</label>
                    <input type="number" class="form-control" id="etekBoyu" name="etekBoyu">
                </div>
                <div class="mb-3">
                    <label for="etekGenisligi" class="form-label">Etek Geişliği</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="etekGenisligi etekGenisligi1" name="etekGenisligi1">
                        <input type="number" class="form-control" id="etekGenisligi2" name="etekGenisligi2">
                        <input type="number" class="form-control" id="etekGenisligi3" name="etekGenisligi3">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="pantolonBoyu" class="form-label">Pantolon Boyu</label>
                    <input type="number" class="form-control" id="pantolonBoyu" name="pantolonBoyu">
                </div>
                <div class="mb-3">
                    <label for="pantolonGenişliği" class="form-label">Pantolon Geişliği</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="pantolonGenişliği pantolonGenişliği1" name="pantolonGenişliği1">
                        <input type="number" class="form-control" id="pantolonGenişliği2" name="pantolonGenişliği2">
                        <input type="number" class="form-control" id="pantolonGenişliği3" name="pantolonGenişliği3">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <form>
                <div class="mb-3">
                    <label for="olcuAdi" class="form-label">Ölçü Adı:</label>
                    <input type="text" class="form-control" id="olcuAdi" name="olcuAdi">
                </div>
                <div class="mb-3">
                    <label for="tarih" class="form-label">Tarih:</label>
                    <input type="date" class="form-control" id="tarih" name="tarih">
                </div>
                <div class="mb-3">
                    <label for="fiyat" class="form-label">Fiyat:</label>
                    <input type="number" class="form-control" id="fiyat" name="fiyat">
                </div>
                <div class="mb-3">
                    <label for="odenen" class="form-label">Ödenen:</label>
                    <input type="number" class="form-control" id="odenen" name="odenen">
                </div>
                <div class="mb-3">
                    <label for="kalan" class="form-label">Kalan:</label>
                    <input type="number" class="form-control" id="kalan" name="kalan">
                </div>
                <div class="mb-3">
                    <label for="aciklama" class="form-label">Açıklama</label>
                    <textarea name="aciklama" id="aciklama" class="form-control" cols="30" rows="10"></textarea>
                </div>
                <input type="hidden" name="olcuKaydet">
                <input type="submit" class="form-button proccesButton" value="Kaydet">
            </div>
            </div>
        </div>
                
        </form>
    </div>
    <script src="./assets/js/script.js"></script>
</body>
</html>






