<?php
include("./../database/conn.php");

if(isset($_POST['girisYap'])){
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];

    $query = "SELECT * FROM kullancilar WHERE e_posta = :e_posta AND sifre = :sifre";  
    $statement = $conn->prepare($query);  
    $statement->execute(  
        array(  
            'e_posta'     =>     $email,  
            'sifre'     =>     $sifre  
        )
    );  
    $count = $statement->rowCount();  
    if($count > 0)  
    {  
        // Müşteri verilerini çek
        $sqlSelectCustomers = "SELECT * FROM kullancilar";
        $stmtSelectCustomers = $conn->query($sqlSelectCustomers);
        $musteriler = $stmtSelectCustomers->fetchAll(PDO::FETCH_ASSOC);
        foreach($musteriler as $musteri) {
            $_SESSION["kullanici_adi"] = $musteri['kullanici_adi'];
            $_SESSION["durum"] = 1;
        }
        header("location: ./../../");
        exit();
    }  
    else  
    {  
        echo("Giriş Yapılmadı");
        header("location: ./../../login.php?status=001");
        exit();
    }  
}

// Müşteri Ekleme
if(isset($_POST['musteriKaydet'])){
    $adinizSoyadiniz = $_POST['adiSoyadi'];
    $telephone = $_POST['tel'];
    $adress = $_POST['adress'];
    $aciklama = $_POST['aciklama'];
  
    // Veritabanına müşteri ekle
    $sqlInsertCustomer = "INSERT INTO musteriler (adiniz_soyadiniz, tel, adress, aciklama) VALUES (?, ?, ?, ?)";
    $stmtInsertCustomer = $conn->prepare($sqlInsertCustomer);
    $stmtInsertCustomer->execute([$adinizSoyadiniz, $telephone, $adress, $aciklama]);

    header("Location: ./../../musterileriGoruntule.php?status=001");
}

if (isset($_POST['musteriDuzenle'])) {
    $museriID = $_POST['musteriDuzenle'];
    $adinizSoyadiniz = $_POST['adiSoyadi'];
    $tel = $_POST['tel'];
    $adress = $_POST['adress'];
    $aciklama = $_POST['aciklama'];
    $sqlUpdateCostomer = "UPDATE musteriler SET adiniz_soyadiniz = :adiniz_soyadiniz, tel = :tel, adress = :adress, aciklama = :aciklama WHERE id = :id";
    $smtpUpdateCostomer = $conn->prepare($sqlUpdateCostomer);

    $smtpUpdateCostomer->bindParam(':adiniz_soyadiniz', $adinizSoyadiniz, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':tel', $tel, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':adress', $adress, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':aciklama', $aciklama, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':id', $museriID, PDO::PARAM_STR);

    // Güncelleme sorgusunu çalıştır
    $smtpUpdateCostomer->execute();

    // Güncelleme işleminden sonra rowCount kullanabilirsiniz
    if ($smtpUpdateCostomer->rowCount() > 0) {
        header("Location: ./../../musterileriGoruntule.php?status=005");
    } else {
        header("Location: ./../../musterileriGoruntule.php?status=006");
    }
}


// Müşteri Sil
if(isset($_POST['silinecekMusteri'])) {
    if(!empty($_POST['silinecekMusteri'])) {
        $silinecekID = $_POST['silinecekMusteri'];

        // Veritabanından müşteriyi sil
        $sqlDeleteCustomer = "DELETE FROM musteriler WHERE id = ?";
        $stmtDeleteCustomer = $conn->prepare($sqlDeleteCustomer);
        $stmtDeleteCustomer->execute([$silinecekID]);

        header("Location: ./../../musterileriGoruntule.php?status=002");
    }else {
        header("Location: ./../../musterileriGoruntule.php?status=003");
    }
}

