<?php
include 'koneksi.php';
$nim= $_GET['NIM'];
$query="DELETE from mahasiswa where NIM='$nim'";
$query1="DELETE from nilai where NIM='$nim'";
mysqli_query($conn, $query);
mysqli_query($conn, $query1);
$message="Berhasil Menghapus data";
echo "<script>alert('$message');
window.location.href='mahasiswa.php';</script>";
?>