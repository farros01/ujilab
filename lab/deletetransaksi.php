<?php
include 'config.php';
$kd=$_GET['idtrans'];
$query="DELETE from transaksi where idtrans='$kd'";
mysqli_query($conn,$query);
header("location:transaksi.php");
?>