if(isset($_POST['olcuKaydet'])) {
    $hirkaBoyu = $_POST['hirkaBoyu'];
    $hirkaGenisligi1 = $_POST['hirkaGenisligi1'];
    $hirkaGenisligi2 = $_POST['hirkaGenisligi2'];
    $hirkaGenisligi3 = $_POST['hirkaGenisligi3'];
    $kolBoyu = $_POST['kolBoyu'];
    $yaka1 = $_POST['yaka1'];
    $yaka2 = $_POST['yaka2'];
    $yaka3 = $_POST['yaka3'];
    $yelekBoyu = $_POST['yelekBoyu'];
    $yelekGenisligi1 = $_POST['yelekGenisligi1'];
    $yelekGenisligi2 = $_POST['yelekGenisligi2'];
    $yelekGenisligi3 = $_POST['yelekGenisligi3'];
    $etekBoyu = $_POST['etekBoyu'];
    $etekGenisligi1 = $_POST['etekGenisligi1'];
    $etekGenisligi2 = $_POST['etekGenisligi2'];
    $etekGenisligi3 = $_POST['etekGenisligi3'];
    $pantolonBoyu = $_POST['pantolonBoyu'];
    $pantolonGenişliği1 = $_POST['pantolonGenişliği1'];
    $pantolonGenişliği2 = $_POST['pantolonGenişliği2'];
    $pantolonGenişliği3 = $_POST['pantolonGenişliği3'];
    $olcuAdi = $_POST['olcuAdi'];
    $tarih = $_POST['tarih'];
    $fiyat = $_POST['fiyat'];
    $odenen = $_POST['odenen'];
    $kalan = $_POST['kalan'];
    $aciklama = $_POST['aciklama'];
  
    // Veritabanına müşteri ekle
    $sqlInsertCustomer = "INSERT INTO olculer (
        olcu_adi, 
        aciklama, 
        tarih, 
        fiyat, 
        odenen,
        kalan, 
        hirka_boyu,
        hirka_genisligi1, 
        hirka_genisligi2, 
        hirka_genisligi3, 
        kol_boyu,
        yaka1,
        yaka2,
        yaka3,
        yelek_boyu,
        yelek_genisligi1,
        yelek_genisligi2,
        yelek_genisligi3,
        etek_boyu,
        etek_genisligi1,
        etek_genisligi2,
        etek_genisligi3,
        pantolon_boyu,
        pantolon_genisligi1,
        pantolon_genisligi2,
        pantolon_genisligi3
        ) VALUES (
            ?,
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?, 
            ?
            )";
    $stmtInsertCustomer = $conn->prepare($sqlInsertCustomer);
    $stmtInsertCustomer->execute([
        $olcuAdi, 
        $aciklama, 
        $tarih, 
        $fiyat, 
        $odenen, 
        $kalan, 
        $yelekBoyu, 
        $hirkaGenisligi1, 
        $hirkaGenisligi2, 
        $hirkaGenisligi3, 
        $kolBoyu,
        $yaka1,
        $yaka2,
        $yaka3,
        $yelekBoyu,
        $yelekGenisligi1,
        $yelekGenisligi2,
        $yelekGenisligi3,
        $etekBoyu,
        $etekGenisligi1,
        $etekGenisligi2,
        $etekGenisligi3,
        $pantolonBoyu,
        $pantolonGenişliği1,
        $pantolonGenişliği2,
        $pantolonGenişliği3
    ]);

    header("Location: ./../../olculeriGoruntuler.php?status=001");
}

