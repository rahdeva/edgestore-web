window.addEventListener('load', randomHello);

function randomHello(){
    const helloInManyLanguages = ["Halo", "Hello", "Bonjour", "Ciao", "Olá", "안녕하십니까", "Konichiwa", "مرحبًا", "Salom", "שלום", "Aloha", "Hi", "नमस्ते", "你好", "Halló", "ನಮಸ್ಕಾರ", "Hei", "Haai", "สวัสดี", "Chao", "Hej", "Buon Giorno", "Привет", "Buna ziua", "Здраво", "ជំរាបសួរ", "Салам", "Ahoj", "Hola", "Salve", "Hallå", "Kamusta", "Merhaba", "ہیلو", "Szia", "Xin chào", "Helo", "سلام", "Dia dhuit", "Witam", "Χαίρετε", ""];

    const randomHello = helloInManyLanguages[Math.floor(Math.random() * helloInManyLanguages.length)];
    const helloDiv = document.getElementById("hello");
    helloDiv.innerText = randomHello;
}