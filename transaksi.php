<?php
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
                    <h1 class="grow text-4xl text-slate-700 font-bold ">Data Transaksi</h1>
                    <?php include 'config/username.php'; ?>
                </div>
                <h1 class="text-xl text-slate-700 font-semibold px-12 mt-8 mb-6">Cari Laporan</h1>
                <div class="flex mb-4 px-12 flex-row ">
                    <div class="float-left mr-20">
                        <table class="rounded-md overflow-hidden shadow-xl">
                            <thead class="bg-emerald-400 text-white px-4 ">
                                <tr class="text-left">
                                    <th class="p-4">Bulan</th>
                                    <th class="p-4">Tahun</th>
                                    <th class="p-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-left ">
                                <tr>
                                    <form action="">
                                        <td class="p-4">
                                            <select name="bulan" id="bulan" class="border-2 border-slate-600 p-2 rounded-lg">
                                                <option value="" selected disabled hidden>Pilih Bulan</option>
                                                <option value="januari">Januari</option>
                                                <option value="februari">Februari</option>
                                                <option value="maret">Maret</option>
                                                <option value="april">April</option>
                                                <option value="mei">Mei</option>
                                                <option value="juni">Juni</option>
                                                <option value="juli">Juli</option>
                                                <option value="agustus">Agustus</option>
                                                <option value="september">September</option>
                                                <option value="oktober">Oktober</option>
                                                <option value="november">November</option>
                                                <option value="desember">Desember</option>
                                            </select>
                                        </td>
                                        <td class="p-4">
                                            <select name="tahun" id="tahun" class="border-2 border-slate-600 p-2 rounded-lg">
                                                <option value="" selected disabled hidden>Pilih Tahun</option>
                                                <option value="<2022">&lt; 2022</option>
                                                <option value="2022">2022</option>
                                                <option value=">2022">&gt; 2022</option>
                                            </select>
                                        </td>
                                        <td colspan="3" class="p-4">
                                            <button type="submit" name="submit" class="py-2 px-4 bg-indigo-400 rounded-2xl text-white"><i class="bi bi-search"></i> Cari </button>
                                        </td>
                                    </form>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right">
                        <table class="rounded-md overflow-hidden shadow-xl">
                            <thead class="bg-emerald-400 text-white px-4  ">
                                <tr class="text-left">
                                    <th class="p-4">Hari</th>
                                    <th class="p-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-left ">
                                <tr>
                                    <form action="">
                                        <td class="p-4">
                                            <select name="hari" id="hari" class="border-2 border-slate-600 p-2 rounded-lg">
                                                <option value="" selected disabled hidden>Pilih Hari</option>
                                                <option value="senin">Senin</option>
                                                <option value="selasa">Selasa</option>
                                                <option value="rabu">Rabu</option>
                                                <option value="kamis">Kamis</option>
                                                <option value="jumat">Jumat</option>
                                                <option value="sabtu">Sabtu</option>
                                                <option value="minggu">Minggu</option>
                                            </select>
                                        </td>
                                        <td colspan="3" class="p-4">
                                            <button type="submit" name="submit" class="py-2 px-4 bg-indigo-400 rounded-2xl text-white"><i class="bi bi-search"></i> Cari </button>
                                        </td>
                                    </form>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="px-12 border-collapse mt-12 mb-6">
                    <table class="min-w-full shadow-xl rounded-t-md overflow-hidden h-full">
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
                            <tr class="font-bold">
                                <td colspan="3">Total Terjual</td>
                                <td class="px-2 py-4"><?= $total[0]["total_jumlah"] + 0; ?></td>
                                <td class="px-2 py-4"><?= $total[0]["total_modal"] + 0; ?></td>
                                <td class="px-2 py-4"><?= $total[0]["total_total"] + 0; ?></td>
                                <td class="px-2 py-4 bg-emerald-400">Keuntungan</td>
                                <td class="px-2 py-4 bg-emerald-400"><?= $keuntungan; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="bg-emerald-400 p-0.5 rounded-b-md"></div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>