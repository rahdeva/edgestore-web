<?php
    require 'connect.php';

    function count_table($query){
        global $connect;
        $row = mysqli_query($connect, $query);
        $result = mysqli_fetch_array($row);
        return $result;
    }

    $totalbarang = count_table("SELECT COUNT(id_barang) AS 'Jumlah Barang' FROM tb_barang");
    $totalkategori = count_table("SELECT COUNT(id_kategori) 'Jumlah Kategori' FROM tb_kategori");
    $totaltransaksi = count_table("SELECT COUNT(id_transaksi) 'Jumlah Transaksi' FROM tb_transaksi");
?>
