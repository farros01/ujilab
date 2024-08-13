<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Data</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="datatabel/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="datatabel/css/jquery.dataTables.css">
</head>
<body>
   <?php
      include "home.php";
   ?>
     <div class="content_uploaddata">
        <div class="header">
        <center>
        <h1>Kelola Data Bahan Baku </h1>
        <form method="post" enctype="multipart/form-data" action="import.php">
	            <input name="file" type="file" required="required"> 
	            <input name="upload" type="submit" value="Import">
            </form>
            <a href="delete.php" class="text-center">Hapus Semua</a>
            </center>
            <table class="tabel data" id="myTable">
                <thead>
                  <tr>
                    <th scope="col" >NAMA BAHAN BAKU</th>
                    <th scope="col">JANUARI</th>
                    <th scope="col">FEBUARI</th>
                    <th scope="col">MARET</th>
                    <th scope="col" >APRIL</th>
                    <th scope="col">MEI</th>
                    <th scope="col">JUNI</th>
                                      </tr>
                </thead>
                <tbody>
                    <?php
                        $select= mysqli_query($conn, "SELECT * FROM upload_data");
                        while($data= mysqli_fetch_array($select)){
                    ?>
                    <tr>
                      <td><?php echo $data['bahan_baku'] ?></td>
                      <td><?php echo $data['jan'] ?></td>                      
                      <td><?php echo $data['feb'] ?></td>                      
                      <td><?php echo $data['mart'] ?></td>                                           
                      <td><?php echo $data['apr'] ?></td>                     
                      <td><?php echo $data['mei'] ?></td>                     
                      <td><?php echo $data['jun'] ?></td>
                     </tr>
                    <?php } ?>
                </tbody>
            </table>
      </div>
     </div>
   <script src="datatabel/js/jquery-3.7.0.min.js"></script>
   <script src="datatabel/js/jquery.dataTables.min.js"></script>
   <script>
new DataTable('#myTable');
    </script>  
</body>
</html>