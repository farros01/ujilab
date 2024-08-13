<?php
include('config.php');

// Fungsi untuk menghitung jarak Euclidean antara dua titik
function hitungJarak($a1, $b1, $c1, $d1, $e1, $f1, $a2, $b2, $c2, $d2, $e2, $f2) {
    return sqrt(
        pow(($a2 - $a1), 2) + 
        pow(($b2 - $b1), 2) + 
        pow(($c2 - $c1), 2) + 
        pow(($d2 - $d1), 2) + 
        pow(($e2 - $e1), 2) + 
        pow(($f2 - $f1), 2)
    );
}


// Fungsi untuk menentukan centroid terdekat dari sebuah data
function cariCentroidTerdekat($data, $centroids) {
    $jarakTerdekat = INF;
    $centroidTerdekat = 0;

    foreach ($centroids as $index => $centroid) {
        $jarak = hitungJarak(
            $data['jan'], $data['feb'], $data['mart'], $data['apr'], $data['mei'], $data['jun'],
            $centroid['a'], $centroid['b'], $centroid['c'], $centroid['d'], $centroid['e'], $centroid['f']
        );

        if ($jarak < $jarakTerdekat) {
            $jarakTerdekat = $jarak;
            $centroidTerdekat = $index;
        }
    }

    return $centroidTerdekat;
}



// Data awal
$data = [];
$select = mysqli_query($conn, "SELECT * FROM upload_data");
while ($row = mysqli_fetch_assoc($select)) {
    $row['jarak'] = INF; // Inisialisasi jarak ke centroid
    $data[] = $row;
}

// Inisialisasi centroid awal
$centroids = [
    ['a' => 412, 'b' => 373, 'c' => 393, 'd' => 364, 'e' => 409, 'f' => 431],
    ['a' => 793, 'b' => 623, 'c' => 810, 'd' => 785, 'e' => 659, 'f' => 687],
    ['a' => 1397, 'b' => 1175, 'c' => 1173, 'd' => 1197, 'e' => 1240, 'f' => 1228],
];

// Jumlah iterasi
$jumlahIterasi = 6;

