<?php
include "koneksi.php";

$nim=$_POST['NIM'];
$nm=$_POST['Nama'];
$alamat=$_POST['Alamat'];
$prodi=$_POST['prodi'];

if(empty($_POST['NIM'])||empty($_POST['Nama'])||empty($_POST['Alamat'])||empty($_POST['prodi'])){
    ?>
    <script language="JavaScript">
    alert('Data Harap Dilengkapi!');
    document.location='tambah.php';
    </script>
    <?php
}else{ 
    $sql="INSERT INTO mahasiswa (NIM,Nama,Alamat,prodi) VALUES
    ('$nim','$nm','$alamat','$prodi')";
    $hasil=mysqli_query($conn,$sql);
    if ($hasil) {
        $message="Berhasil Memasukan Data";
        echo "<script>alert('$message');
        window.location.href='mahasiswa.php';</script>";
    }
    else {
        echo "Gagal insert data";
        exit;
    }  
}
?>