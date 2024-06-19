<?php
session_start();
include("./../database/conn.php");

if(isset($_POST['girisYap'])){
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];

    $query = "SELECT * FROM kullanicilar WHERE mail = :mail AND sifre = :sifre";  
    $statement = $conn->prepare($query);  
    $statement->execute(  
        array(  
            'mail'     =>     $email,  
            'sifre'     =>     $sifre  
        )
    );  
    $count = $statement->rowCount();  
    if($count > 0)  
    {  
        // Müşteri verilerini çek
        $sqlSelectCustomers = "SELECT * FROM kullanicilar";
        $stmtSelectCustomers = $conn->query($sqlSelectCustomers);
        $musteriler = $stmtSelectCustomers->fetchAll(PDO::FETCH_ASSOC);
        foreach($musteriler as $musteri) {
            $_SESSION["kullanici_adi"] = $musteri['kullanici_adi'];
            $_SESSION["durum"] = 1;
        }
        header("location: ./../");
        exit();
    }  
    else  
    {  
        echo("Giriş Yapılmadı");
        header("location: ./../login.php?status=001");
        exit();
    }  
}

/* KAYIT EKLEME VE SİLME İŞLEMLERİ   */

// Müşteri Ekler ve Raporlar
if(isset($_POST['musteriEkle'])) {
    // Form verilerini al
    $nameSurname = $_POST["adiniz_soyadiniz"];
    $tel1 = $_POST["tel_1"];
    $tel2 = $_POST["tel_2"];
    $adress = $_POST["adresiniz"];
    $aciklama = $_POST["aciklama"];

    // Veritabanına müşteri ekle
    $sqlInsertCustomer = "INSERT INTO musteriler (adiniz_soyadiniz, tel_1, tel_2, adress, aciklama) VALUES (?, ?, ?, ?, ?)";
    $stmtInsertCustomer = $conn->prepare($sqlInsertCustomer);
    $stmtInsertCustomer->execute([$nameSurname, $tel1, $tel2, $adress, $aciklama]);

    // Olayı Raporla
    $rapor_aciklama  = $nameSurname . " isimli müşteri ekleme isteği gönderildi.";
    $rapor_durum = "1";
    $rapor_tarih = date("Y-m-d");
    $rapor_saat = date("h:i:s");
    $sqlDurumRaporla = "INSERT INTO rapor (aciklama, durum, tarih, saat) VALUES (?,?,?,?)";
    $smtpDurumRaporla = $conn->prepare($sqlDurumRaporla);
    $smtpDurumRaporla->execute([$rapor_aciklama, $rapor_durum, $rapor_tarih, $rapor_saat]);

    // Sayfaya Geri Yönlendir.
    header("Location: ./../musteriler.php?status=001");
}

// Müşteri Silme İşlemini Yapar Ve Raporlar
if (isset($_GET['musteriler_id'])) {
    $silinecekID = $_GET['musteriler_id'];

    $query = "SELECT adiniz_soyadiniz FROM musteriler WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->bindParam(':id', $silinecekID, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    $musteri_adi = $result['adiniz_soyadiniz'];

    // Sonucu al ve işle
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    // Veritabanından müşteriyi sil
    $sqlDeleteCustomer = "DELETE FROM musteriler WHERE id = ?";
    $stmtDeleteCustomer = $conn->prepare($sqlDeleteCustomer);
    $stmtDeleteCustomer->execute([$silinecekID]);

    // Olayı Raporla
    $rapor_aciklama  = $musteri_adi . " isimli müşteri kaydı silme isteği gönderildi.";
    $rapor_durum = "1";
    $rapor_tarih = date("Y-m-d");
    $rapor_saat = date("h:i:s");

    $sqlDurumRaporla = "INSERT INTO rapor (aciklama, durum, tarih, saat) VALUES (?,?,?,?)";
    $smtpDurumRaporla = $conn->prepare($sqlDurumRaporla);
    $smtpDurumRaporla->execute([$rapor_aciklama, $rapor_durum, $rapor_tarih, $rapor_saat]);

    // Sayfaya Geri Yönlendir.
    header("Location: ./../musteriler.php");
}

