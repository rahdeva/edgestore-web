<?php
    session_start();

    if( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

    require 'config/functions.php';

    $transaksi = query("
        SELECT tb_transaksi.id_barang, 
            tb_barang.nama_barang, 
            tb_transaksi.jumlah, 
            tb_barang.harga_beli * tb_transaksi.jumlah AS 'modal', 
            tb_barang.harga_jual * tb_transaksi.jumlah AS 'total', 
            tb_transaksi.kasir, 
            tb_transaksi.waktu_input
        FROM tb_transaksi 
        INNER JOIN tb_barang USING(id_barang);     
    ");

    $total = query("
        SELECT 
            SUM(jumlah) AS total_jumlah,
            SUM(modal) AS total_modal, 
            SUM(total) AS total_total
        FROM (
            SELECT tb_transaksi.jumlah, 
                tb_barang.harga_beli * tb_transaksi.jumlah AS 'modal', 
                tb_barang.harga_jual * tb_transaksi.jumlah AS 'total' 
            FROM tb_transaksi 
            INNER JOIN tb_barang USING(id_barang)
        ) as tb_transaksibarang;
    ");

    $keuntungan = $total[0]["total_total"] - $total[0]["total_modal"];

    if(isset($_POST["laporBulanan"])){
        $transaksi = laporanBulanan($_POST);
    }

    if(isset($_POST["laporTanggal"])){
        $transaksi = laporanTanggal($_POST);
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
                    <h1 class="grow text-4xl text-slate-700 font-bold ">Transaksi Berdasarkan Kasir</h1>
                </div>
                <div class="flex mx-12 mt-8">
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
                </div>
                <div class="px-12 border-collapse mt-6 mb-6">
                    <h1 class="text-xl text-slate-700 font-semibold mb-4">Data Transaksi</h1>
                    <table class="min-w-full shadow-xl rounded-t-md overflow-hidden h-full mt-4">
                        <thead class="bg-emerald-400 text-white">
                            <tr class="">
                                <th class="py-4">No</th>
                                <th class="py-4">ID Barang</th>
                                <th class="py-4">Nama Barang</th>
                                <th class="py-4">Jumlah</th>
                                <th class="py-4">Modal</th>
                                <th class="py-4">Total</th>
                                <th class="py-4">Kasir</th>
                                <th class="py-4">Waktu Input</th>
                            </tr>
                        </thead>
                        <tbody class="text-center ">
                            <?php $i = 1;?>
                            <?php foreach( $transaksi as $row ) : ?>
                                <tr>
                                    <td class="px-2 py-4"><?= $i?></td>
                                    <td class="px-2 py-4"><?= $row["id_barang"]; ?></td>
                                    <td class="px-2 py-4"><?= $row["nama_barang"]; ?></td>
                                    <td class="px-2 py-4"><?= $row["jumlah"]; ?></td>
                                    <td class="px-2 py-4"><?= $row["modal"] + 0; ?></td>
                                    <td class="px-2 py-4"><?= $row["total"] + 0; ?></td>
                                    <td class="px-2 py-4"><?= $row["kasir"]; ?></td>
                                    <td class="px-2 py-4"><?= $row["waktu_input"]; ?></td>
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