<?php 
    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: ../dashboard.php");
        exit;
    }

    require 'functions.php';

    $id = $_GET['id'];
    $barang = mysqli_query($connect, "SELECT * FROM tb_barang WHERE id_barang = $id");
    $row = mysqli_fetch_assoc($barang);

    if(isset($_POST["editData"])){
        if(editBarang($_POST) > 0)
            alert("edit", true, '../barang.php');
        else
            alert("edit", false, '../barang.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '../header.php'; ?>
        <title>EdgeStore - Barang</title>
    </head>
    <body class="font-[Inter]">

        <!-- Content -->
        <div class="content flex basis-11/12 bg-indigo-200 duration-1000">
            <div class="bg-white min-w-full my-10 overflow-auto">
                <div class="flex mx-12 mt-12">
                    <h1 class="grow text-4xl text-slate-700 font-bold ">Edit Barang</h1>
                    <a href="profile.php" class="flex items-center">
                        <img src="https://source.unsplash.com/1080x1080?profile" alt="Profile" width="36" class="rounded-full">
                        <span class="ml-4 font-bold underline"><?php get_username($_SESSION["username"]); ?></span>
                    </a>
                </div>
                <div class="flex mx-12 mt-12 text-center">
                    <form action="" method="post" enctype="multipart/form-data" class="w-full text-base">
                        <input class="hidden" type="text" name="id_barang" id="id_barang" value="<?= $row["id_barang"]; ?>">

                        <label for="id_kategori" class="float-left text-left w-2/5 my-2">Kategori</label>
                        <input class="border-slate-800 border-2 my-2 rounded-md w-full" type="text" name="id_kategori" id="id_kategori" value="<?= $row["id_kategori"]; ?>" required><br>
                                
                        <label for="nama_barang" class="float-left text-left w-2/5 my-2">Nama Barang</label>
                        <input class="border-slate-800 border-2 my-2 rounded-md w-full" type="text" name="nama_barang" id="nama_barang" value="<?= $row["nama_barang"]; ?>" required><br>
                                
                        <label for="merk" class="float-left text-left w-2/5 my-2">Merk</label>
                        <input class="border-slate-800 border-2 my-2 rounded-md w-full" type="text" name="merk" id="merk" value="<?= $row["merk"]; ?>" required><br>
                                    
                        <label for="stok" class="float-left text-left w-2/5 my-2">Stok</label>
                        <input class="border-slate-800 border-2 my-2 rounded-md w-full" type="text" name="stok" id="stok" value="<?= $row["stok"]; ?>" required><br>

                        <label for="harga_beli" class="float-left text-left w-2/5 my-2">Harga Beli</label>
                        <input class="border-slate-800 border-2 my-2 rounded-md w-full" type="text" name="harga_beli" id="harga_beli" value="<?= $row["harga_beli"]; ?>" required><br>
                        
                        <label for="harga_jual" class="float-left text-left w-2/5 my-2">Harga Jual</label>
                        <input class="border-slate-800 border-2 my-2 rounded-md w-full" type="text" name="harga_jual" id="harga_jual" value="<?= $row["harga_jual"]; ?>" required><br>

                        <label for="kedaluwarsa" class="float-left text-left w-2/5 my-2">Kedaluwarsa</label>
                        <input class="border-slate-800 border-2 my-2 rounded-md w-full" type="text" name="kedaluwarsa" id="kedaluwarsa" value="<?= $row["kedaluwarsa"] ?>"><br>
                                
                        <button type="submit" name="editData" class="m-4 text-center w-6/12 p-2 mt-4 bg-indigo-400 rounded-2xl text-white"><i class="bi bi-pencil-square"></i>Edit Data</button>
                    </form>
                </div>
            </div>
        </div>
        <?php include '../footer.php'; ?>
    </body>
</html>