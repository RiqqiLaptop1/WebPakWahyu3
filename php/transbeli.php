<br>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'kelompok3web') or die(mysqli_error($conn));

function query($query)
{
  $conn = mysqli_connect('localhost', 'root', '', 'kelompok3web');

  // query isi tabel
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

  // ubah data ke array
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}
// minta data supplier dari database
$transBeli = query("SELECT * FROM trans_beli_view ORDER BY no_faktur");
$supplier = query("SELECT * FROM supplier");

// tambah
if (isset($_POST['tambah'])) :
  $kd = $_POST['supplier'];
  $query = "INSERT INTO trans_beli (kd_supp) VALUES ('$kd')";
  mysqli_query($conn, $query) or die(mysqli_error($conn));

?>
  <script>
    document.location.href = 'inputTransBeli.php';
  </script>
<?php endif; ?>

<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="..\css\bootstrap.css">

  <title>Tabel Trans Beli</title>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="index.php">
        <img src="..\img\zero-two.jpg" alt="judul" width="30" height="30" class="d-inline-block align-top rounded-circle">
        Toko Ali 2
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="about.php">About</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <main>

    <body style="margin-top: 50px; background-color: #636363;">
      <br>
      <h1 style="text-align: center;"> TRANSAKSI PEMBELIAN</h1>
      <br>
      <div class="container">
        <form action="" method="POST">
          <div class="form-row">
            <div class="col-md-4">
              <select id="inputState" name="supplier" class="form-control" required>
                <option selected> Nama Supplier</option>
                <?php foreach ($supplier as $s) : ?>
                  <option value="<?= $s['kd_supp']; ?>"><?= $s['nm_supp']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-3">
              <button type="submit" name="tambah" class="btn btn-dark">Tambah Transaksi</button>
            </div>
          </div>
        </form>
        <div class="row">

          <div class="col">
            <!-- tabel data -->
            <table class="table table-dark table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>No Faktur</th>
                  <th>Tgl</th>
                  <th>Nama Supplier</th>
                  <th>Total</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($transBeli as $b) : ?>
                  <tr>
                    <td><?= $b['no_faktur']; ?></td>
                    <td><?= $b['tgl']; ?> <?= $b['bulan']; ?> <?= $b['tahun']; ?> <?= $b['jam']; ?></td>
                    <td><?= $b['nm_supp']; ?></td>
                    <td><?= $b['total_bayar']; ?></td>
                    <td>
                      <a href="detailbeli.php?detail=<?= $b['no_faktur']; ?>" class="badge badge-secondary ">Detail</a>
                    </td>
                  </tr>
                <?php endforeach; ?>

              </tbody>
            </table>
          </div>
        </div>
        <br>
      </div>
      <button type="button" class="btn btn-dark " style="margin-left: 70%;">
        <a class="btn btn-dark" href="index.php" role="button">Kembali ke Halaman Awal</a>
      </button>
  </main>

  <footer class="footer fixed-bottom mt-auto py-3 bg-dark">
    <div class="container text-center ">
      <span class=" text-light">&copy; 2022 | Toko Ali 2</span>
    </div>
  </footer>

  <script src="..\js\jquery-3.6.0.min.js"></script>
  <script src="..\js\bootstrap.bundle.min.js"></script>

</body>

</html>