// Proses iterasi K-means
$iterasiData = [];
for ($i = 0; $i < $jumlahIterasi; $i++) {
    // Inisialisasi cluster
    $clusters = [];
    foreach ($centroids as $index => $centroid) {
        $clusters[$index] = [];
    }

    // Assign data ke centroid terdekat dan hitung jarak
    foreach ($data as $dataPointIndex => $dataPoint) {
        $centroidIndex = cariCentroidTerdekat($dataPoint, $centroids);
        $clusters[$centroidIndex][] = $dataPointIndex; // Simpan index data pada cluster
        $jarak = hitungJarak(
            $dataPoint['jan'], $dataPoint['feb'], $dataPoint['mart'], $dataPoint['apr'], $dataPoint['mei'], $dataPoint['jun'],
            $centroids[$centroidIndex]['a'], $centroids[$centroidIndex]['b'], $centroids[$centroidIndex]['c'],
            $centroids[$centroidIndex]['d'], $centroids[$centroidIndex]['e'], $centroids[$centroidIndex]['f']
        );
        $data[$dataPointIndex]['jarak'] = $jarak; // Simpan jarak pada data

        $iterasiData[$i][] = [
            'Data' => $dataPointIndex + 1,
            'Jarak ke Centroid' => $jarak,
            'Cluster' => 'Cluster ' . ($centroidIndex + 1) // Cluster index starts at 1
        ];
    }

    // Hitung centroid baru
    foreach ($clusters as $index => $cluster) {
        $jumlahData = count($cluster);
        $sumA = 0;
        $sumB = 0;
        $sumC = 0;
        $sumD = 0;
        $sumE = 0;
        $sumF = 0;

        foreach ($cluster as $dataPointIndex) {
            $dataPoint = $data[$dataPointIndex];
            $sumA += $dataPoint['jan'];
            $sumB += $dataPoint['feb'];
            $sumC += $dataPoint['mart'];
            $sumD += $dataPoint['apr'];
            $sumE += $dataPoint['mei'];
            $sumF += $dataPoint['jun'];
        }

        if ($jumlahData > 0) {
            $centroids[$index]['a'] = $sumA / $jumlahData;
            $centroids[$index]['b'] = $sumB / $jumlahData;
            $centroids[$index]['c'] = $sumC / $jumlahData;
            $centroids[$index]['d'] = $sumD / $jumlahData;
            $centroids[$index]['e'] = $sumE / $jumlahData;
            $centroids[$index]['f'] = $sumF / $jumlahData;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iterasi K-Means</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css">
</head>
<body>
    <?php include "home.php"; ?>
    <div class="content_iterasi">
        <div class="header">
            <main>
                <div class="container-main">
                    <form method="post" enctype="multipart/form-data" action="import.php"></form>

                    <!-- Tabel untuk hasil semua cluster -->
                    <table class="tabel data" id="clusterTable">
                        <thead>
                            <tr>
                                <th scope="col">Nama Bahan Baku</th>
                                <th scope="col">Januari</th>
                                <th scope="col">Februari</th>
                                <th scope="col">Maret</th>
                                <th scope="col">April</th>
                                <th scope="col">Mei</th>
                                <th scope="col">Juni</th>
                                <th scope="col">Jarak</th>
                                <th scope="col">Cluster</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $dataPointIndex => $dataPoint) {
                                $centroidIndex = cariCentroidTerdekat($dataPoint, $centroids);
                                $clusterLabel = "Cluster " . ($centroidIndex + 1); // Cluster index starts at 1
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($dataPoint['bahan_baku']) . "</td>";
                                echo "<td>" . htmlspecialchars($dataPoint['jan']) . "</td>";
                                echo "<td>" . htmlspecialchars($dataPoint['feb']) . "</td>";
                                echo "<td>" . htmlspecialchars($dataPoint['mart']) . "</td>";
                                echo "<td>" . htmlspecialchars($dataPoint['apr']) . "</td>";
                                echo "<td>" . htmlspecialchars($dataPoint['mei']) . "</td>";
                                echo "<td>" . htmlspecialchars($dataPoint['jun']) . "</td>";
                                echo "<td>" . htmlspecialchars($dataPoint['jarak']) . "</td>";
                                echo "<td>" . htmlspecialchars($clusterLabel) . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <br><br>

                    <!-- Tabel untuk hasil iterasi -->
                    <table class="tabel data" id="iterasiTable">
                        <thead>
                            <tr>
                                <th scope="col">Iterasi</th>
                                <th scope="col">Jumlah Data</th>
                                <th scope="col">Data</th>
                                <th scope="col">Jarak ke Centroid</th>
                                <th scope="col">Cluster</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($iterasiData as $iterasiIndex => $iterasi) {
                            // Baris tambahan sebagai pemisah
                            if ($iterasiIndex > 0) {
                                echo "<tr><td colspan='5' style='border-top: 2px solid black;'></td></tr>";
                            }

                            echo "<tr>";
                            echo "<td rowspan='" . count($iterasi) . "'>Iterasi " . ($iterasiIndex + 1) . "</td>";
                            echo "<td rowspan='" . count($iterasi) . "'>" . count($data) . "</td>";
                            $firstDataPoint = true;
                            foreach ($iterasi as $dataPoint) {
                                if (!$firstDataPoint) {
                                    echo "<tr>";
                                }
                                echo "<td>" . htmlspecialchars($dataPoint['Data']) . "</td>";
                                echo "<td>" . htmlspecialchars($dataPoint['Jarak ke Centroid']) . "</td>";
                                echo "<td>" . htmlspecialchars($dataPoint['Cluster']) . "</td>";
                                echo "</tr>";
                                $firstDataPoint = false;
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>

                    </table>

                </div>
            </main>

            <script> new DataTable('#clusterTable'); </script>
            <script> new DataTable('#iterasiTable'); </script> 
            <script src="https://code.jquery.com/jquery-3.7.0.js"></script> 
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
            <script>
                // Nonaktifkan sementara DataTables untuk memeriksa tabel secara manual
 $(document).ready(function() {
 $('#clusterTable').DataTable();
    $('#iterasiTable').DataTable({
         dom: 'Bfrtip',
         buttons: [
             'excel', 'print'
         ]
     });
 });
</script>
        </div>
    </div>
</body>
</html>
