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
                    <?php include 'config/username.php'; ?>
                </div>
                <div class="flex flex-row mx-12 my-4">
                    <div class="flex basis-1/3 bg-white-200 flex-col m-4 p-4 rounded-2xl border-4 border-indigo-400 h-40">
                        <h1 class="text-2xl text-slate-700 font-bold mt-2 mb-4"><i class="bi bi-search"></i> Cari Barang </h1>
                        <form action="" method="post">
                            <input disabled class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="text" id="nama_depan" name="nama_depan" value="">
                        </form>
                    </div>
                    <div class="flex basis-2/3 bg-white-200 flex-col m-4 p-4 rounded-2xl border-4 border-indigo-400 h-auto">
                        <h1 class="text-2xl text-slate-700 font-bold mt-2 mb-4"><i class="bi bi-list"></i> Hasil Pencarian</h1>
                        
                    </div>
                </div>
                <div class="flex flex-row mx-12 my-4">
                    <div class="flex w-full bg-white-200 flex-col m-4 p-4 rounded-2xl border-4 border-indigo-400">
                        <div class="flex mt-2 mb-4">
                            <h1 class="grow text-2xl text-slate-700 font-bold "><i class="bi bi-cart-fill"></i> Kasir</h1>
                            <button type="submit" name="submit" class="float-right py-2 px-4 bg-red-400 rounded-2xl text-white font-bold">RESET KERANJANG</button>
                        </div>
                        <form action="" method="post">
                            <label for="tanggal">Tanggal</label>
                            <input disabled class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="text" id="tanggal" name="tanggal" value="">
                            
                            <label for="total">Total Semua</label>
                            <input class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="text" id="total" name="total" value="">

                            <label for="bayar">Bayar</label>
                            <input class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="text" id="bayar" name="bayar" value="">

                            <label for="kembali">Kembali</label>
                            <input class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="text" id="kembali" name="kembali" value="">

                            <button type="submit" name="submit" class="float-right py-2 px-4 mt-4 bg-indigo-400 rounded-2xl text-white"><i class="bi bi-pencil-square"></i> Bayar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>
    </body>
</html>