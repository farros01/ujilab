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
        <h1>TOKO</h1>
        <h1>SINAR JAYA</h1>
    </header>
    <main>
    <form action="tambah-mhs.php" method="post">
    <div class="form-group">
        <label>nim:</label>
        <input type="text" name="NIM" class="form-control" placeholder="" autocomplete="off">
    </div>
    <div class="form-group">
        <label>NAMA :</label>
        <input type="text" name="Nama" class="form-control" placeholder="" autocomplete="off">
    </div>
    <div class="form-group">
        <label>alamat:</label>
        <input type="text" name="Alamat" class="form-control" placeholder="" autocomplete="off">
    </div>
    <div class="form-group">
                <label><b>Prodi</b></label>
                <select name="prodi" required>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Akuntansi">Akuntansi</option>
                    <option value="Kedokteran">Kedokteran</option>
                </select>
            </div>
    <button type="submit" name="submit" class="btn">Submit</button>
    </form>
    </main>

</body>
</html>