// Araç Ekler ve Raporlar
if(isset($_POST['aracekle'])) {
    // Form verilerini al
    $nameSurname = $_POST["adiniz_soyadiniz"];
    $tel1 = $_POST["tel_1"];
    $tel2 = $_POST["tel_2"];
    $plaka = $_POST["plaka"];
    $marka_model = $_POST["marka_model"];

    // Veritabanına müşteri ekle
    $sqlInsertCustomer = "INSERT INTO araclar (adiniz_soyadiniz, tel_1, tel_2, plaka, marka_model) VALUES (?, ?, ?, ?, ?)";
    $stmtInsertCustomer = $conn->prepare($sqlInsertCustomer);
    $stmtInsertCustomer->execute([$nameSurname, $tel1, $tel2, $plaka, $marka_model]);

    // Olayı Raporla
    $rapor_aciklama  = $marka_model . " markalı araç ekleme isteği gönderildi.";
    $rapor_durum = "1";
    $rapor_tarih = date("Y-m-d");
    $rapor_saat = date("h:i:s");
    $sqlDurumRaporla = "INSERT INTO rapor (aciklama, durum, tarih, saat) VALUES (?,?,?,?)";
    $smtpDurumRaporla = $conn->prepare($sqlDurumRaporla);
    $smtpDurumRaporla->execute([$rapor_aciklama, $rapor_durum, $rapor_tarih, $rapor_saat]);
    
    header("Location: ./../araclar.php?status=001");
}

// Kayıtlı Aracı siler ve Raporlar
if (isset($_GET['arac_id'])) {
    $silinecekID = $_GET['arac_id'];

    $query = "SELECT marka_model FROM araclar WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->bindParam(':id', $silinecekID, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    $aracMarka = $result['marka_model'];

    // Veritabanından müşteriyi sil
    $sqlDeleteCustomer = "DELETE FROM araclar WHERE id = ?";
    $stmtDeleteCustomer = $conn->prepare($sqlDeleteCustomer);
    $stmtDeleteCustomer->execute([$silinecekID]);

    // Olayı Raporla
    $rapor_aciklama  = $aracMarka . " Markalı araç silme isteği gönderildi.";
    $rapor_durum = "1";
    $rapor_tarih = date("Y-m-d");
    $rapor_saat = date("h:i:s");

    $sqlDurumRaporla = "INSERT INTO rapor (aciklama, durum, tarih, saat) VALUES (?,?,?,?)";
    $smtpDurumRaporla = $conn->prepare($sqlDurumRaporla);
    $smtpDurumRaporla->execute([$rapor_aciklama, $rapor_durum, $rapor_tarih, $rapor_saat]);

    // URL'den GET parametrelerini silmek için
    header("Location: ./../araclar.php");
}

// Not Ekler ve Raporlar
if(isset($_POST['not_ekle'])) {
    $musteriAdi = $_POST['musteri_adi'];
    $notAciklama = $_POST['notAciklama'];
    $hatirlatmaTarihi = $_POST['hatirlatmaTarihi'];
    $kayit_tarihi = date("Y-m-d");

    // Veritabanına müşteri ekle
    $sqlInsertNots = "INSERT INTO notlar (adiniz_soyadiniz, aciklama, hatirlatma, kayit) VALUES (?, ?, ?, ?)";
    $stmtInsertNots = $conn->prepare($sqlInsertNots);
    $stmtInsertNots->execute([$musteriAdi, $notAciklama, $hatirlatmaTarihi, $kayit_tarihi]);

    // Olayı Raporla
    $rapor_aciklama  = $musteriAdi . " adlı müşterisinin not ekleme isteği gönderildi.";
    $rapor_durum = "1";
    $rapor_tarih = date("Y-m-d");
    $rapor_saat = date("h:i:s");

    $sqlDurumRaporla = "INSERT INTO rapor (aciklama, durum, tarih, saat) VALUES (?,?,?,?)";
    $smtpDurumRaporla = $conn->prepare($sqlDurumRaporla);
    $smtpDurumRaporla->execute([$rapor_aciklama, $rapor_durum, $rapor_tarih, $rapor_saat]);

    header("Location: ./../cagrilar.php");
}

// Kayıtlı Notu Siler ve Raporlar
if(isset($_POST['notSil'])) {
    $silinecekNot = $_POST['notSil'];

    $query = "SELECT adiniz_soyadiniz FROM notlar WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->bindParam(':id', $silinecekNot, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    $musteri_adi = $result['adiniz_soyadiniz'];

    $sqlDeleteNots  = "DELETE FROM notlar WHERE id = ?";
    $smtpDeleteNots = $conn->prepare($sqlDeleteNots);
    $smtpDeleteNots->execute([$silinecekNot]);

    // Olayı Raporla
    $rapor_aciklama  = $musteri_adi . " adlı kişinin notu silme gönderildi.";
    $rapor_durum = "1";
    $rapor_tarih = date("Y-m-d");
    $rapor_saat = date("h:i:s");

    $sqlDurumRaporla = "INSERT INTO rapor (aciklama, durum, tarih, saat) VALUES (?,?,?,?)";
    $smtpDurumRaporla = $conn->prepare($sqlDurumRaporla);
    $smtpDurumRaporla->execute([$rapor_aciklama, $rapor_durum, $rapor_tarih, $rapor_saat]);

    header("Location: ./../cagrilar.php");
}

