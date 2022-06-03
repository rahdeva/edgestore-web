<?php
    session_start();

    if( isset($_SESSION["login"]) ) {
        header("Location: dashboard.php");
        exit;
    }

    require 'functions.php';

    if(isset($_POST["forgot-password"])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $no_telp = $_POST['no_telepon'];

        $query_user = "SELECT * FROM tb_user WHERE username = '$username'";
        $result = mysqli_query($connect, $query_user);

        //cek username
        if(mysqli_num_rows($result) === 1){
            //cek password
            $row = mysqli_fetch_assoc($result);
            $id_user = $row["id"];
            $tb_profil = query("SELECT * FROM validasi_lupa_password WHERE username = 'suarno'");
            var_dump($tb_profil);
            if($email == $tb_profil[0]['email'] && $no_telp == $tb_profil[0]['no_telepon']){
                header("Location: change-new-password.php?id=$id_user");
                exit;
            }
            else
                echo "
                    <script>
                        alert('Data yang Anda masukkan salah!');
                    </script>
                ";
        }
        else
            echo "
                <script>
                    alert('Username yang Anda masukkan tidak ada!');
                </script>
            ";
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
            <div class="bg-white mx-auto h-72 max-w-xl rounded-2xl shadow-lg shadow-white">
                <form action=""method="post">
                    <div class="p-8 pb-2  mt-8 w-full text-center"> 
                        <i class="fa fa-user absolute text-primary text-xl"></i>
                        <input type="text" name="username" id="username" placeholder=" Masukan username" class=" rounded-sm focus:ring-purple-300 focus:border-purple-300 pl-8 border-b-2 focus:outline-none focus:border-primarycolor transition-all duration-500 invalid:text-red-500 required"  />    
                    </div>
                    <div class="p-8 pb-2 w-full text-center"> 
                        <i class="fa fa-envelope absolute text-primary text-xl"></i>
                        <input type="text" name="email" id="email" placeholder=" Masukan email" class=" rounded-sm focus:ring-purple-300 focus:border-purple-300 pl-8 border-b-2 focus:outline-none focus:border-primarycolor transition-all duration-500 invalid:text-red-500 required"  />    
                    </div>
                    <div class="p-8 pb-2 w-full text-center"> 
                        <i class="fa fa-phone-square absolute text-primary text-xl"></i>
                        <input type="text" name="no_telepon" id="no_telepon" placeholder=" Masukan no telepon" class=" rounded-sm focus:ring-purple-300 focus:border-purple-300 pl-8 border-b-2 focus:outline-none focus:border-primarycolor transition-all duration-500 invalid:text-red-500 required"  />    
                    </div>
                    <div class="w-full mt-4">
                        <button type="submit" name="forgot-password"class="block mx-auto hover:bg-blue-300 py-3 px-16 bg-violet-400 rounded-full text_whi text-white">Forgot Password</button>
                    </div>
                </form>    
            </div>
        </section>
        <!-- <img src="assets/images/wave.png" class="h-screen"> -->
    </body>
</html>