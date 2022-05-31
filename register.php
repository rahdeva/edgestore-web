<?php
require 'registerfunction.php';

if(isset($_POST["submit"])) {
    if(regis($_POST) >0){
        echo"<script>
        alert('user baru berhasil ditambahkan');
        </script>";
    }else{
        echo mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.php'; ?>
    <title>EdgeStore - Register</title>
</head>
<body class="bg-indigo-300">
    <div class="bg-white w-screen px-5 py-5 items-center justify-center flex flex-col">
        <img src="assets/images/profil.svg" class="w-32 "/>
        <h2 class=" my-2 font-bold text-2xl">LENGKAPI BIODATA ANDA</h2>
    </div>
    <div class="pr-10 w-screen pt-10 flex flex-col justify-center items-center lg:grid lg:grid-cols-2">
        <img src="assets/images/unlock.svg" class="hidden lg:block w-min mx-auto mr-10"/>
        <div class="max-w-lg border-slate-200 rounded-xl shadow-2xl shadow-blue-500 font-inter p-5 bg-white">
            <form action="" method="post">
                <label for="nama">
                    <span class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-1">Nama Depan</span>
                    <input type="text" required  name="nama_depan" placeholder="masukkan nama..." class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500"/>   
                </label>
                <label for="nama">
                    <span class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-1 mt-3">Nama Belakang</span>
                    <input type="text"required name="nama_belakang"placeholder="masukkan nama..." class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 "/>   
                </label>
                <label for="asal">
                    <span class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-1 mt-3">Asal</span>
                    <input type="text" required name="asal" placeholder="masukan asal..."class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 "/>   
                </label>
                <label for="date">
                    <span class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-1 mt-3">Tanggal Lahir</span>
                    <input type="date" required name="tanggal_lahir" placeholder="kota asal..." class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 "/>   
                </label>
                <label for="telepon">
                    <span class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-1 mt-3">Telepon</span>
                    <input type="tel" required id="phone" name="telepon" placeholder="masukkan telepon..." class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 "/>   
                </label>
                <label for="email">
                    <span class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-1 mt-3">Email</span>
                    <input type="email"  required name="email"placeholder="masukkan email..." class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 invalid:text-pink-700 invalid:focus:ring-pink-700 peer "/>
                    <p class="text-sm m-1 text-pink-700 invisible peer-invalid:visible">Email tidak valid</p>
                </label>
                <label for="username">
                    <span class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-1">Username</span>
                    <input type="text" required name="username" placeholder="masukkan username..." class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 "/>   
                </label>
                <label for="password">
                    <span class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-pink-500 after:ml-1 mt-3">Password</span>
                    <input type="password" required name="pass"id="pwd" placeholder="masukkan password..." class="px-3 py-2 border shadow rounded w-full block text-sm placeholder:text-slate-400 focus:outline-none focus:ring-1 focus:ring-sky-500 "/>   
                </label>
                <button type="submit" name="submit" class=" hover:bg-blue-300 bg-fuchsia-600 px-5 py-4 rounded-full text-white font-semibold block mx-auto mt-10">
                 <a href="login.php" >Simpan Data</a> 
                </button>
            </form>
            
        </div>
    </div>
</body>
</html>