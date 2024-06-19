function musteriSelect(rowId) {
    // Belirli satırı seç
    var selectedRow = document.getElementById(rowId);

    // Satır içindeki "Adınız Soyadınız" hücresini bul
    var soyisimHucresi = selectedRow.cells[1];
    var telefonHucresi = selectedRow.cells[3];
    var AdressHucresi = selectedRow.cells[2];

    // Soyisim verisini al
    var soyisimVerisi = soyisimHucresi.textContent || soyisimHucresi.innerText;
    var telefonVerisi = telefonHucresi.textContent || telefonHucresi.innerText;
    var adressVerisi = AdressHucresi.textContent || AdressHucresi.innerText;

    document.getElementById('musteriAdi').value = soyisimVerisi;
    document.getElementById('musteriAdi').setAttribute("value", soyisimVerisi);
    document.getElementById('musteriTel').value = telefonVerisi;
    document.getElementById('musteriTel').setAttribute("value", telefonVerisi);
    document.getElementById('musteriAdress').value = adressVerisi;
    document.getElementById('musteriAdress').setAttribute("value", adressVerisi);
}

function aracSelect(rowId) {
    // Belirli satırı seç
    var selectedRow = document.getElementById(rowId);

    // Satır içindeki "Adınız Soyadınız" hücresini bul
    var aracHucresi = selectedRow.cells[0];

    // Soyisim verisini al
    var aracVerisi = aracHucresi.textContent || aracHucresi.innerText;

    document.getElementById('SiradakiArac').value = aracVerisi;
}

// JavaScript ile yazma işlemi engelleme
function engelle() {
    return false;
}