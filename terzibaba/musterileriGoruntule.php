<?php
include("./assets/database/conn.php");

if($_SESSION['durum'] != 1){
    header("Location: ./login.php");
}

$sqlSelectCustomers = "SELECT * FROM musteriler";
$smtpSelectCustomers = $conn->query($sqlSelectCustomers);
$Customers = $smtpSelectCustomers->fetchAll(PDO::FETCH_ASSOC);
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
    <?php
        // Form gönderildi mi kontrol et
        if(isset($_GET['status']) && $_GET['status'] == "001") {
    ?>
        <div class="bildirimKutusu">
            <p>Kişiyi Eklediniz!</p>
            <button type="button" onclick="refreshPageWithPostData()">Devam</button>
        </div>
    <?php
        }else if (isset($_GET['status']) && $_GET['status'] == "002") {
    ?>
        <div class="bildirimKutusu">
            <p>Seçilen Kişi Silindi!</p>
            <button type="button" onclick="refreshPageWithPostData()">Devam</button>
        </div>
    <?php
        }else if(isset($_GET['status']) && $_GET['status'] == "003") {
    ?>
        <div class="bildirimKutusu">
            <p>Bir Kişiyi  Seçmeden Silemezsiniz!</p>
            <button type="button" onclick="refreshPageWithPostData()">Devam</button>
        </div>
    <?php
    }else if(isset($_GET['status']) && $_GET['status'] == "004") {
    ?>
        <div class="bildirimKutusu">
            <p>Böyle Bir Kayıt Yok!</p>
            <button type="button" onclick="refreshPageWithPostData()">Devam</button>
        </div>
    <?php
        }else if(isset($_GET['status']) && $_GET['status'] == "005") {
    ?>
        <div class="bildirimKutusu">
            <p>Kayıt Başarı ile Güncellendi!</p>
            <button type="button" onclick="refreshPageWithPostData()">Devam</button>
        </div>
    <?php
        }else if(isset($_GET['status']) && $_GET['status'] == "006") {
        ?>
            <div class="bildirimKutusu">
                <p>Böyle Bir Kayıt Bulunamadı!</p>
                <button type="button" onclick="refreshPageWithPostData()">Devam</button>
            </div>
        <?php
        }else if(isset($_GET['status']) && $_GET['status'] == "007") {
        ?>
            <div class="bildirimKutusu">
                <p>Tablo Proje İçersinde ki "Backup" Klasörüne Yedeklendi!</p>
                <button type="button" onclick="refreshPageWithPostData()">Devam</button>
            </div>
        <?php
            }else if(isset($_GET['status']) && $_GET['status'] == "008") {
        ?>
            <div class="bildirimKutusu">
                <p>Müşteriler Tablosu Silindi!</p>
                <button type="button" onclick="refreshPageWithPostData()">Devam</button>
            </div>
        <?php
            }
    ?>

    <div class="baslik">
        <h1 style="font-weight: bolder;">TERZİ MÜŞTERİ TAKİP SİSTEMİ </h1>
    </div>
    <div class="proccesBgBox" style="height: 500px;">
        <h1>Müşterileri Görüntüle</h1>
        <hr>
        <div class="tableContent"  style="height: 300px;">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                        Adı Soyadı
                        </th>
                        <th scope="col" class="px-6 py-3">
                        Telefon
                        </th>
                    
                        <th scope="col" class="px-6 py-3">
                        Adres
                        </th>
                        <th scope="col" class="px-6 py-3">
                        Açıklama
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($Customers as $customer) {
                    ?>
                    <tr id="musteriSelect<?php echo($customer['id']) ?>" onclick="musteriSelect('musteriSelect<?php echo($customer['id']) ?>')" class="border-b dark:bg-gray-800 dark:border-gray-700">
                        <td style="display: none;">
                            <?php echo($customer['id']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo($customer['adiniz_soyadiniz']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo($customer['tel']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo($customer['adress']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo($customer['aciklama']) ?>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="container">
        <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <p>Seçilen Müşteri: <b id="secilensilme"></b></p>
        </div>
        <div class="col-md-4">
        </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
        <div class="col-md-4 yanyanaButton">
        <button onclick="yonlendir('./musterikaydet.php')" class="button">Yeni Müşteri Kaydet</button>
        </div>
        <div class="col-md-4">
            <form action="./musteriDuzenle.php" method="post" id="musteriForm" class="yanyanaButton">
                <input type="hidden" id="duzenlencekMusteri" name="duzenlencekMusteri" value required>
                <input type="submit" class="musteriDuzenle button" value="Müşteri Düzenle">
            </form>
        </div>
        <div class="col-md-4">
            <form action="./assets/process/" method="post" id="musteriForm" class="yanyanaButton">
                <input type="hidden" id="silinecekMusteri" name="silinecekMusteri" value required>
                <input type="submit" class="musterisil button" value="Müşteri Sil">
            </form>
        </div>
        </div>
    </div>
    </div>
    <script src="./assets/js/script.js"></script>
</body>
</html>