// Gider Ekler ve Raporlar
if(isset($_POST['giderEkle'])) {
    $tur = "Gider";
    $miktar = $_POST['miktar'];
    $aciklama = $_POST['aciklama'];
    $kayittarih = date('Y-m-d H:i');

    /* Veri Tabanına yükle */
    $sqlInsertGider = "INSERT INTO kasa (tur, aciklama, miktar, tarih) VALUES (?,?,?,?)";
    $smtpInsertGider = $conn->prepare($sqlInsertGider);
    $smtpInsertGider->execute([$tur, $aciklama, $miktar, $kayittarih]);

    // Olayı Raporla
    $rapor_aciklama  = $aciklama . " adlı gider ekleme isteği gönderildi.";
    $rapor_durum = "1";
    $rapor_tarih = date("Y-m-d");
    $rapor_saat = date("h:i:s");
    $sqlDurumRaporla = "INSERT INTO rapor (aciklama, durum, tarih, saat) VALUES (?,?,?,?)";
    $smtpDurumRaporla = $conn->prepare($sqlDurumRaporla);
    $smtpDurumRaporla->execute([$rapor_aciklama, $rapor_durum, $rapor_tarih, $rapor_saat]);

    header("Location: ./../kasa.php");
}

// Kayıtlı Gideri Siler ve Raporlar
if(isset($_POST['giderSil'])) {
    $silinecekGider = $_POST['giderSil'];

    $query = "SELECT aciklama FROM kasa WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->bindParam(':id', $silinecekGider, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    $musteri_adi = $result['aciklama'];

    $sqlDeleteGider = "DELETE FROM kasa WHERE id = ?";
    $smtpDeleteGider = $conn->prepare($sqlDeleteGider);
    $smtpDeleteGider->execute([$silinecekGider]);

    // Olayı Raporla
    $rapor_aciklama  = $musteri_adi . " adlı gideri silme gönderildi.";
    $rapor_durum = "1";
    $rapor_tarih = date("Y-m-d");
    $rapor_saat = date("h:i:s");

    $sqlDurumRaporla = "INSERT INTO rapor (aciklama, durum, tarih, saat) VALUES (?,?,?,?)";
    $smtpDurumRaporla = $conn->prepare($sqlDurumRaporla);
    $smtpDurumRaporla->execute([$rapor_aciklama, $rapor_durum, $rapor_tarih, $rapor_saat]);

    header("Location: ./../kasa.php");
}

// Gelir Ekler ve Raporlar
if(isset($_POST['gelirEkle'])) {
    $tur = "Gelir";
    $miktar = $_POST['miktar'];
    $aciklama = $_POST['aciklama'];
    $kayittarih = date('Y-m-d H:i');

    /* Veri Tabanına yükle */
    $sqlInsertGelir = "INSERT INTO kasa (tur, aciklama, miktar, tarih) VALUES (?,?,?,?)";
    $smtpInsertGelir = $conn->prepare($sqlInsertGelir);
    $smtpInsertGelir->execute([$tur, $aciklama, $miktar, $kayittarih]);

    // Olayı Raporla
    $rapor_aciklama  = $aciklama . " adlı not ekleme isteği gönderildi.";
    $rapor_durum = "1";
    $rapor_tarih = date("Y-m-d");
    $rapor_saat = date("h:i:s");
    $sqlDurumRaporla = "INSERT INTO rapor (aciklama, durum, tarih, saat) VALUES (?,?,?,?)";
    $smtpDurumRaporla = $conn->prepare($sqlDurumRaporla);
    $smtpDurumRaporla->execute([$rapor_aciklama, $rapor_durum, $rapor_tarih, $rapor_saat]);

    header("Location: ./../kasa.php");
}

