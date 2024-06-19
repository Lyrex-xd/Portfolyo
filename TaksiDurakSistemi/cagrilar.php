<?php
include("./database/conn.php");

if($_SESSION['durum'] != 1){
    header("Location: ./login.php");
}

// Müşteri verilerini çek
$sqlSelectCustomers = "SELECT * FROM musteriler";
$stmtSelectCustomers = $conn->query($sqlSelectCustomers);
$musteriler = $stmtSelectCustomers->fetchAll(PDO::FETCH_ASSOC);

// Notlar verilerini çek
$sqlSelectNots = "SELECT * FROM notlar";
$stmtSelectNots = $conn->query($sqlSelectNots);
$notlar = $stmtSelectNots->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Çağrılar</title>
    <?php require_once("./include/header.php") ?>
</head>
<body>
    <a href="./" class="backArrow">&#x21e6;</a>
    <div class="kutucagri">
        <div class="resimKutusu1">
            <img class="suslemeResmi suslemeResmi1" src="img/çağrı1.png" alt="çağrı">
        </div>
        <div class="ResimKutusu2">
            <img class="suslemeResmi suslemeResmi2" src="img/taxi2.png" >
        </div>
        <div class="cagriBodyIcerik">
            <div class="cagriIcerik">

                <h2>Çağrı Ekle;</h2>
                <form action="./process/" method="post">
                    <input type="hidden" name="not_ekle">
                    <label for="musteri_adi">Müşteri Seçin:</label>
                    <select name="musteri_adi" id="musteri_adi">
                        <?php
                        foreach($musteriler as $musteri) {
                            ?>
                            <option value="<?php echo($musteri['adiniz_soyadiniz']); ?>"><?php echo($musteri['adiniz_soyadiniz']); ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <textarea name="notAciklama" class="notAciklama" cols="30" rows="10"></textarea>
                    <label for="hatirlatmaTarihi" class="tarihLabel">Hatırlatma Tarihi</label>
                    <input name="hatirlatmaTarihi" class="hatirlatmaTarihi" id="hatirlatmaTarihi" type="date">
                    <input type="submit" value="Kaydet">
                </form>
            </div>
        
            <div class="cagrikutusu">
                <h2 class="NotlarBaslik">Notlar</h2>
                <table class="notlarTablosu">
                    <tr>
                        <th>Müşteri Adı</th>
                        <th>Notlar</th>
                        <th>Hatırlatma Saati</th>
                        <th>Kayıt Tarihi</th>
                        <th>Durum</th>
                    </tr>
                    <?php
                    foreach($notlar as $not) {
                        ?>
                        <tr>
                        <td><?php echo($not['adiniz_soyadiniz']); ?></td>
                        <td><?php echo($not['aciklama']); ?></td>
                        <td><?php echo($not['hatirlatma']); ?></td>
                        <td><?php echo($not['kayit']); ?></td>
                        <td>
                            <form method="POST" action="process/">
                                <input type="hidden" name="notSil" value="<?php echo($not['id']); ?>">
                                <input type="submit" value="Tamamlandı!">
                            </form>
                        </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
