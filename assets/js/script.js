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