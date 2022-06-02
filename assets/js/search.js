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

const keranjang = document.getElementById("containerKasir");
const items = document.querySelectorAll(".tambah-item");

for(let i = 0; i < items.length; i++){
    items[i].addEventListener("click", function(){
        alert("Mau je");
        var xhr2 = new XMLHttpRequest();
    
        // cek kesiapan ajax
        xhr2.onreadystatechange = function() {
            if( xhr2.readyState == 4 && xhr2.status == 200 ) {
                keranjang.innerHTML = xhr2.responseText;
            }
        }
    
        // eksekusi ajax
        xhr2.open('GET', 'ajax/tambahKeranjang.php?keyword=' + items[i].parentElement.getAttribute("id"), true);
        xhr2.send();
    });
}