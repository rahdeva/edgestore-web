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

// fungsi insert
function insert($data) {
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
function delete($data) {
	global $connect;

    $id = htmlspecialchars($data["id_barang"]);
	mysqli_query($connect, "DELETE FROM tb_barang WHERE id_barang = $id");
	return mysqli_affected_rows($connect);
}

function edit($data) {
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
                    kategori = '$kategori',
                    nama = '$nama',
                    merk = '$merk',
                    stok = '$stok',
                    harga_beli = '$harga_beli',
                    harga_jual = '$harga_jual',
                    kedaluwarsa = '$kedaluwarsa'
                WHERE id = $id
			";

	mysqli_query($connect, $query);

	return mysqli_affected_rows($connect);	
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


// function cari($keyword) {
// 	$query = "SELECT * FROM mahasiswa
// 				WHERE
// 			  nama LIKE '%$keyword%' OR
// 			  nrp LIKE '%$keyword%' OR
// 			  email LIKE '%$keyword%' OR
// 			  jurusan LIKE '%$keyword%'
// 			";
// 	return query($query);
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




?>