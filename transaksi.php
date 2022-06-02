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
                    <h1 class="grow text-4xl text-slate-700 font-bold ">Data Transaksi</h1>
                    <a href="profile.php" class="flex items-center">
                        <img src="<?php echo get_photos($_SESSION["username"]); ?>" alt="Profile" width="36" class="rounded-full">
                        <span class="ml-4 font-bold underline"><?php echo get_username($_SESSION["username"]); ?></span>
                    </a>
                </div>
                <div class="flex mb-4 px-12 flex-row ">
                    <div class="float-left mr-20">
                        <h1 class="text-xl text-slate-700 font-semibold mt-8 mb-4">Cari Laporan Per Bulan</h1>
                        <table class="rounded-md overflow-hidden shadow-xl">
                            <thead class="bg-emerald-400 text-white px-4 ">
                                <tr class="text-left">
                                    <th class="p-4">Tahun</th>
                                    <th class="p-4">Bulan</th>
                                    <th class="p-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-left ">
                                <tr>
                                    <form action="" method="post">
                                        <td class="p-4">
                                            <select name="tahun" id="tahun" class="border-2 border-slate-600 p-2 rounded-lg">
                                                <option value="" selected disabled hidden>Pilih Tahun</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                            </select>
                                        </td>
                                        <td class="p-4">
                                            <select name="bulan" id="bulan" class="border-2 border-slate-600 p-2 rounded-lg">
                                                <option value="" selected disabled hidden>Pilih Bulan</option>
                                                <option value="01">Januari</option>
                                                <option value="02">Februari</option>
                                                <option value="03">Maret</option>
                                                <option value="04">April</option>
                                                <option value="05">Mei</option>
                                                <option value="06">Juni</option>
                                                <option value="07">Juli</option>
                                                <option value="08">Agustus</option>
                                                <option value="09">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </td>
                                        <td colspan="3" class="p-4">
                                            <button type="laporBulanan" name="laporBulanan" class="py-2 px-4 bg-indigo-400 rounded-2xl text-white"><i class="bi bi-search"></i> Cari </button>
                                        </td>
                                    </form>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right">
                        <h1 class="text-xl text-slate-700 font-semibold mt-8 mb-4">Cari Laporan Per Tanggal</h1>
                        <table class="rounded-md overflow-hidden shadow-xl">
                            <thead class="bg-emerald-400 text-white px-4 ">
                                <tr class="text-left">
                                    <th class="p-4">Tahun</th>
                                    <th class="p-4">Bulan</th>
                                    <th class="p-4">Tanggal</th>
                                    <th class="p-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-left ">
                                <tr>
                                    <form action="" method="post">
                                        <td class="p-4">
                                            <select name="tahun" id="tahun" class="border-2 border-slate-600 p-2 rounded-lg">
                                                <option value="" selected disabled hidden>Pilih Tahun</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                            </select>
                                        </td>
                                        <td class="p-4">
                                            <select name="bulan" id="bulan" class="border-2 border-slate-600 p-2 rounded-lg">
                                                <option value="" selected disabled hidden>Pilih Bulan</option>
                                                <option value="01">Januari</option>
                                                <option value="02">Februari</option>
                                                <option value="03">Maret</option>
                                                <option value="04">April</option>
                                                <option value="05">Mei</option>
                                                <option value="06">Juni</option>
                                                <option value="07">Juli</option>
                                                <option value="08">Agustus</option>
                                                <option value="09">September</option>
                                                <option value="10">Oktober</option>
                                                <option value="11">November</option>
                                                <option value="12">Desember</option>
                                            </select>
                                        </td>
                                        <td class="p-4">
                                            <select name="tanggal" id="tanggal" class="border-2 border-slate-600 p-2 rounded-lg">
                                                <option value="" selected disabled hidden>Pilih Tanggal</option>
                                                <?php for($i = 1; $i < 32; $i++){?>
                                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td colspan="3" class="p-4">
                                            <button type="laporTanggal" name="laporTanggal" class="py-2 px-4 bg-indigo-400 rounded-2xl text-white"><i class="bi bi-search"></i> Cari </button>
                                        </td>
                                    </form>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="px-12 border-collapse mt-12 mb-6">
                    <div class="flex">
                        <h1 class="text-xl text-slate-700 font-semibold float-left grow">Data Transaksi</h1>
                        <button class="bg-emerald-400 rounded-md py-1 px-2 text-white text-sm float-left"> 
                            <a href="transaksi-kasir.php">Tampilkan Transaksi Berdasarkan Kasir</a>
                        </button>
                    </div>  
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