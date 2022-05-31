<?php

session_start();

    if( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

require 'config/functions.php';

$date = date('j F Y');

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'header.php'; ?>
        <title>EdgeStore - Kasir</title>
    </head>
    <body class="font-[Inter] flex">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <div class="content flex basis-11/12 bg-indigo-200 h-screen duration-1000">
            <div class="bg-white min-w-full my-10 overflow-auto">
                <div class="flex mx-12 mt-12">
                    <h1 class="grow text-4xl text-slate-700 font-bold ">Kasir</h1>
                    <a href="profile.php" class="flex items-center">
                        <img src="<?php echo get_photos($_SESSION["username"]); ?>" alt="Profile" width="36" class="rounded-full">
                        <span class="ml-4 font-bold underline"><?php echo get_username($_SESSION["username"]); ?></span>
                    </a>
                </div>
                <div class="flex flex-row mx-12 my-4">
                    <div class="flex basis-1/3 bg-white-200 flex-col m-4 p-4 rounded-2xl border-4 border-indigo-400 h-40">
                        <h1 class="text-2xl text-slate-700 font-bold mt-2 mb-4"><i class="bi bi-search"></i> Cari Barang </h1>
                        <form action="" method="post">
                            <input type="text" name="keyword" size="40" autofocus placeholder="Masukkan Keyword" autocomplete="off" id="keyword" class="w-full px-3 py-2 rounded-lg border-slate-800 border-2">
                        </form>
                    </div>
                    <div class="flex basis-2/3 bg-white-200 flex-col m-4 p-4 rounded-2xl border-4 border-indigo-400 h-auto">
                        <h1 class="text-2xl text-slate-700 font-bold mt-2 mb-4"><i class="bi bi-list"></i> Hasil Pencarian</h1>
                        <div id="containerSearched">
                            <h1 class="text-center w-full mt-2">Silahkan Lakukan Pencarian!</h1>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row mx-12 my-4">
                    <div class="flex w-full bg-white-200 flex-col m-4 p-4 rounded-2xl border-4 border-indigo-400">
                        <div class="flex mt-2 mb-4">
                            <h1 class="grow text-2xl text-slate-700 font-bold "><i class="bi bi-cart-fill"></i> Kasir</h1>
                            <button type="submit" name="submit" class="float-right py-2 px-4 bg-red-400 rounded-2xl text-white font-bold">RESET KERANJANG</button>
                        </div>
                        <table>
                            <tr>
                                <th><label for="tanggal" >Tanggal </label></th>
                                <td><input disabled class="w-full px-3 py-2 rounded-lg border-slate-800 border-2 bg-slate-300"  type="text" id="tanggal" name="tanggal" value="<?= $date ?>"></td>
                            </tr>
                        </table>
                        <hr class="my-4 w-full", size="3", color=black>  
                        <div id="containerKasir">
                            <h1 class="text-center w-full mt-2">Anda belum menambahkan barang apapun.</h1>
                        </div>
                        <form action="" method="post">
                            <hr class="my-4 w-full", size="3", color=black>  
                            <label for="total" class="mr-4">Total Semua</label>
                            <input disabled class="w-1/3 px-3 py-2 rounded-lg border-slate-800 border-2 mr-4"  type="text" id="total" name="total" value="">

                            <label for="bayar" class="mr-4">Bayar</label>
                            <input class="w-1/3 px-3 py-2 rounded-lg border-slate-800 border-2"  type="number" id="bayar" name="bayar" value=""><br>
                            
                            <hr class="my-4 w-full" size="3" color=black>  
                            
                            <label for="kembali" class="mt-4 mr-12">Kembali</label>
                            <input disabled class="w-1/3 px-3 py-2 rounded-lg border-slate-800 border-2"  type="text" id="kembali" name="kembali" value="">

                            <button type="submit" name="submit" class="float-right py-2 px-4 mt-4 bg-indigo-400 rounded-2xl text-white"><i class="bi bi-pencil-square"></i> Bayar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/js/search.js"></script>
        <?php include 'footer.php'; ?>
    </body>
</html>