<?php
include 'config.php';
include 'excel_reader2.php';

$target = basename($_FILES['file']['name']);
$ext = pathinfo($target, PATHINFO_EXTENSION);

// Periksa apakah file yang diunggah memiliki format Excel yang valid
if ($ext !== 'xls' && $ext !== 'xlsx') {
    echo "<script>alert('Format file salah. Harap unggah file dengan format .xls atau .xlsx.'); window.location.href='uploaddata.php';</script>";
} else {
    move_uploaded_file($_FILES['file']['tmp_name'], $target);
    chmod($target, 0777);

    $data = new Spreadsheet_Excel_Reader($target, false);
    $jumlah_baris = $data->rowcount($sheet_index = 0);

    $berhasil = 1;
    for ($i = 2; $i <= $jumlah_baris; $i++) {
        $bahan_baku = $data->val($i, 1);
        $jan = $data->val($i, 2);
        $feb = $data->val($i, 3);
        $mart = $data->val($i, 4);
        $apr = $data->val($i, 5);
        $mei = $data->val($i, 6);
        $jun = $data->val($i, 7);

        if ($bahan_baku != "") {
            $hasil = mysqli_query($conn, "INSERT into upload_data values('$bahan_baku','$jan', '$feb', '$mart', '$apr', '$mei', '$jun')");
            if ($hasil) {
                $berhasil++;
            }
        }
    }
    unlink($target);

    if ($berhasil > 0) {
        echo "<script>alert('$berhasil Data Berhasil Dimport.'); window.location.href='uploaddata.php';</script>";
    } else {
        echo "<script>alert('Tidak ada data yang berhasil diimpor.'); window.location.href='uploaddata.php';</script>";
    }
}
?>
