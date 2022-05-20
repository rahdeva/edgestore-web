<?php 
require 'config/functions.php';

$barang = query("SELECT * FROM tb_barang");

if( isset($_POST["submit"]) ) {
	
	// cek apakah data berhasil di tambahkan atau tidak
	if( insert($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil ditambahkan!');
				document.location.href = 'barang.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal ditambahkan!');
				document.location.href = 'barang.php';
			</script>
		";
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
                <div class="px-12 border-collapse ">
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
                            <?php $i = 1; ?>
                            <?php foreach( $barang as $row ) : ?>
                                <tr>
                                    <td class="px-4"><?= $i?></td>
                                    <td class="px-4"><?= $row["id_kategori"]; ?></td>
                                    <td class="px-4"><?= $row["nama_barang"]; ?></td>
                                    <td class="px-4"><?= $row["merk"]; ?></td>
                                    <td class="px-4"><?= $row["stok"]; ?></td>
                                    <td class="px-4"><?= $row["harga_beli"] + 0; ?></td>
                                    <td class="px-4"><?= $row["harga_jual"] + 0; ?></td>
                                    <td class="px-4"><?= $row["kedaluwarsa"]; ?></td>
                                    <td class="px-4">
                                        <button class="bg-yellow-400 rounded-md py-1 px-2 text-white text-sm">
                                            Edit
                                        </button>
                                        <button class="bg-red-400 rounded-md py-1 px-2 text-white text-sm">
                                            <a href="config/delete.php?id=<?= $row["id_barang"]; ?>" onclick="return confirm('Sure?');">Delete</a>
                                        </button>
                                    </td>
                                </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                            <tr class="font-bold">
                                <td colspan="4">Total</td>
                                <td class="px-4">211</td>
                                <td class="px-4">Rp 4.800</td>
                                <td class="px-4">Rp 8.000</td>
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
            <div class="m-auto p-5 w-4/5 rounded-2xl" style="background-color: #fefefe; border: 1px solid #888;">
                <span class="closeModal float-right hover:cursor-pointer font-bold text-3xl">&times;</span>
                <h1>Insert Data Barang</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="id_kategori">Kategori : </label>
                    <input type="text" name="id_kategori" id="id_kategori" required>
                        
                    <label for="nama_barang">Nama Barang : </label>
                    <input type="text" name="nama_barang" id="nama_barang">
                        
                    <label for="merk">Merk :</label>
                    <input type="text" name="merk" id="merk">
                            
                    <label for="stok">Stok :</label>
                    <input type="text" name="stok" id="stok">

                    <label for="harga_beli">Harga Beli :</label>
                    <input type="text" name="harga_beli" id="harga_beli">

                    <label for="harga_jual">Harga Jual :</label>
                    <input type="text" name="harga_jual" id="harga_jual">

                    <label for="kedaluwarsa">Kedaluwarsa :</label>
                    <input type="text" name="kedaluwarsa" id="kedaluwarsa">
                        
                    <button type="submit" name="submit"><i class="bi bi-plus-lg"></i> Tambah Data</button>
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