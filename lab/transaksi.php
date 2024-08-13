<?php
include 'config.php';

function getProductDetails($kdbrg) {
    global $conn;
    $query = "SELECT nmbrg, hrgbrg, stokbrg FROM barang WHERE kdbrg = '$kdbrg'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idtrans = $_POST['idtrans'];
    $tgltrans = $_POST['tgltrans'];
    $kdbrg = $_POST['kdbrg'];
    $jmlbeli = $_POST['jmlbeli'];

    $productDetails = getProductDetails($kdbrg);

    $nmbrg = $productDetails['nmbrg'];
    $hrgbrg = $productDetails['hrgbrg'];
    $stokbrg = $productDetails['stokbrg'];

    $totalharga = $hrgbrg * $jmlbeli;

    $insertQuery = "INSERT INTO transaksi (idtrans, tgltrans, kdbrg, jmlbeli, totalharga)
                    VALUES ('$idtrans', '$tgltrans', '$kdbrg', '$jmlbeli', '$totalharga')";

    $stokbaru = $stokbrg - $jmlbeli;

    $updateStokQuery = "UPDATE barang SET stokbrg = '$stokbaru' WHERE kdbrg = '$kdbrg'";
    mysqli_query($conn, $updateStokQuery);
    mysqli_query($conn, $insertQuery);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Transaksi</title>
</head>
<body>
    <h1>Halaman Transaksi</h1>
    <form method="post" action="">
        <label for="idtrans">ID Transaksi:</label>
        <input type="text" name="idtrans" required><br>

        <label for="tgltrans">Tanggal Transaksi:</label>
        <input type="text" name="tgltrans" value="<?php date_default_timezone_set("Asia/Bangkok"); echo date("Y-m-d H:i:s");?>" required><br>

        <label for="kdbrg">Kode Barang:</label>
        <input type="text" name="kdbrg" id="kdbrg" required>
        <button type="button" onclick="fetchProductDetails()">Cari</button><br>

        <label for="nmbrg">Nama Barang:</label>
        <input type="text" name="nmbrg" id="nmbrg" readonly><br>

        <label for="hrgbrg">Harga Barang:</label>
        <input type="text" name="hrgbrg" id="hrgbrg" readonly><br>

        <label for="stokbrg">Stok Barang:</label>
        <input type="text" name="stokbrg" id="stokbrg" readonly><br>

        <label for="jmlbeli">Jumlah Beli:</label>
        <input type="number" name="jmlbeli" id="jmlbeli" min="1" required><br>

        <label for="totalharga">Total Harga:</label>
        <input type="text" name="totalharga" id="totalharga" readonly><br>
<br>
        <button type="submit">Simpan Transaksi</button>
    </form>
<br>
    <table border="2" id="brg" style="width:100%">
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
            $select = mysqli_query($conn, "SELECT * FROM transaksi INNER JOIN barang on transaksi.kdbrg=barang.kdbrg");
            $no=1;
            while($data = mysqli_fetch_array($select)){
            ?>
            <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data['idtrans'] ?></td>
            <td><?php echo $data['tgltrans'] ?></td>
            <td><?php echo $data['kdbrg'] ?></td>
            <td><?php echo $data['nmbrg'] ?></td>
            <td><?php echo $data['hrgbrg'] ?></td>
            <td><?php echo $data['stokbrg'] ?></td>
            <td><?php echo $data['jmlbeli'] ?></td>
            <td><?php echo $data['totalharga'] ?></td>
            <td class="text-center">
            <a  href="print.php?idtrans=<?php echo $data['idtrans']?>" class="btn-2">Cetak</a> |
            <a href="deletetransaksi.php?idtrans=<?php echo $data['idtrans']?>" class="text-center">Delete</a>
            </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <script>
        function fetchProductDetails() {
            const kdbrg = document.getElementById("kdbrg").value;
            if (kdbrg !== "") {
                fetch(`detailbarang.php?kdbrg=${kdbrg}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById("nmbrg").value = data.nmbrg;
                        document.getElementById("hrgbrg").value = data.hrgbrg;
                        document.getElementById("stokbrg").value = data.stokbrg;
                        calculateTotalHarga();
                    })
                    .catch(error => {
                        console.error("Error fetching product details:", error);
                    });
            }
        }
        function updateProductDetails(kdbrg) {
        const details = productDetails[kdbrg];

        if (details) {
         document.getElementById("nmbrg").value = details.nmbrg;
         document.getElementById("hrgbrg").value = details.hrgbrg;
         document.getElementById("stokbrg").value = details.stokbrg;
    }
}


        function calculateTotalHarga() {
            const hrgbrg = parseFloat(document.getElementById("hrgbrg").value);
            const jmlbeli = parseInt(document.getElementById("jmlbeli").value);
            const totalharga = hrgbrg * jmlbeli;
            document.getElementById("totalharga").value = totalharga;
        }
    </script>
</body>
</html>
