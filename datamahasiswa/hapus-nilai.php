<?php
include 'koneksi.php';

if (isset($_GET['NIM']) && isset($_GET['id_matkul'])) {
    $NIM = $_GET['NIM'];
    $id_matkul = $_GET['id_matkul'];

    // Hapus data berdasarkan NIM dan id_matkul
    $query = "DELETE FROM nilai WHERE NIM='$NIM' AND id_matkul='$id_matkul'";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil dihapus');</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }
}

// Redirect kembali ke halaman utama setelah penghapusan
echo "<script>window.location.href='nilai.php';</script>";
?>
