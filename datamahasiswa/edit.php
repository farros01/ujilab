<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>TOKO</h1>
        <h1>SINAR JAYA</h1>
    </header>
    <main>
    <?php 
	include "koneksi.php";
	$nim = $_GET['NIM'];
	$query_mysql = mysqli_query($conn,"SELECT * FROM mahasiswa WHERE NIM='$nim'")or die(mysql_error());
	while($data = mysqli_fetch_array($query_mysql)){
	?>
    <form action="edit-mhs.php" method="post">
    <div class="form-group">
        <label>NIM:</label>
        <input type="text" name="NIM" class="form-control" placeholder="" autocomplete="off" value="<?php echo $data['NIM']?>" readonly>
    </div>
    <div class="form-group">
        <label>NAMA :</label>
        <input type="text" name="Nama" class="form-control" placeholder="" autocomplete="off" value="<?php echo $data['Nama']?>">
    </div>
    <div class="form-group">
        <label>Alamat:</label>
        <input type="text" name="Alamat" class="form-control" placeholder="" autocomplete="off" value="<?php echo $data['Alamat']?>">
    </div>
    <div class="form-group">
        <label>Prodi :</label>
        <input type="text" name="prodi" class="form-control" placeholder="" autocomplete="off" value="<?php echo $data['prodi']?>">
    </div>
    <button type="submit" name="submit" class="btn" value="simpan">Save</button>
    </form>
    <?php } ?>
    </main>
 
</body>
</html>