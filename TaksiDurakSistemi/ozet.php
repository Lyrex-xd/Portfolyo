<?php
include("./database/conn.php");

if($_SESSION['durum'] != 1){
    header("Location: ./login.php");
}

// Cagrilalar tablosunun satır sayısını çek
$sqlNotlar = "SELECT * FROM notlar";
$smtpNotlar = $conn->query($sqlNotlar);
$notlarSayisi = $smtpNotlar->rowCount();

$sqlNotlar = "SELECT * FROM musteriler";
$smtpMusteriler = $conn->query($sqlNotlar);
$musteriSayisi = $smtpMusteriler->rowCount();

$sqlAraclar = "SELECT * FROM araclar";
$smtpAraclar = $conn->query($sqlAraclar);
$aracSayisi = $smtpAraclar->rowCount();

$sqlAracYolla = "SELECT * FROM arac_yolla";
$smtpAAracYolla = $conn->query($sqlAracYolla);
$aracYollamaSayisi = $smtpAAracYolla->rowCount();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Özet</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css"  rel="stylesheet" />
    <?php include_once("./include/header.php") ?>
</head>
<body>
<a href="./" class="backArrow">&#x21e6;</a>
<div class="kutuozet"style=" width: 1000px; height: 650px; background-color: white; margin-top: 35px; margin-left: 270px;">
    
<div ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700: margin-left:440px;"style="margin-left:290px;">
   <li class="pb-3 sm:pb-4">
      <div class="flex items-center space-x-4 rtl:space-x-reverse">
         <div class="flex-shrink-0">
            <img class="w-8 h-8 rounded-full" src="img/araba.png" alt=" "style="width:50px;height:50px;">
         </div>
         <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
               Giden Araç Sayısı :
            </p>
            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
               Araçlar
            </p>
         </div>
         <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
            <?php echo $aracYollamaSayisi ?>
         </div>
      </div>
   </li>
   <li class="py-3 sm:py-4">
      <div class="flex items-center space-x-4 rtl:space-x-reverse">
         <div class="flex-shrink-0">
            <img class="w-8 h-8 rounded-full" src="img/telefon.png" alt="  "style="width:50px;height:50px;">
         </div>
         <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
              Gelen Telefon Sayısı :
            </p>
            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
               İletişim
            </p>
         </div>
         <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
            <?php
               echo($notlarSayisi);
            ?>
         </div>
      </div>
   </li>
   <li class="py-3 sm:py-4">
      <div class="flex items-center space-x-4 rtl:space-x-reverse">
         <div class="flex-shrink-0">
            <img class="w-8 h-8 rounded-full" src="img/müşteri1.2.png" alt=" "style="width:50px;height:50px;">
         </div>
         <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
               Kayıtlı Müşteri Sayısı :
            </p>
            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
               Müşteriler
            </p>
         </div>
         <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
            <?php echo($musteriSayisi) ?>
         </div>
      </div>
   </li>
   <li class="py-3 sm:py-4">
      <div class="flex items-center space-x-4 rtl:space-x-reverse">
         <div class="flex-shrink-0">
            <img class="w-8 h-8 rounded-full" src="img/taxi2.png " alt="  "style="width:50px;height:50px;">
         </div>
         <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
               Kayıtlı Araç Sayısı 
            </p>
            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
               Araçlar
            </p>
         </div>
         <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
         <?php echo($aracSayisi) ?>
         </div>
      </div>
   </li>
   <li class="pt-3 pb-0 sm:pt-4">
      <div class="flex items-center space-x-4 rtl:space-x-reverse">
         <div class="flex-shrink-0">
            <img class="w-8 h-8 rounded-full" src="img/destek.png" alt="Neil image"style="width:50px;height:50px;">
         </div>
         <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                Sırada Bulunan Araç Sayısı :
            </p>
            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
               
            </p>
         </div>
         <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
            -
         </div>
      </div>
   </li>
</ul>
</div>

</div>
</body>
</html>