if (isset($_POST['olcuDuzenle'])) {
    $olcuID = $_POST['olcuDuzenle'];
    $hirkaBoyu = $_POST['hirkaBoyu'];
    $hirkaGenisligi1 = $_POST['hirkaGenisligi1'];
    $hirkaGenisligi2 = $_POST['hirkaGenisligi2'];
    $hirkaGenisligi3 = $_POST['hirkaGenisligi3'];
    $kolBoyu = $_POST['kolBoyu'];
    $yaka1 = $_POST['yaka1'];
    $yaka2 = $_POST['yaka2'];
    $yaka3 = $_POST['yaka3'];
    $yelekBoyu = $_POST['yelekBoyu'];
    $yelekGenisligi1 = $_POST['yelekGenisligi1'];
    $yelekGenisligi2 = $_POST['yelekGenisligi2'];
    $yelekGenisligi3 = $_POST['yelekGenisligi3'];
    $etekBoyu = $_POST['etekBoyu'];
    $etekGenisligi1 = $_POST['etekGenisligi1'];
    $etekGenisligi2 = $_POST['etekGenisligi2'];
    $etekGenisligi3 = $_POST['etekGenisligi3'];
    $pantolonBoyu = $_POST['pantolonBoyu'];
    $pantolonGenişliği1 = $_POST['pantolonGenişliği1'];
    $pantolonGenişliği2 = $_POST['pantolonGenişliği2'];
    $pantolonGenişliği3 = $_POST['pantolonGenişliği3'];
    $olcuAdi = $_POST['olcuAdi'];
    $tarih = $_POST['tarih'];
    $fiyat = $_POST['fiyat'];
    $odenen = $_POST['odenen'];
    $kalan = $_POST['kalan'];
    $aciklama = $_POST['aciklama'];

    $sqlUpdateCostomer = "UPDATE olculer SET 
        olcu_adi = :olcu_adi, 
        aciklama = :aciklama, 
        tarih = :tarih, 
        fiyat = :fiyat, 
        odenen = :odenen,
        kalan = :kalan, 
        hirka_boyu = :hirka_boyu,
        hirka_genisligi1 = :hirka_genisligi1, 
        hirka_genisligi2 = :hirka_genisligi2, 
        hirka_genisligi3 = :hirka_genisligi3, 
        kol_boyu = :kol_boyu,
        yaka1 = :yaka1,
        yaka2 = :yaka2,
        yaka3 = :yaka3,
        yelek_boyu = :yelek_boyu,
        yelek_genisligi1 = :yelek_genisligi1,
        yelek_genisligi2 = :yelek_genisligi2,
        yelek_genisligi3 = :yelek_genisligi3,
        etek_boyu = :etek_boyu,
        etek_genisligi1 = :etek_genisligi1,
        etek_genisligi2 = :etek_genisligi2,
        etek_genisligi3 = :etek_genisligi3,
        pantolon_boyu = :pantolon_boyu,
        pantolon_genisligi1 = :pantolon_genisligi1,
        pantolon_genisligi2 = :pantolon_genisligi2,
        pantolon_genisligi3 = :pantolon_genisligi3
        WHERE id = :id";
    $smtpUpdateCostomer = $conn->prepare($sqlUpdateCostomer);

    $smtpUpdateCostomer->bindParam(':olcu_adi', $olcuAdi, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':aciklama', $aciklama, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':tarih', $tarih, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':fiyat', $fiyat, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':odenen', $odenen, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':kalan', $kalan, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':hirka_boyu', $hirkaBoyu, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':hirka_genisligi1', $hirkaGenisligi1, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':hirka_genisligi2', $hirkaGenisligi2, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':hirka_genisligi3', $hirkaGenisligi3, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':kol_boyu', $kolBoyu, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':yaka1', $yaka1, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':yaka2', $yaka2, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':yaka3', $yaka3, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':yelek_boyu', $yelekBoyu, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':yelek_genisligi1', $yelekGenisligi1, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':yelek_genisligi2', $yelekGenisligi2, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':yelek_genisligi3', $yelekGenisligi3, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':etek_boyu', $etekBoyu, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':etek_genisligi1', $etekGenisligi1, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':etek_genisligi2', $etekGenisligi2, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':etek_genisligi3', $etekGenisligi3, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':pantolon_boyu', $pantolonBoyu, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':pantolon_genisligi1', $pantolonGenişliği1, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':pantolon_genisligi2', $pantolonGenişliği2, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':pantolon_genisligi3', $pantolonGenişliği3, PDO::PARAM_STR);
    $smtpUpdateCostomer->bindParam(':id', $olcuID, PDO::PARAM_STR);

    // Güncelleme sorgusunu çalıştır
    $smtpUpdateCostomer->execute();

    // Güncelleme işleminden sonra rowCount kullanabilirsiniz
    if ($smtpUpdateCostomer->rowCount() > 0) {
        header("Location: ./../../olculeriGoruntuler.php?status=005");
    } else {
        header("Location: ./../../olculeriGoruntuler.php?status=006");
    }
}

