const keranjangList = [];

function addKeranjang(id, action){
    const keranjang = document.getElementById("containerKasir");

    if(action == 1){
        let flagFound = 0;

        for (let i = 0; i < keranjangList.length; i++){
            if(keranjangList[i] == id){
                flagFound = 1;
                return false;
            }
        }
        
        if(flagFound == 0){
            if(keranjangList[0] == 0)   
                keranjangList[0] = id
            else
                keranjangList.push(id);
        }
    }
    else{
        let index;
        for (let i = 0; i < keranjangList.length; i++){
            if(keranjangList[i] == id){
                index = i;
                console.log(index);
            }
        }
        if (keranjangList.length == 1){
            keranjangList.splice(index, 1);
            keranjangList.push(0);
        }
        else if(index > -1)
            keranjangList.splice(index, 1);
        resetTotalBayarKembalian();
    }

    // for (let i = 0; i < keranjangList.length; i++)
    //     console.log(keranjangList[i]);

    let allId = "";
    for (let i = 0; i < keranjangList.length; i++)
        allId = allId + keranjangList[i] + ",";
    
    console.log(allId);

    // console.log(keranjangList.length)
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