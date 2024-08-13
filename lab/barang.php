<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        th,td{
            border: 1.5px solid #000;
        }
        .dataTables_filter{
            display:none;
        }
        .dataTables_length{
            display:none;
        }
        .dataTables_info{
            display:none;
        }
        .dataTables_paginate{
            display:none;
        }
    </style>
    <title>Toko Dendi Jaya Abadi</title>
</head>
<body>
<div class="button">
        <center>
        <h1>Daftar Barang</h1>
        <h1>Toko Dendi Jaya Abadi</h1>
        </center>
        <p>
        <a href="entry_data.php"><button>TAMBAH BARANG</button></a>
        </p> 
        <!--<table id="myTable" class="display" style="width:100%">-->
        <table border="2" id="brg" style="width:100%">
                <thead>
                  <tr>
                    <th scope="col">Kode Barang</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Harga Barang</th>
                    <th scope="col">Stok Barang</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        $select= mysqli_query($conn, "SELECT * FROM barang");
                        while($data= mysqli_fetch_array($select)){
                    ?>
                    <tr>
                      <td><?php echo $data['kdbrg'] ?></td>
                      <td><?php echo $data['nmbrg']?></td>
                      <td><?php echo $data['hrgbrg'] ?></td>                      
                      <td><?php echo $data['stokbrg'] ?></td>                      
                      <td>
                    <a href="edit.php?kdbrg=<?php echo $data['kdbrg']; ?>">Edit</a> | <a href="deletebarang.php?kdbrg=<?php echo $data['kdbrg']?>" class="text-center">Delete</a>
                      </td>                      
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
     </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script> 
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script> new DataTable('#myTable'); </script>
</body>
</html>