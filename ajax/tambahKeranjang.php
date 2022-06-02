<?php
    require '../config/functions.php';

    $item_id = $_GET["item"];

    $jumlah = 1;
    $total = 100000;
    $select_query = "
        SELECT 
            tb_barang.id_barang, 
            tb_barang.nama_barang, 
            tb_barang.merk,
            tb_barang.harga_jual
        FROM tb_barang 
        WHERE
            tb_barang.id_barang = $item_id;
        ";
    
    // $insert_query = "INSERT INTO tb_transaksi(id_barang, jumlah, total, kasir) VALUES ('$item_id','$jumlah','$total','$kasir')";
    $addKeranjang = query($select_query);
?>

<table class="w-full text-center" cellpadding="10" cellspacing="0">
    <tr class="border-b-2 border-slate-400">
        <th>No</th>
        <th>Nama Barang</th>
        <th>Merk</th>
        <th>Jumlah</th>
        <th>Total</th>
        <th>Aksi</th>
    </tr>
    
    <?php $i = 1; ?>
    <?php foreach( $addKeranjang as $row ) : ?>
    <tr>
        <td><?= $i; ?></td>
        <td><?= $row["nama_barang"]; ?></td>
        <td><?= $row["merk"]; ?></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
</table>