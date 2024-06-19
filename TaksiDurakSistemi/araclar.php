<?php

include("./database/conn.php");

if($_SESSION['durum'] != 1){
    header("Location: ./login.php");
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Araçlar</title>
    <?php require_once("./include/header.php") ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css"  rel="stylesheet" />
</head>
<body>
<a href="./" class="backArrow">&#x21e6;</a>
<?php

// Müşteri verilerini çek
$sqlSelectCars = "SELECT * FROM araclar";
$stmtSelectCars = $conn->query($sqlSelectCars);
$araclar = $stmtSelectCars->fetchAll(PDO::FETCH_ASSOC);

// Form gönderildi mi kontrol et
if (isset($_GET['status']) && $_GET['status'] == "001") {?>
    <div class="bildirimKutusu">
        <p>Kayıt başarı ile eklendi</p>
        <button type="button" onclick="refreshPageWithPostData()">Devam</button>
    </div>
<?php
}
?>

   <form method="post" action="./process/" id="musteriForm">
    <div class="kutu2">
        <div class="kutu3">
        <input type="hidden" name="aracekle">
        <input type="text" id="metinkutusu1.2" maxlength="70" name="adiniz_soyadiniz" placeholder="Adınız Soyadınız"><br></br>
        <input type="tel" id="metinkutusu1.3" maxlength="10" name="tel_1" placeholder="Telefon 1"><br></br>
        <input type="tel" id="metinkutusu1.4" maxlength="10" name="tel_2" placeholder="Telefon 2"><br></br>
        <input type="text" id="metinkutusu1.5" maxlength="11" name="plaka" placeholder="Plakanız"><br></br>
        <input type="text" id="metinkutusu1.6" maxlength="99" name="marka_model" style="margin-top: -178px;" placeholder="Araç Marka-Modeliniz"><br></br>
        <input type="submit" value="Kaydet" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" style="margin-left: 282px;">
    </div> <div class= "araclarkutu">

    </form>

<div class="relative overflow-x-Table overflow-x-auto">
    <table class=" projectTables w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                 ID
                </th>
                <th scope="col" class="px-6 py-3">
                 Adı Soyadı
                </th>
                <th scope="col" class="px-6 py-3">
                 Telefon1
                </th>
                <th scope="col" class="px-6 py-3">
                Telefon2
                </th>
                <th scope="col" class="px-6 py-3">
                Plaka
                </th>
                <th scope="col" class="px-6 py-3">
                Marka Model
                </th>
                <th scope="col" class="px-6 py-3">

                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Müşteri listesini ekrana yazdır
                foreach ($araclar as $arac) {
                    ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4"><?php echo $arac['id']; ?> </td>
                        <td class="px-6 py-4"><?php echo $arac['adiniz_soyadiniz']; ?></td>
                        <td class="px-6 py-4"><?php echo $arac['tel_1']; ?></td>
                        <td class="px-6 py-4"><?php echo $arac['tel_2']; ?></td>
                        <td class="px-6 py-4"><?php echo $arac['plaka']; ?></td>
                        <td class="px-6 py-4"><?php echo $arac['marka_model']; ?></td>
                        <td class="px-6 py-4">
                            <form method="GET" action="./process/">
                                <input type="hidden" name="arac_id" value="<?php echo $arac['id']; ?>">
                                <input type="submit" class="deleteButton" value="sil">
                            </form>
                        </td>
                    </tr>
                    
                    <?php
                }
                ?>
        </tbody>
    </table>
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