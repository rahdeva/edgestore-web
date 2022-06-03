<?php
    session_start();

    if( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

    require 'config/functions.php';

    // $kasir = query("
    //     SELECT 
    //         CONCAT(tb_profil.nama_depan, ' ', tb_profil.nama_belakang) AS nama_kasir,
    //         tb_profil.alamat,
    //         tb_profil.tgl_lahir,	
    //         tb_profil.email,
    //         tb_profil.no_telepon
    //     FROM tb_profil
    //     UNION
    //     SELECT
    //         CONCAT(tb_admin.nama_depan, ' ', tb_admin.nama_belakang) AS nama_kasir,
    //         tb_admin.alamat,
    //         tb_admin.tgl_lahir,	
    //         tb_admin.email,
    //         tb_admin.no_telepon
    //     FROM tb_admin;     
    // ");

    $result = mysqli_query($connect, "CALL DaftarKasir();");

	$rows = [];
	while( $row = mysqli_fetch_array($result) ) {
		$rows[] = $row;
	}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'header.php'; ?>
        <title>EdgeStore - Transaksi</title>
    </head>
    <body class="font-[Inter] flex">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- Content -->
        <div class="content flex basis-11/12 bg-indigo-200 h-screen duration-1000">
            <div class="bg-white min-w-full my-10 overflow-auto">
                <div class="flex mx-12 mt-12">
                    <h1 class="grow text-4xl text-slate-700 font-bold ">Daftar Kasir</h1>
                </div>
                <!-- <div class="flex mx-12 mt-8">
                    <form action="" method="post">
                        <select name="filter" onchange="this.form.submit()" class="border-2 border-slate-600 p-2 rounded-lg">
                            <option value="0" selected disabled hidden>Pilih Kasir</option>
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
                            <option value="12">Makanan Ringan & Minuman</option>
                            <option value="13">Stok Terkecil & Terbesar</option>
                        </select>
                    </form>
                </div> -->
                <div class="px-12 border-collapse mt-6 mb-6">
                    <table class="min-w-full shadow-xl rounded-t-md overflow-hidden h-full mt-4">
                        <thead class="bg-emerald-400 text-white">
                            <tr class="">
                                <th class="py-4">No</th>
                                <th class="py-4">Nama Kasir</th>
                                <th class="py-4">Alamat</th>
                                <th class="py-4">Tanggal Lahir</th>
                                <th class="py-4">Email</th>
                                <th class="py-4">No Telepon</th>
                            </tr>
                        </thead>
                        <tbody class="text-center ">
                            <?php $i = 1;?>
                            <?php foreach( $rows as $row ) : ?>
                                <tr>
                                    <td class="px-2 py-4"><?= $i?></td>
                                    <td class="px-2 py-4"><?= $row["nama_kasir"]; ?></td>
                                    <td class="px-2 py-4"><?= $row["alamat"]; ?></td>
                                    <td class="px-2 py-4"><?= $row["tgl_lahir"]; ?></td>
                                    <td class="px-2 py-4"><?= $row["email"]; ?></td>
                                    <td class="px-2 py-4"><?= $row["no_telepon"]; ?></td>
                                </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="bg-emerald-400 p-0.5 rounded-b-md"></div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>