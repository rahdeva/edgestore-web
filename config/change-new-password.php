<?php
    session_start();

    if( isset($_SESSION["login"]) ) {
        header("Location: dashboard.php");
        exit;
    }

    require 'functions.php';

    $id = $_GET['id'];

    if(isset($_POST["change-password"])){
        alert("ganti", true, '../login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../header.php'; ?>
        <title>EdgeStore - Login</title>
    </head>
    <body class= " bg-indigo-400">
        <section class="mt-6">
            <div class=" items-center justify-center flex flex-col">
                <img src="../assets/images/logo.png" class="w-32 mb-2"/>
            </div>
            <div class="max-w-xl bg-green-300 h-16 mx-auto mt-3 shadow-2xl shadow-teal-300 opacity-75 rounded-2xl">
                <h1 class="text-4xl text-center font-bold pt-2">Edge-Store</h1>
            </div>
            <div class="bg-white mx-auto h-40 max-w-xl rounded-2xl shadow-lg shadow-white">
                <form action=""method="post">
                    <div class="p-8 pb-2  mt-8 w-full text-center"> 
                        <i class="fa fa-unlock-alt absolute text-primary text-xl"></i>
                        <input type="password" name="new-password" id="new-password" placeholder=" Masukan Password Baru" class=" rounded-sm focus:ring-purple-300 focus:border-purple-300 pl-8 border-b-2 focus:outline-none focus:border-primarycolor transition-all duration-500 invalid:text-red-500 required"  />    
                    </div>
                    <div class="w-full mt-4">
                        <button type="submit" name="change-password"class="block mx-auto hover:bg-blue-300 py-3 px-16 bg-violet-400 rounded-full text_whi text-white">Change Password</button>
                    </div>
                </form>    
            </div>
        </section>
        <!-- <img src="assets/images/wave.png" class="h-screen"> -->
    </body>
</html>