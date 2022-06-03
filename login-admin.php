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
                $_SESSION["password"] = $row['password'];
                $_SESSION["id_user"] = $row['id'];
                $_SESSION["status"] = "admin";
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
        <section class="mt-6">
            <div class=" items-center justify-center flex flex-col">
                <img src="assets/images/logo.png" class="w-32 mb-2"/>
            </div>
            <div class="max-w-xl bg-green-300 h-12 mx-auto mt-3 shadow-2xl shadow-teal-300 opacity-75 rounded-2xl">
                <h1 class="text-2xl text-center font-bold pt-2" id="hello">Edge-Store</h1>
            </div>
            <div class="bg-white mx-auto h-56 max-w-xl rounded-2xl shadow-lg shadow-white">
                <form action=""method="post">
                    <div class="p-8 pb-2  mt-8 w-full text-center"> 
                        <i class="fa fa-user absolute text-primary text-xl"></i>
                        <input type="text" name="username" id="username" placeholder=" Masukan username" class=" rounded-sm focus:ring-purple-300 focus:border-purple-300 pl-8 border-b-2 focus:outline-none focus:border-primarycolor transition-all duration-500 invalid:text-red-500 required"  />    
                    </div>
                    <div class=" mt-2 w-full text-center ">
                        <i class="fa fa-lock absolute text-primary text-xl"></i>
                        <input type="password" name="pass" id="pass"placeholder=" Password" class="rounded-sm focus:ring-purple-300 focus:border-purple-300 pl-8 border-b-2  focus:outline-none focus:border-primarycolor transition-all duration-500 required" />         
                    </div>
                    <div class="w-full mt-4">
                        <button type="submit" name="login"class="block mx-auto hover:bg-blue-300 py-3 px-16 bg-violet-400 rounded-full text-white">Login</button>
                    </div>
                    <div class="mt-4 mb-2 w-full text-center underline text-sm">
                        <a href="login.php">Login as User</a>
                    </div>
                </form>    
            </div>
        </section>
        
        <!-- <img src="assets/images/wave.png" class="h-screen"> -->
        <script src="assets/js/login-script.js"></script>
    </body>
</html>