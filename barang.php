<?php 
    session_start();

    if( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

    require 'config/functions.php';

    $barang = query("
        SELECT 
            tb_barang.id_barang, 
            tb_kategori.nama_kategori AS 'nama_kategori', 
            tb_barang.nama_barang, 
            tb_barang.merk, 
            tb_barang.stok, 
            tb_barang.harga_beli, 
            tb_barang.harga_jual, 
            tb_barang.kedaluwarsa 
        FROM tb_barang 
        INNER JOIN tb_kategori USING(id_kategori)
    ");

    $total = query("
        SELECT 
            SUM(stok) AS total_stok, 
            SUM(harga_beli) AS total_harga_beli, 
            SUM(harga_jual) AS total_harga_jual 
        FROM tb_barang;
    ");

    $kategori = query("SELECT * FROM tb_kategori");

    // Insert Data
    if( isset($_POST["submit"]) ) {
        if( insertBarang($_POST) > 0 )
            alert("tambah", true, 'barang.php');
        else
            alert("tambah", false, 'barang.php');
    }

    if(isset($_POST["filter"])){
        $barang = filter($_POST);
    }

    // Delete Data
    // if( isset($_POST["delete"]) ) {
    //     if( deleteBarang($_POST) > 0 ) {
    //         alert("hapus", true, 'barang.php');
    //     } else {
    //         alert("hapus", false, 'barang.php');
    //     }
    // }

    // function deleteData($id){
    //     alert($id, true, 'barang.php');
    //     // if( delete($id) > 0 ) {
    //     //     alert("hapus", true, 'barang.php');
    //     // } else {
    //     //     alert("hapus", false, 'barang.php');
    //     // }
    // }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'header.php'; ?>
        <title>EdgeStore - Barang</title>
    </head>
    <body class="font-[Inter] flex">
        
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Content -->
        <div id="container" class="content flex basis-11/12 bg-indigo-200 h-screen duration-1000">
            <div class="bg-white min-w-full my-10 overflow-auto">
                <div class="flex mx-12 mt-12">
                    <h1 class="grow text-4xl text-slate-700 font-bold ">Data Barang</h1>
                    <a href="profile.php" class="flex items-center">
                        <img src="<?php echo get_photos($_SESSION["username"]); ?>" alt="Profile" width="50" class="rounded-full">
                        <span class="ml-2 font-bold underline"><?php echo get_username($_SESSION["username"]); ?></span>
                    </a>
                </div>
                <div class="mr-12 mt-12 mb-6 flex justify-end gap-4">
                    <!-- <button class="bg-green-400 rounded-md py-1 px-2 text-white text-sm"><i class="bi bi-arrow-clockwise"></i> 
                        Refresh Data
                    </button> -->
                    <!-- <button class="bg-yellow-400 rounded-md py-1 px-2 text-white text-sm"><i class="bi bi-filter"></i> 
                        Sortir Stok Kurang
                    </button> -->
                    <form action="" method="post">
                        <select name="filter" onchange="this.form.submit()" class="border-2 border-slate-600 p-2 rounded-lg">
                            <option value="0" selected disabled hidden>Filter Data Berdasarkan</option>
                            <option value="1">Stok Tidak Habis</option>
                            <option value="2">Nama Barang Ascending</option>
                            <option value="3">Nama Barang Descending</option>
                            <option value="4">Merk Ascending</option>
                            <option value="5">Merk Descending</option>
                            <option value="6">Stok Ascending</option>
                            <option value="7">Stok Descending</option>
                            <option value="8">Harga Beli Ascending</option>
                            <option value="9">Harga Beli Descending</option>
                            <option value="10">Harga Jual Ascending</option>
                            <option value="11">Harga Jual Descending</option>
                        </select>
                    </form>
                    <button id="insertBtn" class="bg-blue-400 rounded-md py-1 px-2 text-white text-sm"><i class="bi bi-plus-lg"></i> 
                        Insert Data
                    </button>
                </div>
                <div class="px-12 border-collapse mb-6">
                    <table class="min-w-full shadow-xl rounded-t-md overflow-hidden h-full">
                        <thead class="bg-teal-400 text-white">
                            <tr class="">
                                <th class="py-4">No</th>
                                <th class="py-4">Kategori</th>
                                <th class="py-4">Nama Barang</th>
                                <th class="py-4">Merk</th>
                                <th class="py-4">Stok</th>
                                <th class="py-4">Harga Beli</th>
                                <th class="py-4">Harga Jual</th>
                                <th class="py-4">Kedaluwarsa</th>
                                <th class="py-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center ">
                            <?php $i = 1;?>
                            <?php foreach( $barang as $row ) : ?>
                                <tr>
                                    <td class="px-2 py-4"><?= $i?></td>
                                    <td class="px-2 py-4"><?= $row["nama_kategori"]; ?></td>
                                    <td class="px-2 py-4"><?= $row["nama_barang"]; ?></td>
                                    <td class="px-2 py-4"><?= $row["merk"]; ?></td>
                                    <td class="px-2 py-4"><?= $row["stok"]; ?></td>
                                    <td class="px-2 py-4"><?= $row["harga_beli"] + 0; ?></td>
                                    <td class="px-2 py-4"><?= $row["harga_jual"] + 0; ?></td>
                                    <td class="px-2 py-4"><?= $row["kedaluwarsa"]; ?></td>
                                    <td class="px-2 py-4">
                                        <button id="editBtn" name="edit" class="bg-yellow-400 rounded-md py-1 px-2 text-white text-sm">
                                            <a href="config/form-edit-barang.php?id=<?php echo $row['id_barang']; ?>">Edit</a>
                                        </button>
                                        <button name="delete" class="bg-red-400 rounded-md py-1 px-2 text-white text-sm">
                                            <a href="config/form-hapus-barang.php?id=<?php echo $row['id_barang']; ?>" onclick="return confirm('Konfirmasi Penghapusan Data')">Delete</a>
                                        </button>
                                    </td>
                                </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                            <tr class="font-bold">
                                <td colspan="4">Total</td>
                                <td class="px-2 py-4"><?= $total[0]["total_stok"] + 0; ?></td>
                                <td class="px-2 py-4"><?= $total[0]["total_harga_beli"] + 0; ?></td>
                                <td class="px-2 py-4"><?= $total[0]["total_harga_jual"] + 0; ?></td>
                                <td colspan="2"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="bg-teal-400 p-0.5 rounded-b-md"></div>
                </div>
            </div>
        </div>
        <!-- Modal Insert Data -->
        <div id="modalInsert" class="hidden fixed pt-20 left-0 top-0 w-full h-full overflow-auto z-[1] " style="background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.4);">
            <div class="m-auto p-5 w-2/5 rounded-2xl " style="background-color: #fefefe; border: 1px solid #888;">
                <span class="closeModal float-right hover:cursor-pointer font-bold text-3xl ">&times;</span>
                <h1 class="text-3xl text-slate-700 font-bold py-4">Insert Data Barang</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="id_kategori" class="float-left w-2/5 my-2">Kategori</label><span>:</span>
                    <select name="id_kategori" id="id_kategori" class="border-slate-800 border-2 my-2 rounded-md w-3/6" required>
                        <option value="0" selected disabled hidden>Pilih Kategori</option>
                        <?php foreach( $kategori as $row ) : ?>
                            <option value="<?= $row["id_kategori"]; ?>"><?= $row["nama_kategori"]; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <br><label for="nama_barang" class="float-left w-2/5 my-2">Nama Barang</label><span>:</span>
                    <input class="border-slate-800 border-2 my-2 rounded-md w-3/6" type="text" name="nama_barang" id="nama_barang" required><br>
                        
                    <label for="merk" class="float-left w-2/5 my-2">Merk</label><span>:</span>
                    <input class="border-slate-800 border-2 my-2 rounded-md w-3/6" type="text" name="merk" id="merk" required><br>
                            
                    <label for="stok" class="float-left w-2/5 my-2">Stok</label><span>:</span>
                    <input class="border-slate-800 border-2 my-2 rounded-md w-3/6" type="text" name="stok" id="stok" required><br>

                    <label for="harga_beli" class="float-left w-2/5 my-2">Harga Beli</label><span>:</span>
                    <input class="border-slate-800 border-2 my-2 rounded-md w-3/6" type="text" name="harga_beli" id="harga_beli" required><br>

                    <label for="harga_jual" class="float-left w-2/5 my-2">Harga Jual</label><span>:</span>
                    <input class="border-slate-800 border-2 my-2 rounded-md w-3/6" type="text" name="harga_jual" id="harga_jual" required><br>

                    <label for="kedaluwarsa" class="float-left w-2/5 my-2">Kedaluwarsa</label><span>:</span>
                    <input class="border-slate-800 border-2 my-2 rounded-md w-3/6" type="text" name="kedaluwarsa" id="kedaluwarsa"><br>
                        
                    <button type="submit" name="submit" class="text-center w-11/12 p-2 mt-4 bg-indigo-400 rounded-2xl text-white"><i class="bi bi-plus-lg"></i> Insert Data</button>
                </form>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>