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

// Müşteri verilerini çek
$sqlSelectCars = "SELECT * FROM araclar";
$stmtSelectCars = $conn->query($sqlSelectCars);
$araclar = $stmtSelectCars->fetchAll(PDO::FETCH_ASSOC);

// Yollanan Araç verilerini çek
$sqlSendCar = "SELECT * FROM arac_yolla";
$stmtSendCar = $conn->query($sqlSendCar);
$yollananAraclar = $stmtSendCar->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
    <?php require_once("./include/header.php") ?>
</head>
<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <p class="welcomeText">Hoş Geldin: <?php echo($_SESSION['kullanici_adi']) ?></p>
                </div>
                <div class="nav navbar-nav">
                    <h1 class="HeaderTitle">Taksi Durağı Takip Sistemi</h1>
                </div>
                <div class="nav navbar-nav navbar-right">
                    <a href="./process/logout.php" class="exitButton"><img src="./assets/img/exit.png" alt="Çıkış butonu"></a>
                </div>
            </div>
        </nav>

    </header>
        <nav class="buttons_nav">
            <div class="buttons d-flex justify-content-center align-items-center">
                <a href="./musteriler.php" class="btn_navbar btn btn-warning"><i class="navbar_icon"><?php include("./assets/svg/musteriler_svg.php") ?></i> Müşteriler</a>
                <a href="./araclar.php" class="btn_navbar btn btn-warning"><i class="navbar_icon"><?php include("./assets/svg/araclar_svg.php") ?></i> Araçlar</a>
                <a href="./cagrilar.php" class="btn_navbar btn btn-warning"><i class="navbar_icon"><?php include("./assets/svg/cagrilar_svg.php") ?></i> Çağrılar</a>
                <a href="./ozet.php" class="btn_navbar btn btn-warning"><i class="navbar_icon"><?php include("./assets/svg/ozet_svg.php") ?></i> Özet</a>
                <a href="./kasa.php" class="btn_navbar btn btn-warning"><i class="navbar_icon"><?php include("./assets/svg/kasa_svg.php") ?></i> Kasa</a>
                <a href="./yedek_bakim.php" class="btn_navbar btn btn-warning"><i class="navbar_icon"><?php include("./assets/svg/yedek_svg.php") ?></i> Yedek Bakım</a>
                <a href="./rapor.php" class="btn_navbar btn btn-warning"><i class="navbar_icon"><?php include("./assets/svg/rapor_svg.php") ?></i> Rapor</a>
                <a href="https://wa.me/905079095691?text=Merhaba%20yardımcı%20olabilir%20misiniz" target="_blank" class="btn_navbar btn btn-warning"><i class="navbar_icon"><?php include("./assets/svg/whatsapp_svg.php") ?></i> Mesaj Gönder</a>
            </div>
        </nav>
        <div class="MainContent content">
            <div class="bilgiler procces_bg_color overflow-x-Table">
                <table class="musterilerTable projectTables w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Adınız Soyadınız</th>
                            <th scope="col" class="px-6 py-3">Adres</th>
                            <th scope="col" class="px-6 py-3">Telefon 1</th>
                            <th scope="col" class="px-6 py-3">Telefon 2</th>
                            <th scope="col" class="px-6 py-3">Açıklama</th>
                        </tr>
                    </thead>
                    <?php
                    // Müşteri listesini ekrana yazdır
                    foreach ($musteriler as $musteri) {
                        ?>
                        <tr id="musterilerSatir<?php echo $musteri['id'] ?>" onclick="musteriSelect('musterilerSatir<?php echo $musteri['id'] ?>')">
                            <td class="px-6 py-4"><?php echo $musteri['id']; ?> </td>
                            <td class="px-6 py-4"><?php echo $musteri['adiniz_soyadiniz']; ?></td=>
                            <td class="px-6 py-4"><?php echo $musteri['adress']; ?></td>
                            <td class="px-6 py-4"><?php echo $musteri['tel_1']; ?></td>
                            <td class="px-6 py-4"><?php echo $musteri['tel_2']; ?></td>
                            <td class="px-6 py-4"><?php echo $musteri['aciklama']; ?></td>
                        </tr>
                        
                        <?php
                    }
                    ?>
                </table>
                
                </div>
            <div class="notlar procces_bg_color overflow-x-Table">
                <table class="musterilerTable w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Müşteri Adı</th>
                        <th scope="col" class="px-6 py-3">Notlar</th>
                        <th scope="col" class="px-6 py-3">Hatırlatma Saati</th>
                    </tr>
                <?php 
                foreach($notlar as  $not) {
                ?>
                <tr>
                    <td  class="px-6 py-4"><?php echo($not['adiniz_soyadiniz']); ?></td>
                    <td  class="px-6 py-4"><?php echo($not['aciklama']); ?></td>
                    <td  class="px-6 py-4"><?php echo($not['hatirlatma']); ?></td>
                </tr>
                <?php
                }
                ?>
                </table>
            </div>
        
            <div class="yollanan_arac procces_bg_color overflow-x-Table">
                <table>
                    <tr>
                        <th>Müşteri Adı</th>
                        <th>Müşteri Telefonu</th>
                        <th>Müşteri Adresi</th>
                        <th>Gönderilen Araç</th>
                        <th>Gidiş Yeri</th>
                        <th></th>
                    </tr>
                    <?php 
                    foreach($yollananAraclar as $yollananArac){
                    ?>
                        <tr>
                            <td><?php echo $yollananArac['musteri_adi'] ?></td>
                            <td><?php echo $yollananArac['musteri_tel'] ?></td>
                            <td><?php echo $yollananArac['musteri_adress'] ?></td>
                            <td><?php echo $yollananArac['arac'] ?></td>
                            <td><?php echo $yollananArac['gidis_yeri'] ?></td>
                            <td>
                                <form method="POST" action="./process/">
                                    <input type="hidden" name="yollanan_arac_id" value="<?php echo $yollananArac['id']; ?>">
                                    <input type="submit" class="deleteButton" value="sil">
                                </form>
                            </td>
                        </tr>   
                    <?php
                    }
                    ?>
                </table>
            </div>
            
            <div class="arac_isteyen procces_bg_color overflow-x-Table">
                <h3>Araç İsteyen</h3>
                <form action="./process/" method="POST" class="container">
                    <input type="hidden" class="form-control" name="yollananAracEkle">
                    <div class="form-group row">
                        <label for="musteriAdi" class="col-sm-4 col-form-label">Müşteri Adı</label>
                        <div class="col-sm-8">
                        <input type="text" class="etkilemsiz-input form-control" id="musteriAdi" name="musteriAdi" onkeydown="return engelle()" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="musteriTel">Müşteri Tel</label>
                        </div>
                        
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="musteriTel" name="musteriTel" onkeydown="return engelle()" class="etkilemsiz-input" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="musteriAdress">Müşteri Adresi</label>
                        </div>
                        
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="musteriAdress" name="musteriAdress" onkeydown="return engelle()" class="etkilemsiz-input" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="SiradakiArac">Sıradaki Araç</label>
                        </div>
                        
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="SiradakiArac" name="SiradakiArac" onkeydown="return engelle()" class="etkilemsiz-input" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label for="GidisYeri">Gidiş Yeri</label>
                        </div>
                        
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="GidisYeri" name="GidisYeri" required>  
                        </div>
                    </div>
                    <input type="submit" value="Aracı Yolla" class="buton btn btn-warning">
                </form>
            </div>
            <div class="araclar procces_bg_color overflow-x-Table">
            <table>
                <tr>
                    <th>Araçlar</th>
                </tr>
                <?php
                foreach($araclar as $araba) {
                ?>
                <tr id="aracSatir<?php echo $araba['id'] ?>" onclick="aracSelect('aracSatir<?php echo $araba['id'] ?>')">
                    <td><?php echo($araba['marka_model']); ?></td>
                </tr>
                <?php
                }
                ?>
            </table>           
        </div>
    </div>
    </div>
    <!-- <div class="butonalt">
        
        <button type="button" class="btn btn-warning buton">Sıraya Araç Ekle</button>
        <button type="button" class="btn btn-warning buton">Sıradan Aracı Çıkar</button>
        <button type="button" class="btn btn-warning buton">Yukarı Taşı</button>
        <button type="button" class="btn btn-warning buton">Aşağı Taşı</button>
    </div> -->

  <script src="script.js"></script>
   
</body>
</html>