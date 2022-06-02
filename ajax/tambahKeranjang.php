<?php
    require '../config/functions.php';

    $keyword = $_GET["keyword"];

    $query = "
    SELECT 
        tb_barang.id_barang, 
        tb_kategori.nama_kategori AS 'nama_kategori', 
        tb_barang.nama_barang, 
        tb_barang.merk, 
        tb_barang.harga_jual
    FROM tb_barang 
    INNER JOIN tb_kategori USING(id_kategori)
    WHERE
        tb_barang.id_barang = $keyword;
    ";

    $barang = query($query);
?>
<table class="w-full text-center" cellpadding="10" cellspacing="0">
    <tr class="border-b-2 border-slate-400">
        <th>No</th>
        <th>Kategori</th>
        <th>Nama Barang</th>
        <th>Merk</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>
    
    <?php $i = 1; ?>
    <?php foreach( $barang as $row ) : ?>
    <tr id="<<?= $row["id_barang"]; ?>">
        <td><?= $i; ?></td>
        <td hidden><?= $row["id_barang"]; ?></td>
        <td><?= $row["nama_kategori"]; ?></td>
        <td><?= $row["nama_barang"]; ?></td>
        <td><?= $row["merk"]; ?></td>
        <td><?= $row["harga_jual"] + 0; ?></td>
        <td class="tambah-item">
            <i class="bi bi-cart-plus bg-green-500 p-2 text-white rounded-md font-bold"></i>
        </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
</table>
<script src="../assets/js/search.js"></script>