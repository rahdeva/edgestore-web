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
        <th>Hapus</th>
    </tr>
    <?php $no = 1; ?>
    <?php foreach( $addKeranjang as $row ) : ?>
    <tr>
        <td><?= $no; ?></td>
        <td><?= $row["nama_barang"]; ?></td>
        <td><?= $row["merk"]; ?></td>
        <td>
            <select id="<?= $no; ?>" name="" onchange="changeTotal(<?= $no; ?>, <?= $row['harga_jual']; ?>)" class="border-2 border-slate-600 p-2 rounded-lg jumlah-per-barang">
                <option selected="selected">0</option>
            <?php for($i = 0; $i < $row["stok"]; $i++){ ?>
                <option value="<?= $i + 1 ?>"><?= $i + 1 ?></option>
            <?php } ?>
            </select>
        </td>
        <td id="total<?= $no; ?>" class="total-per-barang">0</td>
        <!-- <script>sumAllTotal();</script> -->
        <td onclick="addKeranjang(<?= $row['id_barang']; ?>, 2);" class="pointer text-center"><p class="bg-red-400 rounded-md py-1 px-2 text-white">Hapus</p></td>
    </tr>
    <?php $no++; ?>
    <?php endforeach; ?>
</table>
<div>
    <hr class="my-4 w-full", size="3", color=black>  
    <label for="total" class="mr-4">Total Semua</label>
    <input disabled class="w-1/3 px-3 py-2 rounded-lg border-slate-800 border-2 mr-4"  type="number" name="total" value="0" id="total-belanja">

    <label for="bayar" class="mr-4">Bayar</label>
    <input class="w-1/3 px-3 py-2 rounded-lg border-slate-800 border-2"  type="number" id="bayar" name="bayar" value="0" oninput="hitungKembalian();">

    <hr class="my-4 w-full" size="3" color=black>  

    <label for="kembali" class="mt-4 mr-12">Kembali</label>
    <input disabled class="w-1/3 px-3 py-2 rounded-lg border-slate-800 border-2"  type="number" id="kembali" name="kembali" value="0">

    <a href="" id="submit-pembayaran" class="float-right py-2 px-4 mt-4 bg-indigo-400 rounded-2xl text-white hidden" onclick="addTransaksi('<?= $banyak_item; ?>', '<?= $banyak_id; ?>');"><i class="bi bi-pencil-square"></i> Bayar</a>
</div>