if(isset($_POST['silinecekOlcu'])) {
    if(!empty($_POST['silinecekOlcu'])) {
        $silinecekID = $_POST['silinecekOlcu'];

        // Veritabanından müşteriyi sil
        $sqlDeleteCustomer = "DELETE FROM olculer WHERE id = ?";
        $stmtDeleteCustomer = $conn->prepare($sqlDeleteCustomer);
        $stmtDeleteCustomer->execute([$silinecekID]);

        header("Location: ./../../olculeriGoruntuler.php?status=002");
    }else {
        header("Location: ./../../olculeriGoruntuler.php?status=003");
    }
}

if(isset($_GET['musterileriYedekle'])) {
    if(!empty($_GET['musterileriYedekle'])) {
        // Bağlantı ayarları
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "terzibaba";

        // Veritabanı bağlantısı oluştur
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        // Yedekleme sorgusu oluştur
        $backupQuery = "SELECT * INTO OUTFILE 'C:/xampp/htdocs/terzibaba/assets/backup/musteriler_backup_" . date('Y-m-d_H-i-s') . ".csv'
                        FIELDS TERMINATED BY ','
                        OPTIONALLY ENCLOSED BY '\"'
                        LINES TERMINATED BY '\n'
                        FROM musteriler";

        // Yedekleme işlemi gerçekleştir
        $conn->exec($backupQuery);

        header("Location: ./../../musterileriGoruntule.php?status=007");

    }
}

if(isset($_GET['musterileriYedekle'])) {
    if(!empty($_GET['musterileriYedekle'])) {
        // Yedekleme sorgusu oluştur
        $backupQuery = "SELECT * INTO OUTFILE '" . $dosyaYolu . "/assets/backup/musteriler_backup_" . date('Y-m-d_H-i-s') . ".csv'
                        FIELDS TERMINATED BY ','
                        OPTIONALLY ENCLOSED BY '\"'
                        LINES TERMINATED BY '\n'
                        FROM musteriler";

        // Yedekleme işlemi gerçekleştir
        $conn->exec($backupQuery);

        header("Location: ./../../musterileriGoruntule.php?status=007");

    }
}

if(isset($_GET['musterileriSil'])) {
    if(!empty($_GET['musterileriSil'])) {
        // "musteriler" tablosunu silme sorgusu
        $sql = "DROP TABLE musteriler";
        
        // Sorguyu hazırla ve çalıştır
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        header("Location: ./../../musterileriGoruntule.php?status=008");
    }
}

if(isset($_GET['olcuYedekle'])) {
    if(!empty($_GET['olcuYedekle'])) {
        // Yedekleme sorgusu oluştur
        $backupQuery = "SELECT * INTO OUTFILE '" . $dosyaYolu . "/../backup/olculer_backup_" . date('Y-m-d_H-i-s') . ".csv'
                        FIELDS TERMINATED BY ','
                        OPTIONALLY ENCLOSED BY '\"'
                        LINES TERMINATED BY '\n'
                        FROM olculer";


        // Yedekleme işlemi gerçekleştir
        $conn->exec($backupQuery);

        header("Location: ./../../olculeriGoruntuler.php?status=007");

    }
}

if(isset($_GET['olcuSil'])) {
    if(!empty($_GET['olcuSil'])) {
        // "musteriler" tablosunu silme sorgusu
        $sql = "DROP TABLE olculer";
        
        // Sorguyu hazırla ve çalıştır
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        header("Location: ./../../olculeriGoruntuler.php?status=008");
    }
}

?>