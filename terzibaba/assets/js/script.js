function yonlendir(url) {
    // Yönlendirme işlemi
    window.location.href = url;
}

// JavaScript ile sayı ve maksimum karakter kontrolü
document.getElementById('tel').addEventListener('input', function () {
    var inputValue = this.value;

    // Sadece sayısal değerlere izin ver
    this.value = inputValue.replace(/[^0-9]/g, '');

    // Maksimum 10 karakter kontrolü
    if (this.value.length > 10) {
    this.value = this.value.slice(0, 10);
    }
});

function musteriSelect(rowId) {

    var selectedRow = document.getElementById(rowId);

    var idHucresi = selectedRow.cells[0];
    var isimHucresi = selectedRow.cells[1];

    var idVerisi = idHucresi.textContent || idHucresi.innerText;
    var idBosluksuzVeri = idVerisi.trim();
    var isimVerisi = isimHucresi.textContent || isimHucresi.innerText;

    document.getElementById('secilensilme').innerHTML = isimVerisi;
    document.getElementById('duzenlencekMusteri').value = idBosluksuzVeri;
    document.getElementById('silinecekMusteri').value = idBosluksuzVeri;
}

function olcuSelectFunc(rowId) {

    var selectedRow = document.getElementById(rowId);

    var idHucresi = selectedRow.cells[0];
    var isimHucresi = selectedRow.cells[1];

    var idVerisi = idHucresi.textContent || idHucresi.innerText;
    var idBosluksuzVeri = idVerisi.trim();
    var isimVerisi = isimHucresi.textContent || isimHucresi.innerText;

    document.getElementById('secilenOlcu').innerHTML = isimVerisi;
    document.getElementById('olcuDuzenle').value = idBosluksuzVeri;
    document.getElementById('silinecekOlcu').value = idBosluksuzVeri;
}

function refreshPageWithPostData() {
    // Formu gönder
    document.getElementById("musteriForm").submit();
    
    // Sayfayı temizle ve yenile
    history.replaceState({}, document.title, window.location.pathname);
    location.reload();
}