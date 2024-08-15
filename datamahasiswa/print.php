<?php
include 'koneksi.php';

// Fetch all records from the 'nilai' table
$select = mysqli_query($conn, "SELECT * FROM nilai");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Nilai Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
    <style>
        @media print {
            .noprint {
                display: none;
            }
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <header>
        <h1>Daftar Nilai Mahasiswa</h1>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Absen</th>
                    <th>UTS</th>
                    <th>UAS</th>
                    <th>Predikat</th>
                </tr>
            </thead>
            <tbody>
                <?php while($data = mysqli_fetch_array($select)){ ?>
                <tr>
                    <td><?php echo $data['NIM'] ?></td>
                    <td><?php echo $data['Nama'] ?></td>
                    <td><?php echo $data['Prodi']?></td>
                    <td><?php echo $data['absen'] ?></td>
                    <td><?php echo $data['uts'] ?></td>
                    <td><?php echo $data['uas'] ?></td>
                    <td><?php echo $data['predikat'] ?></td>
                </tr> 
                <?php } ?>
            </tbody>
        </table>
    </main>

    <footer>
        <button class="noprint" onclick="window.print()">Print Halaman Ini</button>
        <a href="nilai.php" class="noprint">Kembali</a>
    </footer>
</body>
</html>
