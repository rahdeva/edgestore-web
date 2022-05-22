<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'header.php'; ?>
        <title>EdgeStore - Profile</title>
    </head>
    <body class="font-[Inter] flex">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- Content -->
        <div class="content flex basis-11/12 bg-indigo-200 h-screen duration-1000">
            <div class="bg-white min-w-full my-10 overflow-auto flex-col">
                <h1 class="text-4xl text-slate-700 font-bold ml-12 mt-12">Profile</h1>
                <div class="flex flex-row mx-12 my-4">
                    <div class="flex basis-1/3 bg-white-200 flex-col m-4 p-4 rounded-2xl border-4 border-indigo-400 h-4/5">
                        <img src="https://source.unsplash.com/1080x1080?profile" alt="Profile" class="rounded-full w-full mt-2 mb-4 bg-red-200">
                        <form action="" method="post">
                            <label for="nama_depan">Choose Files</label>
                            <input class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="file" id="nama_depan" name="nama_depan" value="">

                            <button type="submit" name="submit" class="float-right py-2 px-4 mt-4 bg-indigo-400 rounded-2xl text-white"><i class="bi bi-pencil-square"></i> Change Profil Picture</button>
                        </form>
                    </div>
                    <div class="flex basis-1/3 bg-white-200 flex-col m-4 p-4 rounded-2xl border-4 border-indigo-400">
                        <h1 class="text-2xl text-slate-700 font-bold mt-2 mb-4"><i class="bi bi-person-fill"></i> Kelola Pengguna</h1>
                        <form action="" method="post">
                            <label for="nama_depan">Nama Depan</label>
                            <input class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="text" id="nama_depan" name="nama_depan" value="">

                            <label for="nama_belakang">Nama Belakang</label>
                            <input class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="text" id="nama_belakang" name="nama_belakang" value="">

                            <label for="alamat">Tanggal Lahir</label>
                            <input class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="date" id="alamat" name="alamat" value="">

                            <label for="email">Email</label>
                            <input class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="text" id="alamat" name="alamat" value="">

                            <label for="alamat">Telepon</label>
                            <input class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="text" id="alamat" name="alamat" value="">

                            <label for="alamat">Alamat</label>
                            <textarea class="w-full px-3 py-2  rounded-lg border-slate-800 border-2" name="alamat" id="alamat" cols="30" rows="2" value="" ></textarea>

                            <button type="submit" name="submit" class="float-right py-2 px-4 mt-4 bg-indigo-400 rounded-2xl text-white"><i class="bi bi-pencil-square"></i> Edit Profil</button>
                        </form>
                    </div>
                    <div class="flex basis-1/3 bg-white-200 flex-col m-4 p-4 rounded-2xl border-4 border-indigo-400 h-1/2">
                        <h1 class="text-2xl text-slate-700 font-bold mt-2 mb-4"><i class="bi bi-lock-fill"></i> Ganti Password</h1>
                        <form action="" method="post">
                            <label for="nama_depan">Username</label>
                            <input disabled class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="text" id="nama_depan" name="nama_depan" value="">

                            <label for="nama_belakang">Password Baru</label>
                            <input class="w-full px-3 py-2 rounded-lg border-slate-800 border-2"  type="password" id="nama_belakang" name="nama_belakang" value="">

                            <button type="submit" name="submit" class="float-right py-2 px-4 mt-4 bg-indigo-400 rounded-2xl text-white"><i class="bi bi-pencil-square"></i> Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>