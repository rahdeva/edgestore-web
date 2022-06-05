window.addEventListener("load", highlightPage);

// HIGHLIGHT PAGE //

function getTitle(){
    let title = document.title
    const length = title.length;
    title = title.substring(12, length);
    title = title.toLowerCase();
    return title;
}

function highlightPage(){
    const navbar = document.querySelectorAll(".custom-nav");
    const title = getTitle();
    if(title == "dashboard")
        navbar[0].classList.add("underline", "text-teal-200");
    else if(title == "kasir")
        navbar[1].classList.add("underline", "text-teal-200");
    else if(title == "barang")
        navbar[2].classList.add("underline", "text-teal-200");
    else if(title == "kategori")
        navbar[3].classList.add("underline", "text-teal-200"); 
    else if(title == "transaksi")
        navbar[4].classList.add("underline", "text-teal-200"); 
    else if(title == "profile")
        navbar[5].classList.add("underline", "text-teal-200");
}

// HIGHLIGHT PAGE //

// KASIR PAGE //

function changeTotal(id, price){
    const selected = document.getElementById(id);
    let totalId = "total" + id;
    const totalDiv = document.getElementById(totalId);
    let total = selected.value * price;
    totalDiv.innerHTML = total;
    sumAllTotal();
}

function sumAllTotal(){
    const allTotal = document.getElementsByClassName("total-per-barang");
    let temp, result = 0;
    for(let i = 0; i < allTotal.length; i++){
        temp = parseInt(allTotal[i].innerHTML);
        // alert(allTotal[i].innerHTML);
        result = result + temp;
    }
    document.getElementById("total-belanja").value = result;
    hitungKembalian();
    // alert(result);
}

function hitungKembalian(){
    const nominalBayar = document.getElementById("bayar").value;
    const totalBelanja = document.getElementById("total-belanja").value;
    const kembalianDiv = document.getElementById("kembali");
    
    let result;
    result = nominalBayar - totalBelanja;
    // alert(result);
    if(result < 0)
        kembalianDiv.classList.add("uang-kurang");
    else if(result >= 0)
        kembalianDiv.classList.remove("uang-kurang");
    kembalianDiv.value = result;

    if(result < 0)
        enableDisableBayarButton(1);
    else if(totalBelanja == 0)
        enableDisableBayarButton(1);
    else
        enableDisableBayarButton(2);
}

function resetTotalBayarKembalian(){
    document.getElementById("bayar").value = 0;
    document.getElementById("total-belanja").value = 0;
    document.getElementById("kembali").value = 0;
    document.getElementById("kembali").classList.remove("uang-kurang");
    hitungKembalian();
}

function enableDisableBayarButton(flag){
    const bayarButton = document.getElementById("submit-pembayaran");
    if(flag == 1)
        bayarButton.classList.add("hidden");
    else
        bayarButton.classList.remove("hidden");
}