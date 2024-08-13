<?php
include 'koneksi.php';

// Mendapatkan ID transaksi terakhir
$query = mysqli_query($conn, "SELECT id_transaksi FROM transaksi ORDER BY id_transaksi DESC LIMIT 1");
$data = mysqli_fetch_array($query);

if ($data) {
    $lastId = $data['id_transaksi'];
    $newId = 'TRX' . sprintf('%04d', substr($lastId, 3) + 1);
} else {
    $newId = 'TRX0001'; // ID pertama jika belum ada transaksi sebelumnya
}

$barang = mysqli_query($conn, "SELECT * FROM barang");
$jsArray = "var hargabrg = new Array();";
$jsArray1 = "var namabrg = new Array();";  
$jsArray2 = "var stokbrg = new Array();";
function rupiah($angka){
    $hasil_rp= "Rp " . number_format($angka,2,',','.');
    return $hasil_rp;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="style.css">
    <style>
        .form-group{
            margin:10px;
        }
        label{
            margin-right:1px;
        }
        thead,th,td{
            border: 4px solid #000;
        }
        table{
            border-collapse: collapse;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
    <h1>TOKO SINAR JAYA</h1>
    <a href="index.php">
        <button type="button">Home</button>
    </a>
</header>

    <main>
    <form class="transaksi" method="POST" action="action-trans.php">
    <div class="form-group">
        <label class=""><b>Id Transaksi</b></label>
        <input type="text" style="width: auto;" class="" name="id" value="<?php echo $newId; ?>" readonly>
    </div>
    <div class="form-group">
        <label class=""><b>Tgl. Transaksi</b></label>
        <input type="text" style="width: auto;" class="" name="tgl_input" value="<?php echo date("Y-m-j G:i:s");?>" readonly>
    </div>
    <div class="form-group">
        <label class=""><b>Kode Barang</b> </label>
        <input type="text" name="kode_barang" class="" list="datalist1" id="kode_barang" aria-describedby="basic-addon2" required>
        <datalist id="datalist1">
        <?php 
            if(mysqli_num_rows($barang)) {
            while($row_brg = mysqli_fetch_array($barang)) {?>
            <option value="<?php echo $row_brg["kd_barang"]?>"> <?php echo $row_brg["kd_barang"]?>
            <?php 
                $jsArray .= "hargabrg['" . $row_brg['kd_barang'] . "'] = '" . addslashes($row_brg['hargabrg']) . "';";
                $jsArray1 .= "namabrg['" . $row_brg['kd_barang'] . "'] = '" . addslashes($row_brg['namabrg']) . "';"; 
                $jsArray2 .= "stokbrg['" . $row_brg['kd_barang'] . "'] = '" . addslashes($row_brg['stokbrg']) . "';"; 
            } ?>
            <?php } ?>
        </datalist>
        <button type="button" onclick="searchItem()">Cari</button>
    </div>
    <div class="form-group">
        <label class=""><b>Nama Barang</b></label>
        <input type="text" class="" name="namabrg" id="namabrg" readonly> 
    </div>
    <div class="form-group">
        <label class=""><b>Harga</b></label>
        <input type="text" class="" id="hargabrg" name="hargabrg" readonly>
    </div>
    <div class="form-group">
        <label class=""><b>Stok Barang</b></label>
        <input type="number" class="" id="stokbrg" name="stokbrg" readonly>
    </div>
    <div class="form-group">
        <label class=""><b>Quantity</b></label>
        <input type="number" class="" id="quantity" onchange="total()" name="quantity" placeholder="0" required>
    </div>    
    <div class="form-group">
        <label class=""><b>Sub-Total</b></label>
        <input type="text" class="" id="subtotal" name="subtotal" readonly>
    </div>
    <div class="">
        <button class="" name="save" value="simpan" type="submit">Tambah</button>
    </div>
    </form>
    </main>
    </main>


</a>
<br>
    <br>
<footer>
<table id="brg" style="width:100%">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th>No Transaksi</th>
            <th>Tanggal Transaksi</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga Barang</th>
            <th>Stok Barang</th>
            <th>Jumlah Beli</th>
            <th>Total Bayar</th>
            <th>Aksi</th>
            </tr>
       </thead>
       <tbody>
        <?php
            $select = mysqli_query($conn, "SELECT * FROM transaksi INNER JOIN barang on transaksi.kd_barang=barang.kd_barang");
            $no=1;
            while($data = mysqli_fetch_array($select)){
            ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $data['id_transaksi'] ?></td>
                <td><?php echo $data['tgltransaksi'] ?></td>
                <td><?php echo $data['kd_barang'] ?></td>
                <td><?php echo $data['namabrg'] ?></td>
                <td><?php echo rupiah($data['hargabrg']) ?></td>
                <td><?php echo $data['stokbrg'] ?></td>
                <td><?php echo $data['jmlbeli'] ?></td>
                <td><?php echo rupiah($data['totalbayar']) ?></td>
                <td class="text-center">
                <a href="print.php?id_transaksi=<?php echo $data['id_transaksi']; ?>" class="btn-2">Cetak</a> ||
                <a href="hapus-trans.php?id_transaksi=<?php echo $data['id_transaksi']; ?>" class="btn-2" onclick="return confirmDelete()">Delete</a>
                </td>
            </tr>   
            <?php } ?>
        </tbody>
    </table>
</footer>

<script type="text/javascript">
    function confirmDelete() {
        return confirm("Apakah Anda yakin ingin menghapus data ini?");
    }
</script>

<script type="text/javascript">
    <?php echo $jsArray; ?>
    <?php echo $jsArray1; ?>
    <?php echo $jsArray2; ?>

    function changeValue(kd_barang) {
        var harga = parseFloat(hargabrg[kd_barang]);
        document.getElementById("namabrg").value = namabrg[kd_barang];
        document.getElementById("hargabrg").value = formatRupiah(harga.toFixed(2).replace('.', ','), 'Rp. ');
        document.getElementById("stokbrg").value = stokbrg[kd_barang];
    }

    function searchItem() {
        var kd_barang = document.getElementById("kode_barang").value;
        changeValue(kd_barang);
    }

    function total() {
        var harga = parseFloat(document.getElementById('hargabrg').value.replace(/[^,\d]/g, '').replace(',', '.'));
        var jumlah_beli = parseInt(document.getElementById('quantity').value);
        var jumlah_harga = harga * jumlah_beli;
        document.getElementById('subtotal').value = formatRupiah(jumlah_harga.toFixed(2).replace('.', ','), 'Rp. ');
    }

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function total() {
    var harga = parseFloat(document.getElementById('hargabrg').value.replace(/[^,\d]/g, '').replace(',', '.'));
    var jumlah_beli = parseInt(document.getElementById('quantity').value);
    var stok_barang = parseInt(document.getElementById('stokbrg').value);

    // Cek jika jumlah_beli kurang dari 0, atur menjadi 0
    if (jumlah_beli < 0) {
        alert("Jumlah tidak bisa kurang dari 0!");
        document.getElementById('quantity').value = 0;
        jumlah_beli = 0;
    }

    if (jumlah_beli > stok_barang) {
        alert("Stok barang tidak mencukupi!");
        document.getElementById('quantity').value = stok_barang; // Mengatur jumlah beli menjadi stok maksimal
        jumlah_beli = stok_barang; // Menyesuaikan jumlah beli dengan stok maksimal
    }

    var jumlah_harga = harga * jumlah_beli;
    document.getElementById('subtotal').value = formatRupiah(jumlah_harga.toFixed(2).replace('.', ','), 'Rp. ');
}
</script>
</body>
</html>
