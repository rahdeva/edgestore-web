<?php 
require 'config/functions.php';

$barang = query("SELECT * FROM tb_barang");
$index = 0;

// Insert Data
if( isset($_POST["submit"]) ) {
	if( insertBarang($_POST) > 0 ) {
		alert("tambah", true, 'barang.php');
    } else {
        alert("tambah", false, 'barang.php');
    }
}

// Delete Data
// if( isset($_POST["delete"]) ) {
//     if( deleteBarang($_POST) > 0 ) {
//         alert("hapus", true, 'barang.php');
//     } else {
//         alert("hapus", false, 'barang.php');
//     }
// }

function deleteData($id){
    alert($id, true, 'barang.php');
    // if( delete($id) > 0 ) {
    //     alert("hapus", true, 'barang.php');
    // } else {
    //     alert("hapus", false, 'barang.php');
    // }
}

if( isset($_POST["editData"]) ) {
    if( editBarang($_POST) > 0 ) {
        alert("edit", true, 'barang.php');
    } else {
        alert("edit", false, 'barang.php');
    }
}

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
        <div class="content flex basis-11/12 bg-indigo-200 h-screen duration-1000">
            <div class="bg-white min-w-full my-10 overflow-auto">
                <div class="flex mx-12 mt-12">
                    <h1 class="grow text-4xl text-slate-700 font-bold ">Data Barang</h1>
                    <?php include 'config/username.php'; ?>
                </div>
                <div class="mr-12 mt-12 mb-6 flex justify-end gap-4">
                    <button class="bg-green-400 rounded-md py-1 px-2 text-white text-sm"><i class="bi bi-arrow-clockwise"></i> 
                        Refresh Data
                    </button>
                    <button class="bg-yellow-400 rounded-md py-1 px-2 text-white text-sm"><i class="bi bi-filter"></i> 
                        Sortir Stok Kurang
                    </button>
                    <button id="insertBtn" class="bg-blue-400 rounded-md py-1 px-2 text-white text-sm"><i class="bi bi-plus-lg"></i> 
                        Insert Data
                    </button>
                </div>
                <div class="px-12 border-collapse mb-6">
                    <table class="min-w-full shadow-xl rounded-t-md overflow-hidden h-full">
                        <thead class="bg-teal-400 text-white">
                            <tr class="">
                                <th class="py-4">No</th>
                                <th class="py-4">ID Kategori</th>
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
                                    <td class="px-2"><?= $i?></td>
                                    <td class="px-2"><?= $row["id_kategori"]; ?></td>
                                    <td class="px-2"><?= $row["nama_barang"]; ?></td>
                                    <td class="px-2"><?= $row["merk"]; ?></td>
                                    <td class="px-2"><?= $row["stok"]; ?></td>
                                    <td class="px-2"><?= $row["harga_beli"] + 0; ?></td>
                                    <td class="px-2"><?= $row["harga_jual"] + 0; ?></td>
                                    <td class="px-2"><?= $row["kedaluwarsa"]; ?></td>
                                    <td class="px-2">
                                        <button id="editBtn" name="edit" class="bg-yellow-400 rounded-md py-1 px-2 text-white text-sm">
                                            <a onclick="<?php //$index = $i-1; ?> return editDataForm()">Edit
                                        </button>
                                        <button name="delete" class="bg-red-400 rounded-md py-1 px-2 text-white text-sm">
                                            <a onclick="<?php // deleteData($row["id_barang"]) ?> return confirm('Sure?');">Delete</a>
                                        </button>
                                    </td>
                                </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                            <tr class="font-bold">
                                <td colspan="4">Total</td>
                                <td class="px-2">211</td>
                                <td class="px-2">Rp 4.800</td>
                                <td class="px-2">Rp 8.000</td>
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
                    <input class="border-slate-800 border-2 my-2 rounded-md w-3/6" type="text" name="id_kategori" id="id_kategori" required><br>
                        
                    <label for="nama_barang" class="float-left w-2/5 my-2">Nama Barang</label><span>:</span>
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

        <!-- Modal Edit Data -->
        <?php $row2 = $barang[$index]; ?>
        <div id="modalEdit" class="hidden fixed pt-20 left-0 top-0 w-full h-full overflow-auto z-[1] " style="background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.4);">
            <div class="m-auto p-5 w-2/5 rounded-2xl " style="background-color: #fefefe; border: 1px solid #888;">
                <span class="closeModal2 float-right hover:cursor-pointer font-bold text-3xl ">&times;</span>
                <h1 class="text-3xl text-slate-700 font-bold py-4">Edit Data Barang</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <input class="hidden" type="text" name="id_barang" id="id_barang" value="<?= $row2["id_barang"]; ?>">
                    <label for="id_kategori" class="float-left w-2/5 my-2">Kategori</label><span>:</span>
                    <input class="border-slate-800 border-2 my-2 rounded-md w-3/6" type="text" name="id_kategori" id="id_kategori" value="<?= $row2["id_kategori"]; ?>" required><br>
                        
                    <label for="nama_barang" class="float-left w-2/5 my-2">Nama Barang</label><span>:</span>
                    <input class="border-slate-800 border-2 my-2 rounded-md w-3/6" type="text" name="nama_barang" id="nama_barang" value="<?= $row2["nama_barang"]; ?>" required><br>
                        
                    <label for="merk" class="float-left w-2/5 my-2">Merk</label><span>:</span>
                    <input class="border-slate-800 border-2 my-2 rounded-md w-3/6" type="text" name="merk" id="merk" value="<?= $row2["merk"]; ?>" required><br>
                            
                    <label for="stok" class="float-left w-2/5 my-2">Stok</label><span>:</span>
                    <input class="border-slate-800 border-2 my-2 rounded-md w-3/6" type="text" name="stok" id="stok" value="<?= $row2["stok"]; ?>" required><br>

                    <label for="harga_beli" class="float-left w-2/5 my-2">Harga Beli</label><span>:</span>
                    <input class="border-slate-800 border-2 my-2 rounded-md w-3/6" type="text" name="harga_beli" id="harga_beli" value="<?= $row2["harga_beli"]; ?>" required><br>

                    <label for="harga_jual" class="float-left w-2/5 my-2">Harga Jual</label><span>:</span>
                    <input class="border-slate-800 border-2 my-2 rounded-md w-3/6" type="text" name="harga_jual" id="harga_jual" value="<?= $row2["harga_jual"]; ?>" required><br>

                    <label for="kedaluwarsa" class="float-left w-2/5 my-2">Kedaluwarsa</label><span>:</span>
                    <input class="border-slate-800 border-2 my-2 rounded-md w-3/6" type="text" name="kedaluwarsa" id="kedaluwarsa" value="<?= $row2["kedaluwarsa"] ?>"><br>
                        
                    <button type="submit" name="editData" class="text-center w-11/12 p-2 mt-4 bg-indigo-400 rounded-2xl text-white"><i class="bi bi-pencil-square"></i>Edit Data</button>
                </form>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>

    <script>
        var modal = document.getElementById("modalInsert");
        var btn = document.getElementById("insertBtn");
        var closeModal = document.getElementsByClassName("closeModal")[0];
        var modal2 = document.getElementById("modalEdit");
        var btn2 = document.getElementById("editBtn");
        var closeModal2 = document.getElementsByClassName("closeModal2")[0];
        
        btn.onclick = function() {
            modal.style.display = "block";
        }
        
        closeModal.onclick = function() {
            modal.style.display = "none";
        }
        
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
            if (event.target == modal2) {
                modal2.style.display = "none";
            }
        }

        function editDataForm(){
            modal2.style.display = "block";
        }

        closeModal2.onclick = function() {
            modal2.style.display = "none";
        }
        
    </script>
</html>