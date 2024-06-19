<?php
session_start();

$root = __DIR__;
$dosyaYolu = str_replace("\\", "/", $root);

$servername = "localhost"; // MySQL sunucu adı
$username = "root"; // MySQL kullanıcı adı
$password = ""; // MySQL şifre
$dbname = "terzibaba"; // Kullanılacak veritabanı adı

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

    // Muşteriler tablosunu oluştur
    $sqlCreateCustomerTable = "CREATE TABLE IF NOT EXISTS musteriler (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        adiniz_soyadiniz VARCHAR(70),
        tel VARCHAR(10),
        adress VARCHAR(250),
        aciklama VARCHAR(250)
    )";
    $conn->exec($sqlCreateCustomerTable);
    
    // Ölçüler tablosunu oluştur
    $sqlCreateMeasurementTable = "CREATE TABLE IF NOT EXISTS olculer (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        olcu_adi VARCHAR(70),
        aciklama VARCHAR(250),
        tarih DATE,
        fiyat DECIMAL(10,2),
        odenen DECIMAL(10,2),
        kalan DECIMAL(10,2),
        hirka_boyu1 DECIMAL(10,2),
        hirka_boyu2 DECIMAL(10,2),
        hirka_genisligi1 DECIMAL(10,2),
        hirka_genisligi2 DECIMAL(10,2),
        hirka_genisligi3 DECIMAL(10,2),
        kol_boyu DECIMAL(10,2),
        yaka1 DECIMAL(10,2),
        yaka2 DECIMAL(10,2),
        yaka3 DECIMAL(10,2),
        yelek_boyu DECIMAL(10,2),
        yelek_genisligi1 DECIMAL(10,2),
        yelek_genisligi2 DECIMAL(10,2),
        yelek_genisligi3 DECIMAL(10,2),
        etek_boyu DECIMAL(10,2),
        etek_genisligi1 DECIMAL(10,2),
        etek_genisligi2 DECIMAL(10,2),
        etek_genisligi3 DECIMAL(10,2),
        pantolon_boyu DECIMAL(10,2),
        pantolon_genisligi1 DECIMAL(10,2),
        pantolon_genisligi2 DECIMAL(10,2),
        pantolon_genisligi3 DECIMAL(10,2)
    )";
    
    $conn->exec($sqlCreateMeasurementTable);
    
    // kullanicilar tablosunu oluştur
    $sqlCreateMeasurementTable = "CREATE TABLE IF NOT EXISTS kullancilar (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        kullanici_adi VARCHAR(30),
        sifre VARCHAR(30),
        e_posta VARCHAR(150)
    )";
    
    $conn->exec($sqlCreateMeasurementTable);

} catch (PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}
?>
