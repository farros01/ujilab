<?php
include 'koneksi.php';

// Fetch existing NIMs from the database
$mahasiswa = mysqli_query($conn, "SELECT NIM, Nama, prodi FROM mahasiswa");
$jsArray = "var mahasiswaData = {};\n";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Nilai Mahasiswa</h1>
    </header>
    <main>
        <form class="nilai" method="POST" action="action-nilai.php">
            <div class="form-group">
                <label><b>NIM</b></label>
                <select name="NIM" id="NIM" onchange="fillDetails()" required>
                    <option value="">Pilih NIM</option>
                    <?php 
                    while($row = mysqli_fetch_array($mahasiswa)) {
                        echo '<option value="' . $row['NIM'] . '">' . $row['NIM'] . ' - ' . $row['Nama'] . ' - ' . $row['prodi'] . '</option>';
                        $jsArray .= "mahasiswaData['" . $row['NIM'] . "'] = {nama:'" . addslashes($row['Nama']) . "', prodi:'" . addslashes($row['prodi']) . "'};\n";
                    } 
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label><b>Nama</b></label>
                <input type="text" class="" name="Nama" id="Nama" readonly>
            </div>
            <div class="form-group">
                <label><b>Prodi</b></label>
                <input type="text" class="" id="prodi" name="prodi" readonly>
            </div>
            <div class="form-group">
                <label><b>matkul</b></label>
                <select name="matkul" required>
                    <option value="bahasa indonesia">bahasa indonesia</option>
                    <option value="bahasa inggris">baha inggris</option>
                    <option value="bahasa jepang">bahasa jepang</option>
                </select>
            </div>
            <div class="form-group">
                <label><b>id Matkul</b></label>
                <input type="number" class="" id="id_matkul" name="id_matkul" >
            </div>
            <div class="form-group">
                <label><b>Absen</b></label>
                <input type="number" class="" id="absen" name="absen" onchange="calculatePredikat()" required>
            </div>
            <div class="form-group">
                <label><b>tugas</b></label>
                <input type="number" class="" id="tugas" name="tugas" onchange="calculatePredikat()" required>
            </div>    
            <div class="form-group">
                <label><b>UTS</b></label>
                <input type="number" class="" id="uts" name="uts" onchange="calculatePredikat()" required>
            </div>    
            <div class="form-group">
                <label><b>UAS</b></label>
                <input type="number" class="" id="uas" name="uas" onchange="calculatePredikat()" required>
            </div>    
            <div class="form-group">
                <label><b>Nilai Akhir</b></label>
                <input type="text" class="" id="na" name="na" readonly>
            </div>
            <div class="form-group">
                <label><b>Predikat</b></label>
                <input type="text" class="" id="predikat" name="predikat" readonly>
            </div>
            <div class="">
                <button class="" name="save" value="simpan" type="submit">Tambah</button>
            </div>
        </form>
    </main>

    <br>
    <table id="mhs" style="width:100%">
        <thead>
            <tr>
                <th>no</th>
                <th scope="col">NIM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Matkul</th>
                <th>id matkul</th>
                <th>Absen</th>
                <th>tugas </th>
                <th>UTS</th>
                <th>UAS</th>
                <th>nilai Akhir</th>
                <th>Predikat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $select = mysqli_query($conn, "SELECT * FROM nilai");
            $no=1;
            while($data = mysqli_fetch_array($select)){
            ?>
            <tr>
            <td><?php echo $no++ ?></td>
                <td><?php echo $data['NIM'] ?></td>
                <td><?php echo $data['Nama'] ?></td>
                <td><?php echo $data['Prodi']?></td>
                <td><?php echo $data['matkul']?></td>
                <td><?php echo $data['id_matkul'] ?></td>
                <td><?php echo $data['absen'] ?></td>
                <td><?php echo $data['tugas']?></td>
                <td><?php echo $data['uts'] ?></td>
                <td><?php echo $data['uas'] ?></td>
                <td><?php echo $data['na']?></td>
                <td><?php echo $data['predikat'] ?></td>
                <td class="text-center">
                    <a href="print.php?NIM=<?php echo $data['NIM']; ?>" class="btn-2">Cetak</a> ||
                    <a href="hapus-nilai.php?NIM=<?php echo $data['NIM']; ?>&id_matkul=<?php echo $data['id_matkul']; ?>" class="btn-2" onclick="return confirmDelete()">hapus</a>
                </td>
            </tr> 
            <?php } ?>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<footer>
    </footer>
            
    <script>
        // JavaScript array for mahasiswa data
        <?php echo $jsArray; ?>

        function fillDetails() {
            var NIM = document.getElementById('NIM').value;
            if (mahasiswaData[NIM]) {
                document.getElementById('Nama').value = mahasiswaData[NIM].nama;
                document.getElementById('prodi').value = mahasiswaData[NIM].prodi;
            } else {
                document.getElementById('Nama').value = '';
                document.getElementById('prodi').value = '';
            }
        }

    function calculatePredikat() {
        var absen = parseFloat(document.getElementById('absen').value) || 0;
        var tugas = parseFloat(document.getElementById('tugas').value) || 0;
        var uts = parseFloat(document.getElementById('uts').value) || 0;
        var uas = parseFloat(document.getElementById('uas').value) || 0;

        // Calculate the final score as the average of all components
        var finalScore = (absen + tugas + uts + uas) / 4;

        // Determine the predikat based on the score
        var predikat = '';
        if (finalScore >= 81) {
            predikat = 'A';
        } else if (finalScore >= 72) {
            predikat = 'B';
        } else if (finalScore >= 40) {
            predikat = 'C';
        } else {
            predikat = 'D';
        }

        // Set the final score and predikat in the input fields
        document.getElementById('na').value = finalScore.toFixed(2);
        document.getElementById('predikat').value = predikat;
    }

        function confirmDelete() {
            return confirm("Apakah Anda yakin ingin menghapus nilai ini?");
        }
    </script>
</body>
</html>
