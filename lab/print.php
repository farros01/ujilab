<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<body style="padding: 0 20;">
    <div>
    <?php 
        include "config.php";    
    ?>
      <section class="content">
        <div class="row">
            <div>
                <div class="span12">
                    <table class="table">
                        <tbody>
                            <tr>
                              <center>
                              <h2><strong> INVOICE </strong></h2>
                              </center>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th>No Transaksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Barang</th>
                    <th>Stok Barang</th>
                    <th>Jumlah Beli</th>
                    <th>Total Bayar</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $select = mysqli_query($conn, "SELECT * FROM transaksi INNER JOIN barang on transaksi.kdbrg=barang.kdbrg");
                    $no=1;
                    while($data = mysqli_fetch_array($select)){
                    ?>
                    <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['idtrans'] ?></td>
                    <td><?php echo $data['tgltrans'] ?></td>
                    <td><?php echo $data['kdbrg'] ?></td>
                    <td><?php echo $data['nmbrg'] ?></td>
                    <td><?php echo $data['hrgbrg'] ?></td>
                    <td><?php echo $data['stokbrg'] ?></td>
                    <td><?php echo $data['jmlbeli'] ?></td>
                    <td><?php echo $data['totalharga'] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
          </div>
      </section>
    </div>
  </body>
   <script>
      window.print()
  </script>