<?php
    session_start();

    if( isset($_SESSION["login"]) ) {
        header("Location: dashboard.php");
        exit;
    }

    require 'config/functions.php';

    if(isset($_POST["login"])){
        $username = $_POST['username'];
        $pass = $_POST['pass'];

        $query_user = "SELECT * FROM tb_user WHERE username = '$username'";
        $result = mysqli_query($connect, $query_user);

        //cek username
        if(mysqli_num_rows($result) === 1){
            //cek password
            $row = mysqli_fetch_assoc($result);
            if($pass == $row['password']){
                $_SESSION["login"] = true;
                $_SESSION["username"] = $username;
                header("Location: dashboard.php");
                exit;
            }
        }
        else
            echo("username/password salah");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'header.php'; ?>
        <title>EdgeStore - Login</title>
    </head>
    <body class= " bg-indigo-400">
        <section class="mt-24">
            <div class=" items-center justify-center flex flex-col">
                <img src="assets/images/profil.svg" class="w-32 "/>
                <h2 class=" my-2 font-bold text-1xl">Welcome to Edge Store</h2>
            </div>
            <div class="max-w-xl bg-green-300 h-16 mx-auto mt-3 shadow-2xl shadow-teal-300 opacity-75 rounded-2xl">
                <h1 class="text-4xl text-center font-bold pt-2">Edge-Store</h1>
            </div>
            <div class="bg-white mx-auto h-64 max-w-xl rounded-2xl">
                <form action=""method="post">
                    <div class="p-8 pb-2  mt-8 w-full text-center"> 
                        <i class="fa fa-user absolute text-primary text-xl"></i>
                        <input type="text" name="username" id="username" placeholder=" Masukan username" class=" rounded-sm focus:ring-purple-300 focus:border-purple-300 pl-8 border-b-2 focus:outline-none focus:border-primarycolor transition-all duration-500 invalid:text-red-500 required"  />    
                    </div>
                    <div class=" mt-2 w-full text-center ">
                        <i class="fa fa-lock absolute text-primary text-xl"></i>
                        <input type="text" name="pass" id="pass"placeholder=" Password" class="rounded-sm focus:ring-purple-300 focus:border-purple-300 pl-8 border-b-2  focus:outline-none focus:border-primarycolor transition-all duration-500 required" />         
                    </div>
                    <div class="w-full">
                        <button type="submit" name="login"class="block mx-auto mt-8 hover:bg-blue-300 py-3 px-16 bg-violet-400 rounded-full text_whi text-white">Login</button>
                    </div>
                    <button class="mt-6 block mx-auto">
                        <a href="register.php" class=" hover:bg-blue-300 py-3 px-14 bg-rose-400 rounded-full text_whi text-white">Register</a>
                    </button>
                </form>    
            </div>
        </section>
        <!-- <img src="assets/images/wave.png" class="h-screen"> -->
    </body>
</html>