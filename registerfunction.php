<?php 
$koneksi=mysqli_connect("localhost","root","","register");


function regis($data){
    global $koneksi;

    $nama_depan=strtolower(stripslashes($data['nama_depan']));
    $nama_belakang=strtolower(stripslashes($data['nama_belakang']));
    $asal=strtolower(stripslashes($data['asal']));
    $tanggal_lahir=$data['tanggal_lahir'];
    $telepon=$data['telepon'];
    $email=strtolower(stripslashes($data['email']));
    $username=strtolower(stripslashes($data['username']));
    $pass=mysqli_real_escape_string($koneksi,$data['pass']);

    //cek username sudah ada tau belum
    /*$result=mysqli_query($koneksi,"SELECT username FROM register_user WHERE username='$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('username sudah terdaftar');
        </script>";

        return false;
    }*/

    //ekripsi pass
   

    //tambahakan user baru ke database
    $query="INSERT INTO register_user 
    VALUES('','$nama_depan','$nama_belakang','$asal','$tanggal_lahir','$telepon','$email','$username','$pass')";
    mysqli_query($koneksi,$query);
    return mysqli_affected_rows($koneksi);

}
?>