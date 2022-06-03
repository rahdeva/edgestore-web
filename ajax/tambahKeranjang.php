<?php
    require '../config/functions.php';

    // if( isset($_POST["total"]) ) {
    //     $total = ;
    // }

    $banyak_id = $_GET["items"];
    $banyak_item = $_GET["length"];
    $items_id = array();
    $temp = "";

    // echo $banyak_id;
    // $jumlah = 1;
    // $total = 100000;

    for ($i = 0; $i < strlen($banyak_id); $i++) {
        
        if($banyak_id[$i] != ",")
            $temp .= "$banyak_id[$i]";
        else{
            array_push($items_id, $temp);
            $temp = "";
        }
    }

    // print_r($items_id);
    
    $select_query = "
        SELECT 
            tb_barang.id_barang, 
            tb_barang.nama_barang, 
            tb_barang.merk,
            tb_barang.harga_jual,
            tb_barang.stok
        FROM tb_barang 
        WHERE
            tb_barang.id_barang IN ($items_id[0]
        ";
    
    if($banyak_item > 1){
        for($i = 1; $i < $banyak_item; $i++){
            $select_query = $select_query .= " ,$items_id[$i]";
        }
    }

    $select_query = $select_query .= ")";
    // var_dump($select_query);

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
    </tr>
    
    <?php $i = 1; ?>
    <?php foreach( $addKeranjang as $row ) : ?>
    <tr>
        <td><?= $i; ?></td>
        <td><?= $row["nama_barang"]; ?></td>
        <td><?= $row["merk"]; ?></td>
        <td>
            <form action="" method="post">
                <?php $total = $row["harga_jual"] * 1; ?> 
                <select name="total" onchange="this.form.submit()" class="border-2 border-slate-600 p-2 rounded-lg">
                <?php for($i = 0; $i < $row["stok"]; $i++){ ?>
                    <option value="<?= $i + 1 ?>"><?= $i + 1 ?></option>
                <?php } ?>
                </select>
            </form>
        </td>
        <td><?= $total; ?></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
</table>