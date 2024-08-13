<?php
include 'config.php';
$kd=$_GET['kdbrg'];
$query="DELETE from barang where kdbrg='$kd'";
mysqli_query($conn,$query);
header("location:barang.php");
?>