<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kodeBarang = $_POST['kdbrg'];
    $namaBarang = $_POST['nmbrg'];
    $hargaBarang = $_POST['hrgbrg'];
    $stokBarang = $_POST['stokbrg'];

    $insert = "INSERT INTO barang (kdbrg, nmbrg, hrgbrg, stokbrg) VALUES ('$kodeBarang', '$namaBarang', '$hargaBarang', '$stokBarang')";
    if ($conn->query($insert) === TRUE) {
        header("location:barang.php");
        echo "Barang berhasil ditambahkan.";
    } else {
        echo "Error: " . $insert . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
</head>
<body>
    <header>
    <h1>Tambah Barang</h1>
    </header>
    <main>
    <form method="post" action="">
    <div class="form-group">
        <label for="kdbrg">Kode Barang:</label>
        <input type="text" name="kdbrg" required><br>
    </div>
    <div class="form-group">
        <label for="nmbrg">Nama Barang:</label>
        <input type="text" name="nmbrg" required><br>
    </div>
    <div class="form-group">
        <label for="hrgbrg">Harga Barang:</label>
        <input type="text" name="hrgbrg" required><br>
    </div>
    <div class="form-group">
        <label for="stokbrg">Stok Barang:</label>
        <input type="text" name="stokbrg" required><br>
    </div>    
        <input type="submit" value="Tambahkan Barang">
    </form>
    </main>
    <footer>
    
    </footer>
</div>    
</body>
</html>
