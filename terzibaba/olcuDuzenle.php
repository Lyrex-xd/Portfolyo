<?php
include("./assets/database/conn.php");

if($_SESSION['durum'] != 1){
    header("Location: ./login.php");
}

if(isset($_POST['olcuDuzenle'])) {
    if(!empty($_POST['olcuDuzenle'])) {
        $duzenlenecekVeri = $_POST['olcuDuzenle'];
        // Veritabanından "duzenlencekMusteri" id değerine sahip veriyi çek PDO ile
        $sorgu = $conn->prepare('SELECT * FROM olculer WHERE id=:id');
        $sonuc = $sorgu -> execute(['id' => $duzenlenecekVeri]);
        // Eğer veri kayıt varsa kullanabilmek için bir değişkene atar
        if($sonuc) {
            $veriCek = $sorgu -> fetch(PDO::FETCH_ASSOC);
        } else {
            header("Location: ./olcuDuzenle.php?status=004");
        };
    }else {
        header("Location: ./olcuDuzenle.php?status=003");
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Müşteri Düzenle</title>
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
                    <input type="number" class="form-control" id="hirkaBoyu" name="hirkaBoyu" value="<?php echo($veriCek['hirka_boyu']) ?>">
                </div>
                <div class="mb-3">
                    <label for="hirkaGenisligi" class="form-label">Hirka Genişliği</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="hirkaGenisligi hirkaGenisligi1" name="hirkaGenisligi1"  value="<?php echo($veriCek['hirka_genisligi1']) ?>">
                        <input type="number" class="form-control" id="hirkaGenisligi2" name="hirkaGenisligi2"  value="<?php echo($veriCek['hirka_genisligi2']) ?>">
                        <input type="number" class="form-control" id="hirkaGenisligi3" name="hirkaGenisligi3"  value="<?php echo($veriCek['hirka_genisligi3']) ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="kolBoyu" class="form-label">Kol Boyu</label>
                    <input type="number" class="form-control" id="kolBoyu" name="kolBoyu"  value="<?php echo($veriCek['kol_boyu']) ?>">
                </div>
                <div class="mb-3">
                    <label for="yaka" class="form-label">Yaka</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="yaka yaka1" name="yaka1"  value="<?php echo($veriCek['yaka1']) ?>">
                        <input type="number" class="form-control" id="yaka2" name="yaka2"  value="<?php echo($veriCek['yaka2']) ?>">
                        <input type="number" class="form-control" id="yaka3" name="yaka3"  value="<?php echo($veriCek['yaka3']) ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="yelekBoyu" class="form-label">Yelek Boyu</label>
                    <input type="number" class="form-control" id="yelekBoyu" name="yelekBoyu"  value="<?php echo($veriCek['yelek_boyu']) ?>">
                </div>
                <div class="mb-3">
                    <label for="yelekGenisligi" class="form-label">Yelek Geişliği</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="yelekGenisligi yelekGenisligi1" name="yelekGenisligi1"  value="<?php echo($veriCek['yelek_genisligi1']) ?>">
                        <input type="number" class="form-control" id="yelekGenisligi2" name="yelekGenisligi2"  value="<?php echo($veriCek['yelek_genisligi2']) ?>">
                        <input type="number" class="form-control" id="yelekGenisligi3" name="yelekGenisligi3"  value="<?php echo($veriCek['yelek_genisligi3']) ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="etekBoyu" class="form-label">Etek Boyu</label>
                    <input type="number" class="form-control" id="etekBoyu" name="etekBoyu"  value="<?php echo($veriCek['etek_boyu']) ?>">
                </div>
                <div class="mb-3">
                    <label for="etekGenisligi" class="form-label">Etek Geişliği</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="etekGenisligi etekGenisligi1" name="etekGenisligi1" value="<?php echo($veriCek['etek_genisligi1']) ?>">
                        <input type="number" class="form-control" id="etekGenisligi2" name="etekGenisligi2" value="<?php echo($veriCek['etek_genisligi2']) ?>">
                        <input type="number" class="form-control" id="etekGenisligi3" name="etekGenisligi3" value="<?php echo($veriCek['etek_genisligi3']) ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="pantolonBoyu" class="form-label">Pantolon Boyu</label>
                    <input type="number" class="form-control" id="pantolonBoyu" name="pantolonBoyu" value="<?php echo($veriCek['pantolon_boyu']) ?>">
                </div>
                <div class="mb-3">
                    <label for="pantolonGenişliği" class="form-label">Pantolon Geişliği</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="pantolonGenişliği pantolonGenişliği1" name="pantolonGenişliği1"  value="<?php echo($veriCek['pantolon_genisligi1']) ?>">
                        <input type="number" class="form-control" id="pantolonGenişliği2" name="pantolonGenişliği2"  value="<?php echo($veriCek['pantolon_genisligi2']) ?>">
                        <input type="number" class="form-control" id="pantolonGenişliği3" name="pantolonGenişliği3"  value="<?php echo($veriCek['pantolon_genisligi3']) ?>">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <form>
                <div class="mb-3">
                    <label for="olcuAdi" class="form-label">Ölçü Adı:</label>
                    <input type="text" class="form-control" id="olcuAdi" name="olcuAdi"  value="<?php echo($veriCek['olcu_adi']) ?>">
                </div>
                <div class="mb-3">
                    <label for="tarih" class="form-label">Tarih:</label>
                    <input type="date" class="form-control" id="tarih" name="tarih"  value="<?php echo($veriCek['tarih']) ?>">
                </div>
                <div class="mb-3">
                    <label for="fiyat" class="form-label">Fiyat:</label>
                    <input type="number" class="form-control" id="fiyat" name="fiyat"  value="<?php echo($veriCek['fiyat']) ?>">
                </div>
                <div class="mb-3">
                    <label for="odenen" class="form-label">Ödenen:</label>
                    <input type="number" class="form-control" id="odenen" name="odenen"  value="<?php echo($veriCek['odenen']) ?>">
                </div>
                <div class="mb-3">
                    <label for="kalan" class="form-label">Kalan:</label>
                    <input type="number" class="form-control" id="kalan" name="kalan" value="<?php echo($veriCek['kalan']) ?>">
                </div>
                <div class="mb-3">
                    <label for="aciklama" class="form-label">Açıklama</label>
                    <textarea name="aciklama" id="aciklama" class="form-control" cols="30" rows="10"><?php echo($veriCek['aciklama']) ?></textarea>
                </div>
                <input type="hidden" name="olcuDuzenle" value="<?php echo($veriCek['id']) ?>">
                <input type="submit" class="form-button proccesButton" value="Kaydet">
            </div>
            </div>
        </div>
        </form>
    </div>
    <script src="./assets/js/script.js"></script>
</body>
</html>






