<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kodeBarang = $_POST['kdbrg'];
    $namaBarang = $_POST['nmbrg'];
    $hargaBarang = $_POST['hrgbrg'];
    $stokBarang = $_POST['stokbrg'];

    $update = "UPDATE barang SET nmbrg='$namaBarang', hrgbrg='$hargaBarang', stokbrg='$stokBarang' WHERE kdbrg='$kodeBarang'";
    if ($conn->query($update) === TRUE) {
        echo "Data barang berhasil diperbarui.";
        header("location:barang.php");
    } else {
        echo "Error: " . $update . "<br>" . $conn->error;
    }
}

if (isset($_GET['kdbrg'])) {
    $kodeBarang = $_GET['kdbrg'];
    $select = mysqli_query($conn, "SELECT * FROM barang WHERE kdbrg='$kodeBarang'");
    $data = mysqli_fetch_array($select);
} else {
    header("Location: index.php"); // Redirect jika parameter kdbrg tidak ada
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
</head>
<body>
    <h1>Edit Barang</h1>
    <form method="post" action="">
        <input type="hidden" name="kdbrg" value="<?php echo $data['kdbrg']; ?>">
        
        <label for="nmbrg">Nama Barang:</label>
        <input type="text" name="nmbrg" value="<?php echo $data['nmbrg']; ?>" required><br>
        
        <label for="hrgbrg">Harga Barang:</label>
        <input type="text" name="hrgbrg" value="<?php echo $data['hrgbrg']; ?>" required><br>
        
        <label for="stokbrg">Stok Barang:</label>
        <input type="text" name="stokbrg" value="<?php echo $data['stokbrg']; ?>" required><br>
        
        <input type="submit" value="Perbarui Data Barang">
    </form>
</body>
</html>
