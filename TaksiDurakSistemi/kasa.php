<?php
include("./database/conn.php");

if($_SESSION['durum'] != 1){
    header("Location: ./login.php");
}

// Kasa Giderler verilerini çek
$sqlSelectExpenditure = "SELECT * FROM kasa WHERE tur = 'Gider'";
$stmtSelectExpenditure = $conn->query($sqlSelectExpenditure);
$giderler = $stmtSelectExpenditure->fetchAll(PDO::FETCH_ASSOC);

// Kasa Gelir verilerini çek
$sqlSelectRevenues = "SELECT * FROM kasa WHERE tur = 'Gelir'";
$stmtSelectRevenues = $conn->query($sqlSelectRevenues);
$gelirler = $stmtSelectRevenues->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasa</title>
    <?php include_once("./include/header.php") ?>
</head>
<a href="./" class="backArrow">&#x21e6;</a>
  <div class="border"style=" width: 1360px; height: 705px; background-color: white; margin-top: 5px; margin-left: 70px;">
    <div class="border2" style="width:640px; height:325px; background-color: gray; border-radius: 0.5rem; margin-top:15px; margin-left:15px;">
      <table class="giderTablosu projectTables w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <tr>
          <th>Tür</th>
          <th>Tutar</th>
          <th>Açıklama</th>
          <th>Tarih</th>
          <th></th>
        </tr>
        <?php
        foreach($giderler as $gider) {
          ?>
          <tr>
          <td><?php echo($gider['tur']); ?></td>
          <td><?php echo($gider['miktar']) ?></td>
          <td><?php echo($gider['aciklama']) ?></td>
          <td><?php echo($gider['tarih']) ?></td>
          <td>
          <form action="./process/index.php" method="POST">
              <input type='hidden' name="giderSil" value="<?php echo($gider["id"])?>"/>
              <input type="submit" value="Sil">
            </form>
          </td>
        </tr>
          <?php
        }
        ?>
      </table>
    </div>
    <div class="border3"style="width:640px; height:325px; background-color: gray; border-radius: 0.5rem; margin-top:-325px; margin-left:700px;">
    <table class="giderTablosu projectTables w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <tr>
            <th>Tür</th>
            <th>Tutar</th>
            <th>Açıklama</th>
            <th>Tarih</th>
            <th></th>
          </tr>
          <?php
        foreach($gelirler as $gelir) {
          ?>
          <tr>
            <td><?php echo($gelir['tur']) ?></td>
            <td><?php echo($gelir['miktar']) ?></td>
            <td><?php echo($gelir['aciklama']); ?></td>
            <td><?php echo($gelir['tarih']) ?></td>
            <td>
              <form action="./process/index.php" method="POST">
                <input type='hidden' name="gelirSil" value="<?php echo($gelir["id"])?>"/>
                <input type="submit" value="Sil">
              </form>
            </td>
        </tr>
          <?php
        }
        ?>
        </table>
    </div>
    
    <div class="border4" style="width:640px; height:325px; background-color: gray; border-radius: 0.5rem; margin-top:15px; margin-left:15px;">
    <form action="./process/index.php" method="post">
      <input type="hidden" name="giderEkle">
      <input type="number" id="numericInput" name="miktar" class="custom-textbox" placeholder=" ₺" style="margin-left: 220px; margin-top: 130px; border-radius: 0.5rem; width: 280px;">
      <button type="submit" style="margin-left: -229px; height: 50px; width: 92px; background-color: blue; border-radius: 0.5rem; font-weight: 700;">Kaydet</button>
      <input type="text" name="aciklama" class="custom-textbox" placeholder=" "style=" position:relative; border-radius: 0.5rem; margin-top: 20px; margin-left: 175px; height: 120px; width: 325px;">
      <p style="margin-top: -125px; font-size: 22px; font-weight: bold; margin-left: 47px; margin-bottom: 1rem;">Açıklama : </p>
      <p style="margin-top: -105px; font-size: 22px; font-weight: bold; margin-left: 47px; margin-bottom: 1rem;">Harcama Tutarı : </p>
      <p style="margin-top:-170px; font-size: 22px; font-weight: bold; margin-left: 220px; margin-bottom: 1rem;">Bugüne Gider Ekle/Sil</p>
    </form>
  </div>
    
    <div class="border5"style="width:640px; height:325px; background-color: gray; border-radius: 0.5rem; margin-top:-325px; margin-left:700px;">
    <form action="./process/index.php" method="post">
      <input type="hidden" name="gelirEkle">
      <input type="number" name="miktar" id="myTextbox" class="custom-textbox" placeholder=" ₺" style="margin-left: 220px; margin-top: 130px; border-radius: 0.5rem; width: 280px;">
      <button type="submit" style="margin-left: -229px; height: 50px; width: 92px; background-color: blue; border-radius: 0.5rem; font-weight: 700;">Kaydet</button>
      <input type="text" name="aciklama" id="myTextbox" class="custom-textbox" placeholder=" "style=" position:relative; border-radius: 0.5rem; margin-top: 20px; margin-left: 175px; height: 120px; width: 325px;">
      <p style="margin-top: -125px; font-size: 22px; font-weight: bold; margin-left: 47px; margin-bottom: 1rem;">Açıklama : </p>
      <p style="margin-top: -105px; font-size: 22px; font-weight: bold; margin-left: 47px; margin-bottom: 1rem;">Kazanç Tutarı : </p>
      <p style="margin-top:-170px; font-size: 22px; font-weight: bold; margin-left: 220px; margin-bottom: 1rem;">Bugüne Gelir Ekle/Sil</p>
    </form>
  </div>
  
  </div>

  <script src="./script.js"></script>
</body>
</html>