// Kayıtlı Geliri Siler ve Raporlar
if(isset($_POST['gelirSil'])) {
    $silinecekGelir = $_POST['gelirSil'];

    $query = "SELECT aciklama FROM kasa WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->bindParam(':id', $silinecekGelir, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    $musteri_adi = $result['aciklama'];

    // Sonucu al ve işle
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    $sqlDeleteGelir = "DELETE FROM kasa WHERE id = ?";
    $smtpDeleteGelir = $conn->prepare($sqlDeleteGelir);
    $smtpDeleteGelir->execute([$silinecekGelir]);

    // Olayı Raporla
    $rapor_aciklama  = $musteri_adi . " gelir kaydı silme isteği gönderildi.";
    $rapor_durum = "1";
    $rapor_tarih = date("Y-m-d");
    $rapor_saat = date("h:i:s");

    $sqlDurumRaporla = "INSERT INTO rapor (aciklama, durum, tarih, saat) VALUES (?,?,?,?)";
    $smtpDurumRaporla = $conn->prepare($sqlDurumRaporla);
    $smtpDurumRaporla->execute([$rapor_aciklama, $rapor_durum, $rapor_tarih, $rapor_saat]);

    header("Location: ./../kasa.php");
}

// Yollanan Araçlar Tablosuna Kayıt ekler
if(isset($_POST['yollananAracEkle'])) {
    $musteri_adi = $_POST['musteriAdi'];
    $musteriTel = $_POST['musteriTel'];
    $musteriAdress = $_POST['musteriAdress'];
    $SiradakiArac = $_POST['SiradakiArac'];
    $GidisYeri = $_POST['GidisYeri'];

    /* Veri Tabanına yükle */
    $sqlInsertGelir = "INSERT INTO arac_yolla (musteri_adi, musteri_tel, musteri_adress, arac, gidis_yeri) VALUES (?,?,?,?,?)";
    $smtpInsertGelir = $conn->prepare($sqlInsertGelir);
    $smtpInsertGelir->execute([$musteri_adi, $musteriTel, $musteriAdress, $SiradakiArac, $GidisYeri]);

    // Olayı Raporla
    $rapor_aciklama  = $SiradakiArac . " adlı araç gönderildi.";
    $rapor_durum = "1";
    $rapor_tarih = date("Y-m-d");
    $rapor_saat = date("h:i:s");
    $sqlDurumRaporla = "INSERT INTO rapor (aciklama, durum, tarih, saat) VALUES (?,?,?,?)";
    $smtpDurumRaporla = $conn->prepare($sqlDurumRaporla);
    $smtpDurumRaporla->execute([$rapor_aciklama, $rapor_durum, $rapor_tarih, $rapor_saat]);

    header("Location: ./../");
}

// Kayıtlı Yollanan Aracı Siler
if(isset($_POST['yollanan_arac_id'])) {
    $yollananAracId = $_POST['yollanan_arac_id'];

    $query = "SELECT gidis_yeri FROM arac_yolla WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->bindParam(':id', $yollananAracId, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    $musteri_adi = $result['gidis_yeri'];

    // Sonucu al ve işle
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    $sqlYollananArac = "DELETE FROM arac_yolla WHERE id = ?";
    $smtpYollananArac = $conn->prepare($sqlYollananArac);
    $smtpYollananArac->execute([$yollananAracId]);

    // Olayı Raporla
    $rapor_aciklama  = $musteri_adi . " adlı yere giden sefer silndi.";
    $rapor_durum = "1";
    $rapor_tarih = date("Y-m-d");
    $rapor_saat = date("h:i:s");

    $sqlDurumRaporla = "INSERT INTO rapor (aciklama, durum, tarih, saat) VALUES (?,?,?,?)";
    $smtpDurumRaporla = $conn->prepare($sqlDurumRaporla);
    $smtpDurumRaporla->execute([$rapor_aciklama, $rapor_durum, $rapor_tarih, $rapor_saat]);

    header("Location: ./../");
}

/* VERİTABANI YEDEKLEME VE TABLO SIFIRLAMA İŞLEMLERİ */

