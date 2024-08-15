<?php
include 'koneksi.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Data Mahasiswa</h1>
    
    </header>
    <main>
        <div class="">
            <a href="tambah.php" name="save" value="simpan" type="submit">Tambah mahasiwa</a>
</div>
<br>
<table id="mhs" style="widht:100%">
    <thead>
        <tr>
            <th>NO</th>
            <th scope="col">NIM</th>
            <th>nama</th>
            <th>alamat</th>
            <th>prodi</th>
            <th>Aksi</th>
            </tr>
            <tbody>
        <?php
            $select = mysqli_query($conn, "SELECT * FROM mahasiswa");
            $no=1;
            while($data = mysqli_fetch_array($select)){
            ?>
            <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data['NIM'] ?></td>
            <td><?php echo $data['Nama'] ?></td>
            <td><?php echo $data['Alamat']?></td>
            <td><?php echo $data['prodi'] ?></td>
            <td class="text-center">
            <a  href="hapus.php?NIM=<?php echo $data['NIM']?>" class="btn-2">Hapus</a> ||
            <a href="edit.php?NIM=<?php echo $data['NIM'] ?>" class="btn-2">Edit</a>
            </td>
            </tr> 
            <?php } ?>
        </tbody>
      
    </table>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function () {
        $('#brg').DataTable({
            searchable: false,
            scrollCollapse: true,
            scrollY: '200px'
          });
      });
    </script>
</body>
</html>