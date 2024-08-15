
<?php
include 'koneksi.php';

if (isset($_POST['save'])) {
    $im = $_POST['id_matkul'];
    $nim = $_POST['NIM'];
    $nama = $_POST['Nama'];
    $prodi = $_POST['prodi'];
    $matkul = $_POST['matkul'];
    $absen = $_POST['absen'];
    $tugas = $_POST['tugas'];
    $uts = $_POST['uts'];
    $uas = $_POST['uas'];
    $na = $_POST['na'];
    $predikat = $_POST['predikat'];

    // SQL query to insert data into the database
    $query = "INSERT INTO nilai (id_matkul, NIM, Nama, prodi, matkul, absen, tugas, uts, uas, na, predikat) 
              VALUES ('$im','$nim', '$nama', '$prodi', '$matkul','$absen', '$tugas','$uts', '$uas', '$na','$predikat')";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        // Redirect to the main page after successful insertion
        header("Location: nilai.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
