<?php

// koneksi ke database
$connect = mysqli_connect("localhost", "root", "", "edge-store-db");

// fungsi query
function query($query) {
	global $connect;
	$result = mysqli_query($connect, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

// Fungsi Alert
function alert($key, $bool, $loc){
    if($bool){
        echo "
            <script>
                alert('Data berhasil di$key!');
                document.location.href = '$loc';
            </script>
        ";
    }
    else{
        echo "
            <script>
                alert('Data gagal di$key!');
                document.location.href = '$loc';
            </script>
        ";
    }
}

// fungsi insert
function insertBarang($data) {
	global $connect;

	$kategori = htmlspecialchars($data["id_kategori"]);
	$nama = htmlspecialchars($data["nama_barang"]);
	$merk = htmlspecialchars($data["merk"]);
	$stok = htmlspecialchars($data["stok"]);
	$harga_beli = htmlspecialchars($data["harga_beli"]);
	$harga_jual = htmlspecialchars($data["harga_jual"]);
	$kedaluwarsa = htmlspecialchars($data["kedaluwarsa"]);

	$query ="
                INSERT INTO tb_barang
                VALUES ('', '$kategori', '$nama', '$merk', '$stok', '$harga_beli', '$harga_jual', '$kedaluwarsa')
			";
	mysqli_query($connect, $query);

	return mysqli_affected_rows($connect);
}

// fungsi delete
function deleteBarang($data) {
	global $connect;

    $id = htmlspecialchars($data["id_barang"]);
	mysqli_query($connect, "DELETE FROM tb_barang WHERE id_barang = $id");
	return mysqli_affected_rows($connect);
}

function editBarang($data) {
	global $connect;

    $id = htmlspecialchars($data["id_barang"]);
	$kategori = htmlspecialchars($data["id_kategori"]);
	$nama = htmlspecialchars($data["nama_barang"]);
	$merk = htmlspecialchars($data["merk"]);
	$stok = htmlspecialchars($data["stok"]);
	$harga_beli = htmlspecialchars($data["harga_beli"]);
	$harga_jual = htmlspecialchars($data["harga_jual"]);
	$kedaluwarsa = htmlspecialchars($data["kedaluwarsa"]);
	
	$query ="   UPDATE tb_barang 
                SET
                    id_kategori = '$kategori',
                    nama_barang = '$nama',
                    merk = '$merk',
                    stok = '$stok',
                    harga_beli = '$harga_beli',
                    harga_jual = '$harga_jual',
                    kedaluwarsa = '$kedaluwarsa'
                WHERE id_barang = $id
			";

	mysqli_query($connect, $query);

	return mysqli_affected_rows($connect);	
}

function insertKategori($data) {
	global $connect;

	$nama = htmlspecialchars($data["nama_kategori"]);
	$deskripsi = htmlspecialchars($data["deskripsi"]);

	$query ="
                INSERT INTO tb_kategori
                VALUES ('', '$nama', '$deskripsi')
			";
	mysqli_query($connect, $query);

	return mysqli_affected_rows($connect);
}

function count_table($query){
	global $connect;
	$row = mysqli_query($connect, $query);
	$result = mysqli_fetch_array($row);
	return $result;
}

$totalbarang = count_table("SELECT COUNT(id_barang) AS 'Jumlah Barang' FROM tb_barang");
$totalkategori = count_table("SELECT COUNT(id_kategori) 'Jumlah Kategori' FROM tb_kategori");
$totaltransaksi = count_table("SELECT COUNT(id_transaksi) 'Jumlah Transaksi' FROM tb_transaksi");

function regis($data){
    global $connect;

    $nama_depan = (stripslashes($data['nama_depan']));
    $nama_belakang = (stripslashes($data['nama_belakang']));
    $alamat = (stripslashes($data['alamat']));
    $tanggal_lahir = $data['tanggal_lahir'];
    $telepon = $data['telepon'];
    $email = strtolower(stripslashes($data['email']));
    $username = strtolower(stripslashes($data['username']));
    $pass = mysqli_real_escape_string($connect, $data['pass']);
	$gambar = 'assets/images/user-images/default.png';

    //cek username sudah ada tau belum
    $result = mysqli_query($connect, "SELECT username FROM tb_user WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)){
        echo "
			<script>
                alert('Username sudah terdaftar');
			</script>
		";
        return false;
    }

    //ekripsi pass

    //tambahakan user baru ke database
    $queryProfil = "INSERT INTO tb_profil VALUES('', '$nama_depan', '$nama_belakang', '$alamat', '$tanggal_lahir', '$email', '$telepon', '$gambar')";
    mysqli_query($connect, $queryProfil);
	$queryUser = "INSERT INTO tb_user VALUES('', '$username', '$pass')";
	mysqli_query($connect, $queryUser);
    return mysqli_affected_rows($connect);
}

function get_username($username){
	global $connect;
	$query_username = "SELECT CONCAT(nama_depan, ' ', nama_belakang) FROM tb_profil INNER JOIN tb_user ON tb_profil.id_profil = tb_user.id WHERE username = '$username';";
	$row = mysqli_query($connect, $query_username);
	$result = mysqli_fetch_array($row);
	return $result[0];
}

function get_photos($username){
	global $connect;
	$query_username = "SELECT gambar FROM tb_profil INNER JOIN tb_user ON tb_profil.id_profil = tb_user.id WHERE username = '$username';";
	$row = mysqli_query($connect, $query_username);
	$result = mysqli_fetch_array($row);
	return $result[0];
}

// function upload() {

// 	$namaFile = $_FILES['gambar']['name'];
// 	$ukuranFile = $_FILES['gambar']['size'];
// 	$error = $_FILES['gambar']['error'];
// 	$tmpName = $_FILES['gambar']['tmp_name'];

// 	// cek apakah tidak ada gambar yang diupload
// 	if( $error === 4 ) {
// 		echo "<script>
// 				alert('pilih gambar terlebih dahulu!');
// 			  </script>";
// 		return false;
// 	}

// 	// cek apakah yang diupload adalah gambar
// 	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
// 	$ekstensiGambar = explode('.', $namaFile);
// 	$ekstensiGambar = strtolower(end($ekstensiGambar));
// 	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
// 		echo "<script>
// 				alert('yang anda upload bukan gambar!');
// 			  </script>";
// 		return false;
// 	}

// 	// cek jika ukurannya terlalu besar
// 	if( $ukuranFile > 1000000 ) {
// 		echo "<script>
// 				alert('ukuran gambar terlalu besar!');
// 			  </script>";
// 		return false;
// 	}

// 	// lolos pengecekan, gambar siap diupload
// 	// generate nama gambar baru
// 	$namaFileBaru = uniqid();
// 	$namaFileBaru .= '.';
// 	$namaFileBaru .= $ekstensiGambar;

// 	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

// 	return $namaFileBaru;
// }


function filter($data) {
	$filter = htmlspecialchars($data["filter"]);
	$defaultQuery = "
		SELECT 
			tb_barang.id_barang, 
			tb_kategori.nama_kategori AS 'nama_kategori', 
			tb_barang.nama_barang, 
			tb_barang.merk, 
			tb_barang.stok, 
			tb_barang.harga_beli, 
			tb_barang.harga_jual, 
			tb_barang.kedaluwarsa 
		FROM tb_barang 
		INNER JOIN tb_kategori USING(id_kategori) 
	";
	
	switch ($filter) {
		case '1':
			$filter = ($defaultQuery .= "WHERE NOT stok = 0");
			break;
		case '2':
			$filter = ($defaultQuery .= "ORDER BY nama_barang");
			break;
		case '3':
			$filter = ($defaultQuery .= "ORDER BY nama_barang DESC");
			break;
		case '4':
			$filter = ($defaultQuery .= "ORDER BY merk");
			break;
		case '5':
			$filter = ($defaultQuery .= "ORDER BY merk DESC");
			break;
		case '6':
			$filter = ($defaultQuery .= "ORDER BY stok");
			break;
		case '7':
			$filter = ($defaultQuery .= "ORDER BY stok DESC");
			break;
		case '8':
			$filter = ($defaultQuery .= "ORDER BY harga_beli");
			break;
		case '9':
			$filter = ($defaultQuery .= "ORDER BY harga_beli DESC");
			break;
		case '10':
			$filter = ($defaultQuery .= "ORDER BY harga_jual");
			break;
		case '11':
			$filter = ($defaultQuery .= "ORDER BY harga_jual DESC");
			break;
	}

	return query($filter);
}

function laporanBulanan($data) {
	$tahun = htmlspecialchars($data["tahun"]); 
	$bulan = htmlspecialchars($data["bulan"]);
	$days = cal_days_in_month(CAL_GREGORIAN,$bulan,$tahun);
	$defaultQuery = "
		SELECT tb_transaksi.id_barang, 
			tb_barang.nama_barang, 
			tb_transaksi.jumlah, 
			tb_barang.harga_beli * tb_transaksi.jumlah AS 'modal', 
			tb_barang.harga_jual * tb_transaksi.jumlah AS 'total', 
			tb_transaksi.kasir, 
			tb_transaksi.waktu_input
		FROM tb_transaksi 
		INNER JOIN tb_barang USING(id_barang) 
	";

	$laporanBulan = (
		$defaultQuery .= "
			WHERE tb_transaksi.waktu_input BETWEEN '$tahun-$bulan-01 00:00:00' AND '$tahun-$bulan-$days 23.59.59'
		"
	);

	return query($laporanBulan);
}

function laporanTanggal($data) {
	$tahun = htmlspecialchars($data["tahun"]); 
	$bulan = htmlspecialchars($data["bulan"]);
	$tanggal = htmlspecialchars($data["tanggal"]);
	$defaultQuery = "
		SELECT tb_transaksi.id_barang, 
			tb_barang.nama_barang, 
			tb_transaksi.jumlah, 
			tb_barang.harga_beli * tb_transaksi.jumlah AS 'modal', 
			tb_barang.harga_jual * tb_transaksi.jumlah AS 'total', 
			tb_transaksi.kasir, 
			tb_transaksi.waktu_input
		FROM tb_transaksi 
		INNER JOIN tb_barang USING(id_barang) 
	";

	$laporanTanggal = (
		$defaultQuery .= "
			WHERE tb_transaksi.waktu_input BETWEEN '$tahun-$bulan-$tanggal 00:00:00' AND '$tahun-$bulan-$tanggal 23.59.59'
		"
	);

	return query($laporanTanggal);
}


// function upload() {

// 	$namaFile = $_FILES['gambar']['name'];
// 	$ukuranFile = $_FILES['gambar']['size'];
// 	$error = $_FILES['gambar']['error'];
// 	$tmpName = $_FILES['gambar']['tmp_name'];

// 	// cek apakah tidak ada gambar yang diupload
// 	if( $error === 4 ) {
// 		echo "<script>
// 				alert('pilih gambar terlebih dahulu!');
// 			  </script>";
// 		return false;
// 	}

// 	// cek apakah yang diupload adalah gambar
// 	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
// 	$ekstensiGambar = explode('.', $namaFile);
// 	$ekstensiGambar = strtolower(end($ekstensiGambar));
// 	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
// 		echo "<script>
// 				alert('yang anda upload bukan gambar!');
// 			  </script>";
// 		return false;
// 	}

// 	// cek jika ukurannya terlalu besar
// 	if( $ukuranFile > 1000000 ) {
// 		echo "<script>
// 				alert('ukuran gambar terlalu besar!');
// 			  </script>";
// 		return false;
// 	}

// 	// lolos pengecekan, gambar siap diupload
// 	// generate nama gambar baru
// 	$namaFileBaru = uniqid();
// 	$namaFileBaru .= '.';
// 	$namaFileBaru .= $ekstensiGambar;

// 	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

// 	return $namaFileBaru;
// }

// function registrasi($data) {
// 	global $connect;

// 	$username = strtolower(stripslashes($data["username"]));
// 	$password = mysqli_real_escape_string($connect, $data["password"]);
// 	$password2 = mysqli_real_escape_string($connect, $data["password2"]);

// 	// cek username sudah ada atau belum
// 	$result = mysqli_query($connect, "SELECT username FROM user WHERE username = '$username'");

// 	if( mysqli_fetch_assoc($result) ) {
// 		echo "<script>
// 				alert('username sudah terdaftar!')
// 		      </script>";
// 		return false;
// 	}


// 	// cek konfirmasi password
// 	if( $password !== $password2 ) {
// 		echo "<script>
// 				alert('konfirmasi password tidak sesuai!');
// 		      </script>";
// 		return false;
// 	}

// 	// enkripsi password
// 	$password = password_hash($password, PASSWORD_DEFAULT);

// 	// tambahkan userbaru ke database
// 	mysqli_query($connect, "INSERT INTO user VALUES('', '$username', '$password')");

// 	return mysqli_affected_rows($connect);

// }

?>