// ambil elemen2 yang dibutuhkan
var keyword = document.getElementById('keyword');
var container = document.getElementById('containerSearched');

// tambahkan event ketika keyword ditulis
keyword.addEventListener('keyup', function() {

    // buat object ajax
    var xhr = new XMLHttpRequest();

    // cek kesiapan ajax
    xhr.onreadystatechange = function() {
        if( xhr.readyState == 4 && xhr.status == 200 ) {
            container.innerHTML = xhr.responseText;
        }
    }

    // eksekusi ajax
    xhr.open('GET', 'ajax/barangSearch.php?keyword=' + keyword.value, true);
    xhr.send();

});