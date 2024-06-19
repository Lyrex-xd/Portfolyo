<?php
include("./database/conn.php");

if($_SESSION['durum'] != 1){
    header("Location: ./login.php");
}

// Müşteri verilerini çek
$sqlSelectCustomers = "SELECT * FROM musteriler";
$stmtSelectCustomers = $conn->query($sqlSelectCustomers);
$musteriler = $stmtSelectCustomers->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Müşteriler</title>
    <?php require_once("./include/header.php") ?>
</head>
<?php

// Form gönderildi mi kontrol et
if (isset($_GET['status']) && $_GET['status'] == "001") {
    ?>
    <div class="bildirimKutusu">
        <p>Kayıt başarı ile eklendi</p>
        <button type="button" onclick="refreshPageWithPostData()">Devam</button>
    </div>
    <?php
}
?>

    <a href="./" class="backArrow">&#x21e6;</a>
    <div class="musterilerContentBox procces_bg_color p-3">
        <div class="row">
        <div class="col-md-6">
            <form id="musteriForm" action="./process/index.php" method="post">
                <input type="hidden" name="musteriEkle">

                <div class="mb-3">
                    <label for="adiniz_soyadiniz" class="form-label">Adınız Soyadınız</label>
                    <input type="text" class="form-control" id="adiniz_soyadiniz" name="adiniz_soyadiniz" maxlength="70" placeholder="Adınız Soyadınız*" required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tel_1" class="form-label">Telefon 1</label>
                        <input type="tel" class="form-control" id="tel_1" name="tel_1" maxlength="10" placeholder="Telefon 1">
                    </div>
                    <div class="col-md-6">
                        <label for="tel_2" class="form-label">Telefon 2</label>
                        <input type="tel" class="form-control" id="tel_2" name="tel_2" maxlength="10" placeholder="Telefon 2">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="adresiniz" class="form-label">Adresiniz</label>
                    <textarea id="adresiniz" class="form-control" name="adresiniz" maxlength="700" placeholder="Adresiniz"></textarea>
                </div>

                <div class="mb-3">
                    <label for="aciklama" class="form-label">Açıklama</label>
                    <textarea id="aciklama" class="form-control" name="aciklama" maxlength="700" placeholder="Açıklamanız"></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="buton btn btn-warning">Kaydet</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="musteriler">
                <h2>Müşteriler:</h2>
                <div class="musterileriSiralamaKutusu table-responsive">
                    <table>
                    <thead>
                        <tr>
                            <th scope="col" class="px-4 py-2 sticky-top">ID</th>
                            <th scope="col" class="px-4 py-2 sticky-top">Adınız Soyadınız</th>
                            <th scope="col" class="px-4 py-2 sticky-top">Adres</th>
                            <th scope="col" class="px-4 py-2 sticky-top">Telefon 1</th>
                            <th scope="col" class="px-4 py-2 sticky-top">Telefon 2</th>
                            <th scope="col" class="px-4 py-2 sticky-top">Açıklama</th>
                            <th scope="col" class="px-4 py-2 sticky-top"></th>
                        </tr>
                    </thead>
                    <?php
                    // Müşteri listesini ekrana yazdır
                    foreach($musteriler as $musteri) {
                        ?>
                        <tr>
                            <td class="px-6 py-4"><?php echo $musteri['id']; ?></td>
                            <td class="px-6 py-4"><?php echo $musteri['adiniz_soyadiniz']; ?></td=>
                            <td class="px-6 py-4"><?php echo $musteri['adress']; ?></td>
                            <td class="px-6 py-4"><?php echo $musteri['tel_1']; ?></td>
                            <td class="px-6 py-4"><?php echo $musteri['tel_2']; ?></td>
                            <td class="px-6 py-4"><?php echo $musteri['aciklama']; ?></td>
                            <td class="px-6 py-4">
                                <form method="GET" action="./process/index.php">
                                    <input type="hidden" name="musteriler_id" value="<?php echo $musteri['id']; ?>">
                                    <input type="submit" class="buton" value="sil">
                                </form>
                            </td>
                        </tr>
                        
                        <?php
                    }
                    ?>
                    </table>
                </div>
            </div>
            </form>
        </div>
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