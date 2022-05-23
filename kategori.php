<?php 
require 'config/functions.php';

$kategori = query("SELECT * FROM tb_kategori");

// Insert Data
if( isset($_POST["submit"]) ) {
	if( insertKategori($_POST) > 0 ) {
		alert("tambah", true, 'kategori.php');
    } else {
        alert("tambah", false, 'kategori.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'header.php'; ?>
        <title>EdgeStore - Kategori</title>
    </head>
    <body class="font-[Inter] flex">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- Content -->
        <div class="content flex basis-11/12 bg-indigo-200 h-screen duration-1000">
            <div class="bg-white min-w-full my-10 overflow-auto">
                <div class="flex mx-12 mt-12">
                    <h1 class="grow text-4xl text-slate-700 font-bold ">Data Kategori</h1>
                    <?php include 'config/username.php'; ?>
                </div>
                <div class="mr-12 mt-12 mb-6 flex justify-end gap-4">
                    <button id="insertBtn" class="bg-cyan-400 rounded-md py-1 px-2 text-white text-sm"><i class="bi bi-plus-lg"></i> 
                        Insert Data
                    </button>
                </div>
                <div class="px-12 border-collapse ">
                    <table class="min-w-full shadow-xl rounded-t-md overflow-hidden">
                        <thead class="bg-rose-400 text-white">
                            <tr>
                                <th class="py-4">No</th>
                                <th class="py-4">ID Kategori</th>
                                <th class="py-4">Nama Kategori</th>
                                <th class="py-4">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody class="text-justify">
                            <?php $i = 1;?>
                            <?php foreach( $kategori as $row ) : ?>
                                <tr>
                                    <td class="px-12 py-4"><?= $i?></td>
                                    <td class="px-12 py-4"><?= $row["id_kategori"]; ?></td>
                                    <td class="px-12 py-4"><?= $row["nama_kategori"]; ?></td>
                                    <td class="px-12 py-4 "><?= $row["deskripsi"]; ?></td>
                                </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="bg-rose-400 p-0.5 rounded-b-md"></div>
                </div>
            </div>
        </div>
        <!-- Modal Insert Data -->
        <div id="modalInsert" class="hidden fixed pt-20 left-0 top-0 w-full h-full overflow-auto z-[1] " style="background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.4);">
            <div class="m-auto p-5 w-2/5 rounded-2xl " style="background-color: #fefefe; border: 1px solid #888;">
                <span class="closeModal float-right hover:cursor-pointer font-bold text-3xl ">&times;</span>
                <h1 class="text-3xl text-slate-700 font-bold py-4">Insert Data Kategori</h1>
                <form action="" method="post" enctype="multipart/form-data">       
                    <label for="nama_kategori" class="float-left w-2/5 my-2">Nama Kategori</label><span>:</span>
                    <input class="border-slate-800 border-2 my-2 rounded-md w-3/6" type="text" name="nama_kategori" id="nama_kategori" required><br>
                        
                    <label for="deskripsi" class="float-left w-2/5 my-2">Deskripsi</label><span>:</span>
                    <textarea id="deskripsi" name="deskripsi" rows="4" cols="50" class="border-slate-800 border-2 my-2 rounded-md w-3/6" required></textarea>
                        
                    <button type="submit" name="submit" class="text-center w-11/12 p-2 mt-4 bg-indigo-400 rounded-2xl text-white"><i class="bi bi-plus-lg"></i> Insert Data</button>
                </form>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
    <script>
        var modal = document.getElementById("modalInsert");
        var btn = document.getElementById("insertBtn");
        var closeModal = document.getElementsByClassName("closeModal")[0];
        
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
        }
    </script>
</html>