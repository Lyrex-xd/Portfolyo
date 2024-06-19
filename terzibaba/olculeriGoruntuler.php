<?php
include("./assets/database/conn.php");

if($_SESSION['durum'] != 1){
    header("Location: ./login.php");
}

$sqlSelectDimensions = "SELECT * FROM olculer";
$smtpSelectDimensions = $conn->query($sqlSelectDimensions);
$Dimensions = $smtpSelectDimensions->fetchAll(PDO::FETCH_ASSOC);
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
            <p>Ölçüyü Eklediniz!</p>
            <button type="button" onclick="refreshPageWithPostData()">Devam</button>
        </div>
    <?php
        }else if (isset($_GET['status']) && $_GET['status'] == "002") {
    ?>
        <div class="bildirimKutusu">
            <p>Seçilen Ölçü Silindi!</p>
            <button type="button" onclick="refreshPageWithPostData()">Devam</button>
        </div>
    <?php
        }else if(isset($_GET['status']) && $_GET['status'] == "003") {
    ?>
        <div class="bildirimKutusu">
            <p>Bir ölçü  Seçmeden Silemezsiniz!</p>
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
                <p>Ölçüler Tablosu "Backup" Kalsörüne Yedeklendi!</p>
                <button type="button" onclick="refreshPageWithPostData()">Devam</button>
            </div>
        <?php
        }else if(isset($_GET['status']) && $_GET['status'] == "008") {
        ?>
            <div class="bildirimKutusu">
                <p>Ölçüler Tablosu Temizlendi</p>
                <button type="button" onclick="refreshPageWithPostData()">Devam</button>
            </div>
        <?php
            }
    ?>


    <div class="baslik">
        <h1>TERZİ MÜŞTERİ TAKİP SİSTEMİ </h1>
    </div>
    <div class="proccesBgBox"  style="height: 500px;">
        <h1>Ölçüleri Görüntüle</h1>
        <hr>
        <div class="tableContent miniContent"  style="height: 300px;">
            <table class="olcuTable w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-4">
                            Ölçü Adı
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Açıklama
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Tarih
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Fiyat
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Ödenen
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Kalan
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Hırka Boyu
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Hırka Genişliği
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Kol Boyu
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Yaka
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Yelek Boyu
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Yelek Genişliği
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Etek Boyu
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Etek Genişliği
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Pantolon Boyu
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Pantolon Genişliği
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($Dimensions as $dimension) {
                    ?>
                    <tr id="olcuSelect<?php echo($dimension['id']) ?>" onclick="olcuSelectFunc('olcuSelect<?php echo($dimension['id']) ?>')" class=" border-b dark:bg-gray-800 dark:border-gray-700">
                        <td style="display: none;">
                            <?php echo($dimension['id']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo($dimension['olcu_adi']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo($dimension['aciklama']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo($dimension['tarih']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo($dimension['fiyat']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo($dimension['odenen']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo($dimension['kalan']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo($dimension['hirka_boyu']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo($dimension['hirka_genisligi1']) ?>/ <br>
                            <?php echo($dimension['hirka_genisligi2']) ?>/ <br>
                            <?php echo($dimension['hirka_genisligi3']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo($dimension['kol_boyu']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo($dimension['yaka1']) ?>/ <br>
                            <?php echo($dimension['yaka2']) ?>/ <br>
                            <?php echo($dimension['yaka3']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo($dimension['yelek_boyu']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo($dimension['yelek_genisligi1']) ?>/ <br>
                            <?php echo($dimension['yelek_genisligi2']) ?>/ <br>
                            <?php echo($dimension['yelek_genisligi3']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo($dimension['etek_boyu']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo($dimension['etek_genisligi1']) ?>/ <br>
                            <?php echo($dimension['etek_genisligi2']) ?>/ <br>
                            <?php echo($dimension['etek_genisligi3']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo($dimension['pantolon_boyu']) ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo($dimension['pantolon_genisligi1']) ?>/ <br>
                            <?php echo($dimension['pantolon_genisligi2']) ?>/ <br>
                            <?php echo($dimension['pantolon_genisligi3']) ?>
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
            <p>Seçilen Ölçü: <b id="secilenOlcu"></b></p>
        </div>
        <div class="col-md-4">
        </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
        <div class="col-md-4 yanyanaButton">
        <button onclick="yonlendir('./olcuKaydet.php')" class="button">Yeni Ölçü Kaydet</button>
        </div>
        <div class="col-md-4">
            <form action="./olcuDuzenle.php" method="post" id="musteriForm" class="yanyanaButton">
                <input type="hidden" id="olcuDuzenle" name="olcuDuzenle" value required>
                <input type="submit" class="musteriDuzenle button" value="Ölçü Düzenle">
            </form>
        </div>
        <div class="col-md-4">
            <form action="./assets/process/" method="post" id="musteriForm" class="yanyanaButton">
                <input type="hidden" id="silinecekOlcu" name="silinecekOlcu" value required>
                <input type="submit" class="musterisil button" value="Ölçü Sil">
            </form>
        </div>
        </div>
    </div>
    </div>
    </div>

    <script src="./assets/js/script.js"></script>
</body>
</html>