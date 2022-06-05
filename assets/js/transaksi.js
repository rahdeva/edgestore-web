// const bayar = document.getElementById('submit-pembayaran');

function addTransaksi(total, id_each_item){
    // console.log(total);
    // console.log(id_each_item);

    let jumlahPerBarang = document.querySelectorAll(".jumlah-per-barang");
    let totalPerBarang = document.querySelectorAll(".total-per-barang");
    let jumlahBarangString = "";
    let totalBarangString = "";
    
    let intTotal = parseInt(total);
    for(let i = 0; i < intTotal; i++){
        jumlahBarangString = jumlahBarangString + `${jumlahPerBarang[i].value}` + ",";
        totalBarangString = totalBarangString + `${totalPerBarang[i].innerHTML}` + ",";
    }
    // console.log(jumlahBarangString);
    // console.log(totalBarangString);
    // console.log(total);
    // console.log(id_each_item);
    
    const coba = document.getElementById("coba");
    let xhr3 = new XMLHttpRequest();

    // cek kesiapan ajax
    xhr3.onreadystatechange = function() {
        if( xhr3.readyState == 4 && xhr3.status == 200 ) {
            coba.innerHTML = xhr3.responseText;
        }
    }

    // eksekusi ajax
    xhr3.open('GET', 'ajax/pembayaran.php?jumlahPerBarang=' + jumlahBarangString + '&totalPerBarang=' + totalBarangString + '&totalBelanja=' + total + '&idEachItem=' + id_each_item, true);
    xhr3.send();
}


// keyword.addEventListener('keyup', function() {

//     // buat object ajax
//     let xhr3 = new XMLHttpRequest();

//     // cek kesiapan ajax
//     xhr3.onreadystatechange = function() {
//         if( xhr3.readyState == 4 && xhr3.status == 200 ) {
//             container.innerHTML = xhr3.responseText;
//         }
//     }

//     // eksekusi ajax
//     xhr3.open('GET', 'ajax/barangSearch.php?keyword=' + keyword.value, true);
//     xhr3.send();

// });