// Veritabanını Yedekler ve ./backup klasörüne yükler.
if (isset($_POST['backup'])) {
    // Veritabanı bağlantı bilgileri
    $host = $servername;
    $dbname = $dbname;
    $username = $username;
    $password = $password;

    // PDO bağlantısı oluştur
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Olayı Raporla
        $rapor_aciklama  = "Yedek Alırken Veri Tabanına Bağlanılamadı!";
        $rapor_durum = "0";
        $rapor_tarih = date("Y-m-d");
        $rapor_saat = date("h:i:s");

        $sqlDurumRaporla = "INSERT INTO rapor (aciklama, durum, tarih, saat) VALUES (?,?,?,?)";
        $smtpDurumRaporla = $conn->prepare($sqlDurumRaporla);
        $smtpDurumRaporla->execute([$rapor_aciklama, $rapor_durum, $rapor_tarih, $rapor_saat]);
    }

    // Yedek dosya adı ve yolu
    $backupFileName = 'veritabani_yedek_' . date('Y-m-d_H-i-s') . '.sql';
    $backupFilePath = __DIR__ . '/../backup/' . $backupFileName;

    // MySQL Dump komutu
    $mysqlDumpCommand = "mysqldump --host=$host --user=$username --password=$password --databases $dbname > $backupFilePath";

    // MySQL Dump komutunu çalıştır
    exec($mysqlDumpCommand);

    // Dosyayı kullanıcıya indirme
    if (file_exists($backupFilePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($backupFilePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($backupFilePath));
        readfile($backupFilePath);

        // Olayı Raporla
        $rapor_aciklama  = "Veritabanı yedekleme isteği gönderildi.";
        $rapor_durum = "1";
        $rapor_tarih = date("Y-m-d");
        $rapor_saat = date("h:i:s");

        $sqlDurumRaporla = "INSERT INTO rapor (aciklama, durum, tarih, saat) VALUES (?,?,?,?)";
        $smtpDurumRaporla = $conn->prepare($sqlDurumRaporla);
        $smtpDurumRaporla->execute([$rapor_aciklama, $rapor_durum, $rapor_tarih, $rapor_saat]);

        header("Location: ./../yedek_bakim.php?status=004");
    } else {
        // Olayı Raporla
        $rapor_aciklama  = "Yedekleme isteği gönderildi.";
        $rapor_durum = "0";
        $rapor_tarih = date("Y-m-d");
        $rapor_saat = date("h:i:s");

        $sqlDurumRaporla = "INSERT INTO rapor (aciklama, durum, tarih, saat) VALUES (?,?,?,?)";
        $smtpDurumRaporla = $conn->prepare($sqlDurumRaporla);
        $smtpDurumRaporla->execute([$rapor_aciklama, $rapor_durum, $rapor_tarih, $rapor_saat]);
    }

}

/* Notlar Tablosunu Temizler(SİLMEZ) */
if(isset($_POST['notTemizleme'])) {
    $sqlDeleteNotsTable = "DELETE FROM notlar";
    $conn->exec($sqlDeleteNotsTable);

    // Olayı Raporla
    $rapor_aciklama  = "Notlar Tablosu Temizlendi.";
    $rapor_durum = "1";
    $rapor_tarih = date("Y-m-d");
    $rapor_saat = date("h:i:s");

    $sqlDurumRaporla = "INSERT INTO rapor (aciklama, durum, tarih, saat) VALUES (?,?,?,?)";
    $smtpDurumRaporla = $conn->prepare($sqlDurumRaporla);
    $smtpDurumRaporla->execute([$rapor_aciklama, $rapor_durum, $rapor_tarih, $rapor_saat]);

    header("Location: ./../yedek_bakim.php?status=001");
}

/* Araçlar Tablosunu Temizler(SİLMEZ) */
if(isset($_POST['aracTemizleme'])) {
    $sqlDeleteNotsTable = "DELETE FROM araclar";
    $conn->exec($sqlDeleteNotsTable);

    // Olayı Raporla
    $rapor_aciklama  = "Araçlar Tablosu Temzilendi.";
    $rapor_durum = "1";
    $rapor_tarih = date("Y-m-d");
    $rapor_saat = date("h:i:s");

    $sqlDurumRaporla = "INSERT INTO rapor (aciklama, durum, tarih, saat) VALUES (?,?,?,?)";
    $smtpDurumRaporla = $conn->prepare($sqlDurumRaporla);
    $smtpDurumRaporla->execute([$rapor_aciklama, $rapor_durum, $rapor_tarih, $rapor_saat]);

    header("Location: ./../yedek_bakim.php?status=003");
}


// Yollanan Araçlar Tablosunu Temizler(SİLMEZ)
if(isset($_POST['yollananAracıTemizle'])) {
    $sqlDeleteYollananArac = "DELETE FROM arac_yolla";
    $conn->exec($sqlDeleteYollananArac);

    // Olayı Raporla
    $rapor_aciklama  = "Yollanan Araçlar Tablosu Temzilendi.";
    $rapor_durum = "1";
    $rapor_tarih = date("Y-m-d");
    $rapor_saat = date("h:i:s");

    $sqlDurumRaporla = "INSERT INTO rapor (aciklama, durum, tarih, saat) VALUES (?,?,?,?)";
    $smtpDurumRaporla = $conn->prepare($sqlDurumRaporla);
    $smtpDurumRaporla->execute([$rapor_aciklama, $rapor_durum, $rapor_tarih, $rapor_saat]);

    header("Location: ./../yedek_bakim.php?status=002");
}

?>