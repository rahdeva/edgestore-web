window.addEventListener("load", highlightPage());
window.addEventListener('load', getDate);
window.addEventListener('load', createCalendar);

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


// CALENDAR //

const now = new Date();

function getDate(){
    const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    let year = now.getFullYear();
    let month = months[now.getMonth()];

    document.getElementById("printed-date").innerHTML = month + " " + year;
}

function createCalendar(){
    const dateColumn = document.getElementById("dates-column");

    let firstDayNumber = firstDayInMonth();
    let daysInMonth = findDaysInMonth();
    let daysInMonthCounter = 1;
    let date = now.getDate();
    let textDiv;
    let blankTextDiv = document.createTextNode(" ");
    let totalBox;

    if(firstDayNumber >= 5 && daysInMonth >= 30)
        totalBox = 41;
    else
        totalBox = 34;
    
    for(let i = 0; i <= totalBox; i++){
        const createDiv = document.createElement("div");
        createDiv.className = "column";
        if(i > firstDayNumber - 1 && i < daysInMonth + firstDayNumber){
            textDiv = document.createTextNode(daysInMonthCounter);
            createDiv.appendChild(textDiv);
            dateColumn.appendChild(createDiv);
            if(daysInMonthCounter == date)
                createDiv.classList.add("today");
            daysInMonthCounter++;
        }
        else{
            createDiv.appendChild(blankTextDiv);
            dateColumn.appendChild(createDiv);
        }
    }
}

function firstDayInMonth(){

    // Mengambil value dari hari pertama dalam sebuah bulan dan langsung mengubahnya ke dalam bentuk string 
    let firstDay = String(new Date(now.getFullYear(), now.getMonth(), 1));

    // Mengambil karakter dari indeks ke 0 sampai indeks ke 2
    firstDay = firstDay.substring(0, 3);

    // Mengembalikan nilai berupa angka yang sesuai dengan nama hari pertama dalam bulan tertentu
    // Nilai tadi adalah indeks yang sesuai dengan array berikut
    // ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"]
    if(firstDay == "Mon")
        return 0;
    else if(firstDay == "Tue")
        return 1;
    else if(firstDay == "Wed")
        return 2;
    else if(firstDay == "Thu")
        return 3;
    else if(firstDay == "Fri")
        return 4;
    else if(firstDay == "Sat")
        return 5;
    else if(firstDay == "Sun")
        return 6;
}

function findDaysInMonth(){
    let year = now.getFullYear();
    let month = now.getMonth();
    let daysInMonth = new Date(year, month + 1, 0).getDate();
    return daysInMonth;
}

// CALENDAR //