<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'header.php'; ?>
        <title>EdgeStore - Dashboard</title>
    </head>
    <body class="font-[Inter] flex">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <div class="content flex basis-11/12 bg-indigo-200 h-screen duration-1000 ">
            <div class="bg-white min-w-full my-10 overflow-auto">
                <div class="head-content flex mx-12 mt-12">
                    <h1 class="grow text-4xl text-slate-700 font-bold ">Dashboard</h1>
                    <?php include 'config/username.php'; ?>
                </div>
                <div class="body-content">
                    <div class="tables-content">
                        <div class="bg-blue-700">
                            <div class="tables-content-judul">
                                <p>Jumlah Barang</p>
                            </div>
                            <div class="tables-content-jumlah">
                                <p>10</p>
                            </div>
                            <div class="tables-content-redirect">
                                <a href="barang.php"><p>Selengkapnya >></p></a>
                            </div>
                        </div>
                        <div class="bg-sky-700">
                            <div class="tables-content-judul">
                                <p>Jumlah Kategori</p>
                            </div>
                            <div class="tables-content-jumlah">
                                <p>10</p>
                            </div>
                            <div class="tables-content-redirect">
                                <a href="kategori.php"><p>Selengkapnya >></p></a>
                            </div>
                        </div>
                        <div class="bg-cyan-700">
                            <div class="tables-content-judul">
                                <p>Jumlah Transaksi</p>
                            </div>
                            <div class="tables-content-jumlah">
                                <p>10</p>
                            </div>
                            <div class="tables-content-redirect">
                                <a href="transaksi.php"><p>Selengkapnya >></p></a>
                            </div>
                        </div>
                    </div>
                    <div class="calendar">
                        <div class="row" id="month-and-year">
                            <p id="printed-date"></p>
                        </div>
                        <div class="row" id="days-name">
                            <div class="column">Sen</div>
                            <div class="column">Sel</div>
                            <div class="column">Rab</div>
                            <div class="column">Kam</div>
                            <div class="column">Jum</div>
                            <div class="column">Sab</div>
                            <div class="column">Min</div>
                        </div>
                        <div class="row" id="dates-column"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>