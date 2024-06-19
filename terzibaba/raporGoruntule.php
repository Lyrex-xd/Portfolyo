<?php
include("./assets/database/conn.php");

if($_SESSION['durum'] != 1){
    header("Location: ./login.php");
}

$sqlSelectCustomers = "SELECT * FROM musteriler";
$smtpSelectCustomers = $conn->query($sqlSelectCustomers);
$Customers = $smtpSelectCustomers->fetchAll(PDO::FETCH_ASSOC);

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
    <div class="baslik">
        <h1 style="font-weight: bolder;">TERZİ MÜŞTERİ TAKİP SİSTEMİ </h1>
    </div>
    <div class="proccesBgBox">
        <div class="tableContent">
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
                    <tr class="border-b dark:bg-gray-800 dark:border-gray-700">
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
        <hr>
        <div class="tableContent">
        <table class="olcuTable w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-4">
                            Ölçü<br>
                            Adı
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
                            Hırka<br>
                            Boyu
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Hırka<br>
                            Genişliği
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Kol<br>
                            Boyu
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Yaka
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Yelek<br>
                            Boyu
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Yelek<br>
                            Genişliği
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Etek<br>
                            Boyu
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Etek<br>
                            Genişliği
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Pantolon<br>
                            Boyu
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Pantolon<br>
                            Genişliği
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($Dimensions as $dimension) {
                    ?>
                    <tr class=" border-b dark:bg-gray-800 dark:border-gray-700">
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
        <div class="container mt-5">
            <div class="row" style="flex-direction: row-reverse;flex-wrap: wrap;">
            <div class="col-md-3">
                <button onclick="yonlendir('./musterileriGoruntule.php')" class="form-control btn btn-success">Müşterileri Düzenle</button>
            </div>
            <div class="col-md-3">
                <button onclick="yonlendir('./olculeriGoruntuler.php')" class="form-control btn btn-success ">Ölçüleri Düzenle</button>
            </div>
            </div>
        </div>
        <script src="./assets/js/script.js"></script>
</body>
</html>