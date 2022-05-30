<?php
    require 'functions.php';

    $id = $_GET['id'];

    if($id == "")
        header("location:../barang.php?status=invalid");

    $delete_sql = mysqli_query($connect, "DELETE FROM tb_barang WHERE id_barang='$id'");

    if($delete_sql)
        alert("hapus", true, '../barang.php');
    else
        alert("hapus", false, '../barang.php');
?>