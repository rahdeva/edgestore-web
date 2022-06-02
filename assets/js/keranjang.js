function addKeranjang(id){
    const keranjang = document.getElementById("containerKasir");
    console.log(id);

    var xhr2 = new XMLHttpRequest();
        
    // cek kesiapan ajax
    xhr2.onreadystatechange = function() {
        if( xhr2.readyState == 4 && xhr2.status == 200 ) {
            keranjang.innerHTML = xhr2.responseText;
        }
    }
        
    // eksekusi ajax
    xhr2.open('GET', 'ajax/tambahKeranjang.php?item=' + id, true);
    xhr2.send();
}