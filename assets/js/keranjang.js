const keranjangList = [];

function addKeranjang(id){
    const keranjang = document.getElementById("containerKasir");

    let flagFound = 0;

    for (let i = 0; i < keranjangList.length; i++){
        if(keranjangList[i] == id)
            flagFound = 1;
    }

    if(flagFound == 0)
        keranjangList.push(id);

    for (let i = 0; i < keranjangList.length; i++)
        console.log(keranjangList[i]);

    let allId = " ";
    for (let i = 0; i < keranjangList.length; i++)
        allId = allId + keranjangList[i] + ",";
    
    console.log(allId);

    console.log(keranjangList.length)
    var xhr2 = new XMLHttpRequest();
        
    // cek kesiapan ajax
    xhr2.onreadystatechange = function() {
        if( xhr2.readyState == 4 && xhr2.status == 200 ) {
            keranjang.innerHTML = xhr2.responseText;
        }
    }
        
    // eksekusi ajax
    xhr2.open('GET', 'ajax/tambahKeranjang.php?items=' + allId + '&length=' + keranjangList.length, true);
    xhr2.send();
}