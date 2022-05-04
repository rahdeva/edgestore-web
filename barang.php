<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'header.php'; ?>
        <title>EdgeStore - Barang</title>
    </head>
    <body class="bg-white  font-[Inter] flex">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <div class="content flex basis-11/12 bg-indigo-200 h-screen duration-1000">
            <div class="bg-white min-w-full my-10 overflow-auto">
                <div class="flex mx-12 mt-12">
                    <h1 class="grow text-4xl text-slate-700 font-bold ">Data Barang</h1>
                    <a href="profile.html" class="flex items-center">
                        <img src="https://source.unsplash.com/1080x1080?profile" alt="Profile" width="36" class="rounded-full">
                        <span class="ml-4 font-bold">Wayan Micheal Jonathan Suarno</span>
                    </a>
                </div>
                <div class="mr-12 mt-12 mb-6 flex justify-end gap-4">
                    <button class="bg-green-400 rounded-md py-1 px-2 text-white text-sm">♻ Refresh Data</button>
                    <button class="bg-yellow-400 rounded-md py-1 px-2 text-white text-sm">⁙ Sortir Stok Kurang</button>
                    <button class="bg-blue-400 rounded-md py-1 px-2 text-white text-sm">+ Insert Data</button>
                </div>
                <div class="px-12 border-collapse ">
                    <table class="min-w-full shadow-xl rounded-t-md overflow-hidden h-full">
                        <thead class="bg-teal-400 text-white">
                            <tr class="">
                                <th class="p-4">No</th>
                                <th class="p-4">ID Barang</th>
                                <th class="p-4">Kategori</th>
                                <th class="p-4">Nama Barang</th>
                                <th class="p-4">Merk</th>
                                <th class="p-4">Stok</th>
                                <th class="p-4">Harga Beli</th>
                                <th class="p-4">Harga Jual</th>
                                <th class="p-4">Kadaluarsa</th>
                                <th class="p-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center ">
                            <tr>
                                <td class="p-2">1</td>
                                <td class="p-2">BR003</td>
                                <td class="p-2">ATK</td>
                                <td class="p-2">Pulpen</td>
                                <td class="p-2">Pilot</td>
                                <td class="p-2">70</td>
                                <td class="p-2">Rp 1.500</td>
                                <td class="p-2">Rp 2.000</td>
                                <td class="p-2">2022-10-13</td>
                                <td class="p-2">
                                    <button class="bg-blue-400 rounded-md py-1 px-2 text-white text-sm">Details</button>
                                    <button class="bg-yellow-400 rounded-md py-1 px-2 text-white text-sm">Edit</button>
                                    <button class="bg-red-400 rounded-md py-1 px-2 text-white text-sm">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-2">2</td>
                                <td class="p-2">BR002</td>
                                <td class="p-2">Sabun</td>
                                <td class="p-2">Sabun</td>
                                <td class="p-2">Lifeboy</td>
                                <td class="p-2">38</td>
                                <td class="p-2">Rp 1.800</td>
                                <td class="p-2">Rp 3.000</td>
                                <td class="p-2">2022-12-12</td>
                                <td class="p-2">
                                    <button class="bg-blue-400 rounded-md py-1 px-2 text-white text-sm">Details</button>
                                    <button class="bg-yellow-400 rounded-md py-1 px-2 text-white text-sm">Edit</button>
                                    <button class="bg-red-400 rounded-md py-1 px-2 text-white text-sm">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-2">3</td>
                                <td class="p-2">BR001</td>
                                <td class="p-2">ATK</td>
                                <td class="p-2">Pensil</td>
                                <td class="p-2">Fabel Castel</td>
                                <td class="p-2">103</td>
                                <td class="p-2">Rp 1.500</td>
                                <td class="p-2">Rp 3.000</td>
                                <td class="p-2">2023-09-05</td>
                                <td class="p-2">
                                    <button class="bg-blue-400 rounded-md py-1 px-2 text-white text-sm">Details</button>
                                    <button class="bg-yellow-400 rounded-md py-1 px-2 text-white text-sm">Edit</button>
                                    <button class="bg-red-400 rounded-md py-1 px-2 text-white text-sm">Hapus</button>
                                </td>
                            </tr>
                            <tr class="font-bold">
                                <td class="p-2 " colspan="5">Total</td>
                                <td class="p-2">211</td>
                                <td class="p-2">Rp 4.800</td>
                                <td class="p-2">Rp 8.000</td>
                                <td class="p-2" colspan="2"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="bg-teal-400 p-0.5 rounded-b-md"></div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>