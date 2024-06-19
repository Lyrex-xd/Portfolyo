<?php

session_start(); // Oturumu başlat

$servername = "localhost"; // MySQL sunucu adı
$username = "root"; // MySQL kullanıcı adı
$password = ""; // MySQL şifre
$dbname = "taksidurak"; // Kullanılacak veritabanı adı

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // PDO nesnesi oluşturuldu

    // Veritabanına bağlantı ayarlarını belirle
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Veritabanı oluştur
    $sqlCreateDB = "CREATE DATABASE IF NOT EXISTS $dbname";
    $conn->exec($sqlCreateDB);

    // Veritabanına tekrar bağlan
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Araçlar tablosunu oluştur
    $sqlCreateAracTable = "CREATE TABLE IF NOT EXISTS araclar (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        adiniz_soyadiniz VARCHAR(70),
        tel_1 VARCHAR(10),
        tel_2 VARCHAR(10),
        plaka VARCHAR(11),
        marka_model VARCHAR(99)
    )";
    $conn->exec($sqlCreateAracTable);

    // Çağrılar tablosunu oluştur
    $sqlCreateCagriTable = "CREATE TABLE IF NOT EXISTS cagrilalar (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        konu VARCHAR(100),
        tarih DATE,
        aciklama TEXT
    )";
    $conn->exec($sqlCreateCagriTable);

    // Müşteriler tablosunu oluştur
    $sqlCreateMusteriTable = "CREATE TABLE IF NOT EXISTS musteriler (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        adiniz_soyadiniz VARCHAR(70),
        tel_1 VARCHAR(10),
        tel_2 VARCHAR(10),
        adress VARCHAR(1000),
        aciklama VARCHAR(1000),
        yollanan_arac VARCHAR(10),
        gidis_yeri VARCHAR(50),
        gidis_saat TIME
    )";
    $conn->exec($sqlCreateMusteriTable);
    
    // Notlar/Çağrılar tablosunu oluştur
    $sqlCreateNotsTable = "CREATE TABLE IF NOT EXISTS notlar (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        adiniz_soyadiniz VARCHAR(70),
        aciklama VARCHAR(1000),
        hatirlatma DATE,
        kayit DATE
    )";
    $conn->exec($sqlCreateNotsTable);

    // istatistikler tablsunu oluştur
    $sqlCreateKasaTable = "CREATE TABLE IF NOT EXISTS kasa (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        tur VARCHAR(20),
        aciklama VARCHAR(250),
        miktar DECIMAL(10,2),
        tarih DATE
        )";
    $conn->exec($sqlCreateKasaTable);

    /* Rapor Tablosunu Oluştur */
    $sqlCreateLogTable = "CREATE TABLE IF NOT EXISTS rapor(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        aciklama VARCHAR(250),
        durum BOOLEAN,
        tarih DATE,
        saat TIME
        )";
    $conn->exec($sqlCreateLogTable);

    /* Araç Yolla Tablosunu Oluşturur */
    $sqlCreateAracYollaTable = "CREATE TABLE IF NOT EXISTS arac_yolla (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        musteri_adi VARCHAR(70),
        musteri_tel VARCHAR(10),
        musteri_adress VARCHAR(1000),
        arac VARCHAR(99),
        gidis_yeri VARCHAR(150)
    )";

    $conn->exec($sqlCreateAracYollaTable);
    
    /* kullanicilar Tablosunu Oluşturur */
    $sqlCreatekullanicilar = "CREATE TABLE IF NOT EXISTS kullanicilar (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        kullanici_adi VARCHAR(70),
        mail VARCHAR(150),
        sifre VARCHAR(1000)
    )";

    $conn->exec($sqlCreatekullanicilar);

} catch (PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}
?>
