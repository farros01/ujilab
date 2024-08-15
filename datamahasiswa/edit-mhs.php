<?php 
include "koneksi.php";
$nim=$_POST['NIM'];
$nm=$_POST['Nama'];
$alamat=$_POST['Alamat'];
$prodi=$_POST['prodi'];

mysqli_query($conn,"UPDATE mahasiswa SET NIM='$nim', Nama='$nm', Alamat='$alamat', prodi='$prodi' WHERE NIM='$nim'");
$message="Berhasil Mengedit data";
echo "<script>alert('$message');
window.location.href='mahasiswa.php';</script>";
?>