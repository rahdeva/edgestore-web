<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

if( $_SESSION["status"] == 'user') {
    header("Location: profile.php");
    exit;
}

require 'config/functions.php';

$username = get_username($_SESSION["username"]);

$id_user = $_SESSION["id_user"];

$queryUser = query("
    SELECT * 
    FROM tb_user 
    WHERE id = '$id_user'; 
");

$id_user = $queryUser[0]["id"];

$profile = query("
    SELECT * 
    FROM tb_admin
    WHERE id_admin = '$id_user'; 
");

if(isset($_POST["editProfile"])){
    if(editProfile($_POST) > 0)
        alert("edit", true, 'profile-admin.php');
    else
        alert("edit", false, 'profile-admin.php');
}

if(isset($_POST["editPassword"])){
    if(editPassword($_POST) > 0)
        alert("ganti", true, 'profile-admin.php');
    else
        alert("ganti", false, 'profile-admin.php');
}

if(isset($_POST["editPhoto"])){
    if(editPhoto($_POST) > 0)
        alert("ganti", true, 'profile-admin.php');
    else
        alert("ganti", false, 'profile-admin.php');
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'header.php'; ?>
        <title>EdgeStore - Profile</title>
    </head>
    <body class="font-[Inter] flex">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- Content -->
        <div class="content flex basis-11/12 bg-indigo-200 h-screen duration-1000">
            <div class="bg-white min-w-full my-10 overflow-auto flex-col">
                <h1 class="text-4xl text-slate-700 font-bold ml-12 mt-12">Profile</h1>
                <div class="flex flex-row mx-12 my-4">
                    <div class="flex basis-1/3 bg-white-200 flex-col m-4 p-4 rounded-2xl border-4 border-indigo-400 h-4/5">
                        <img src="<?php echo get_photos($_SESSION["username"]); ?>" alt="Profile" class="rounded-full w-full h-full mt-2 mb-4 ">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input class="hidden" type="text" name="id_admin" id="id_admin" value="<?= $profile[0]["id_admin"]; ?>">
                            <label for="gambar">Choose Files</label>
                            <input class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="file" id="gambar" name="gambar" value="">

                            <button type="submit" name="editPhoto" class="float-right py-2 px-4 mt-4 bg-indigo-400 rounded-2xl text-white"><i class="bi bi-pencil-square"></i> Change Profil Picture</button>
                        </form>
                    </div>
                    <div class="flex basis-1/3 bg-white-200 flex-col m-4 p-4 rounded-2xl border-4 border-indigo-400">
                        <h1 class="text-2xl text-slate-700 font-bold mt-2 mb-4"><i class="bi bi-person-fill"></i> Kelola Pengguna</h1>
                        <form action="" method="post">
                            <input class="hidden" type="text" name="id_admin" id="id_admin" value="<?= $profile[0]["id_admin"]; ?>">
                            
                            <label for="nama_depan">Nama Depan</label>
                            <input class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="text" id="nama_depan" name="nama_depan" value="<?= $profile[0]["nama_depan"]; ?>">

                            <label for="nama_belakang">Nama Belakang</label>
                            <input class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="text" id="nama_belakang" name="nama_belakang" value="<?= $profile[0]["nama_belakang"]; ?>">

                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="date" id="tgl_lahir" name="tgl_lahir" value="<?= $profile[0]["tgl_lahir"]; ?>">

                            <label for="email">Email</label>
                            <input class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="text" id="email" name="email" value="<?= $profile[0]["email"]; ?>">

                            <label for="no_telepon">Telepon</label>
                            <input class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="text" id="no_telepon" name="no_telepon" value="<?= $profile[0]["no_telepon"]; ?>">

                            <label for="alamat">Alamat</label>
                            <input class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="text" id="alamat" name="alamat" value="<?= $profile[0]["alamat"]; ?>">

                            <button type="submit" name="editProfile" class="float-right py-2 px-4 mt-4 bg-indigo-400 rounded-2xl text-white"><i class="bi bi-pencil-square"></i> Edit Profil</button>
                            
                        </form>
                    </div>
                    <div class="flex basis-1/3 bg-white-200 flex-col m-4 p-4 rounded-2xl border-4 border-indigo-400 h-1/2">
                        <h1 class="text-2xl text-slate-700 font-bold mt-2 mb-4"><i class="bi bi-lock-fill"></i> Ganti Password</h1>
                        <form action="" method="post">
                            <input class="hidden" type="text" name="id_admin" id="id_admin" value="<?= $profile[0]["id_admin"]; ?>">

                            <label for="usernameEdit">Username </label>
                            <input disabled class="w-full px-3 py-2 rounded-lg border-slate-800 border-2 bg-slate-300"  type="text" id="usernameEdit" name="usernameEdit" value="<?= $queryUser[0]["username"]; ?>">

                            <label for="password">Password Baru</label>
                            <input class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="password" id="password" name="password" value="">

                            <button type="submit" name="editPassword" class="float-right py-2 px-4 mt-4 bg-indigo-400 rounded-2xl text-white"><i class="bi bi-pencil-square"></i> Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>