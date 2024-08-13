<?php
include 'config.php';

$kdbrg = $_GET['kdbrg'];

$query = "SELECT nmbrg, hrgbrg, stokbrg FROM barang WHERE kdbrg = '$kdbrg'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $response = array(
        'nmbrg' => $row['nmbrg'],
        'hrgbrg' => $row['hrgbrg'],
        'stokbrg' => $row['stokbrg']
    );
} else {
    $response = array(
        'nmbrg' => 'Barang tidak ditemukan',
        'hrgbrg' => '',
        'stokbrg' => ''
    );
}

header('Content-Type: application/json');
echo json_encode($response);
?>
