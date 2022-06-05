<?php
    session_start();

    require '../config/functions.php';

    $jumlahPerBarang = $_GET["jumlahPerBarang"];
    $totalPerBarang = $_GET["totalPerBarang"];
    $totalBelanja = $_GET["totalBelanja"];
    $semuaId = $_GET["idEachItem"];

    $jumlahBarangArray = array();
    $totalBarangArray = array();
    $idItemsArray = array();
    $temp = "";

    // Memasukkan karakter selain koma di dalam string ke dalam array

    for ($i = 0; $i < strlen($jumlahPerBarang); $i++) {
        if($jumlahPerBarang[$i] != ",")
            $temp .= "$jumlahPerBarang[$i]";
        else{
            array_push($jumlahBarangArray, $temp);
            $temp = "";
        }
    }

    for ($i = 0; $i < strlen($totalPerBarang); $i++) {
        if($totalPerBarang[$i] != ",")
            $temp .= "$totalPerBarang[$i]";
        else{
            array_push($totalBarangArray, $temp);
            $temp = "";
        }
    }

    for ($i = 0; $i < strlen($semuaId); $i++) {
        if($semuaId[$i] != ",")
            $temp .= "$semuaId[$i]";
        else{
            array_push($idItemsArray, $temp);
            $temp = "";
        }
    }

    $transaksi_query = "
    INSERT INTO tb_transaksi(id_barang, jumlah, total, kasir) VALUES ";

    $value_each_row = "";
    $username = get_username($_SESSION["username"]);
    for($i = 0; $i < $totalBelanja; $i++){
        $value_each_row .= "($idItemsArray[$i], $jumlahBarangArray[$i], $totalBarangArray[$i], '$username')";
        if($i < $totalBelanja - 1)
            $value_each_row .= ",";
    }

    $transaksi_query .= $value_each_row;

    mysqli_query($connect, $transaksi_query);

    // echo " 
    //         <script>
    //             console.log(0);
    //             alert('Transaksi berhasil dilakukan!');
    //             document.location.href = '../transaksi.php';
    //         </script>
    //     ";

    // var_dump(mysqli_affected_rows($connect));

    // if( mysqli_affected_rows($connect) > 0 ){
    //     alert("tambah", true, 'barang.php');
    //     echo "
    //         <script>
    //             alert('Transaksi berhasil dilakukan!');
    //             document.location.href = '../transaksi.php';
    //         </script>
    //     ";
    // }
    // else{
    //     echo "
    //         <script>
    //             alert('Transaksi gagal!');
    //             document.location.href = '../transaksi.php';
    //         </script>
    //     ";
    // }

?>

<!-- <?php for($i = 0; $i < $totalBelanja; $i++){ ?>
    <p><?= $jumlahBarangArray[$i]; ?></p>
    <p><?= $totalBarangArray[$i]; ?></p>
    <p><?= $idItemsArray[$i]; ?></p>
<?php } ?>

<p><?= $transkasi_query; ?></p> -->