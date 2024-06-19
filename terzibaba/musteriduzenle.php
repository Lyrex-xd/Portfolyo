<?php
include("./assets/database/conn.php");

if($_SESSION['durum'] != 1){
    header("Location: ./login.php");
}

if(isset($_POST['duzenlencekMusteri'])) {
    if(!empty($_POST['duzenlencekMusteri'])) {
        $duzenlenecekVeri = $_POST['duzenlencekMusteri'];
        // Veritabanından "duzenlencekMusteri" id değerine sahip veriyi çek PDO ile
        $sorgu = $conn->prepare('SELECT * FROM musteriler WHERE id=:id');
        $sonuc = $sorgu -> execute(['id' => $duzenlenecekVeri]);
        // Eğer veri kayıt varsa kullanabilmek için bir değişkene ata
        if($sonuc) {
            $veriCek = $sorgu -> fetch(PDO::FETCH_ASSOC);
        } else {
            header("Location: ./musterileriGoruntule.php?status=004");
        };
    }else {
        header("Location: ./musterileriGoruntule.php?status=003");
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

    <div class="baslik">
        <h1 style="font-weight: bolder;">TERZİ MÜŞTERİ TAKİP SİSTEMİ </h1>
    </div>
    <div class="proccesBgBox" style="width: 40%;">
        
    <div class="container">
        <form action="./assets/process/" method="post">
            <h2>Müşteri Düzenle</h2>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <label for="adi_soyadi" class="formLabel">Adınız Soyadınız:</label>
                    <input type="text" id="adi_soyadi" class="formInputText" name="adiSoyadi" value="<?php echo($veriCek['adiniz_soyadiniz']) ?>" placeholder="Örn: Aynur Köycü">
                    <label for="tel" class="formLabel">Telefon Numarası:</label>
                    <input type="number" id="tel" maxlength="10" class="formInputText" value="<?php echo($veriCek['tel']) ?>" name="tel" placeholder="Örn: 5XXXXXXXXX">
                </div>
                <div class="col-md-6">
                    <label for="adress" class="formLabel">Adress:</label>
                    <input type="text" id="adress" class="formInputText" name="adress" value="<?php echo($veriCek['adress']) ?>" placeholder="Örn:XXX Mah. XXX Mah. No: XXX Kat: XXX">
                    <label for="aciklama" class="formLabel">Açıklama:</label>
                    <input type="text" id="aciklama" class="formInputText" name="aciklama" value="<?php echo($veriCek['aciklama']) ?>" placeholder="Açıklamanız">
                </div>
            </div>
                <input type="hidden" name="musteriDuzenle" value="<?php echo($veriCek['id']) ?>">
                <input type="submit" class="proccesButton" value="Kaydet">
        </form>
    </div>
    <script src="./assets/js/script.js"></script>
</body>
</html>






