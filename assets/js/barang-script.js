// FOR barang.php //

let modal = document.getElementById("modalInsert");
let btn = document.getElementById("insertBtn");
let closeModal = document.getElementsByClassName("closeModal")[0];
// let modal2 = document.getElementById("modalEdit");
// let btn2 = document.getElementById("editBtn");
// let closeModal2 = document.getElementsByClassName("closeModal2")[0];

btn.onclick = function() {
    modal.style.display = "block";
}

closeModal.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    // if (event.target == modal2) {
    //     modal2.style.display = "none";
    // }
}

// closeModal2.onclick = function() {
//     modal2.style.display = "none";
// }

// FOR barang.php //