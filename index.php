<?php
require_once 'config/Connection.php';
$conn = Connection::getConnection();

// Hitung total anggota
$query = "SELECT COUNT(*) AS total_anggota FROM anggota";
$stmt = $conn->query($query);
$result = $stmt->fetch();
$totalAnggota = $result['total_anggota'];

// Hitung total produk
$query = "SELECT COUNT(*) AS total_produk FROM produk";
$stmt = $conn->query($query);
$result = $stmt->fetch();
$totalProduk = $result['total_produk'];

// Hitung total pesanan
$query = "SELECT COUNT(*) AS total_pesanan FROM pesanan";
$stmt = $conn->query($query);
$result = $stmt->fetch();
$totalPesanan = $result['total_pesanan'];

// Hitung total pembayaran
$query = "SELECT COUNT(*) AS total_pembayaran FROM pembayaran";
$stmt = $conn->query($query);
$result = $stmt->fetch();
$totalPembayaran = $result['total_pembayaran'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Project01</title>
    <link href="public/css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <?php include_once("views/partials/navbar.php") ?>
    <div id="layoutSidenav">
        <?php include_once("views/partials/sidebar.php") ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>

                    <!-- Card Statistik -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <a href="views/anggota/index.php" style="text-decoration: none;">
                                <div class="card bg-primary text-white mb-4" style="cursor: pointer;">
                                    <div class="card-body">
                                        <i class="fas fa-users fa-3x"></i>
                                        <h4 class="mt-2">Anggota</h4>
                                        <p><?= $totalAnggota; ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <a href="views/produk/index.php" style="text-decoration: none;">
                                <div class="card bg-success text-white mb-4" style="cursor: pointer;">
                                    <div class="card-body">
                                        <i class="fas fa-box-open fa-3x"></i>
                                        <h4 class="mt-2">Produk</h4>
                                        <p><?= $totalProduk; ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <a href="views/pesanan/index.php" style="text-decoration: none;">
                                <div class="card bg-warning text-white mb-4" style="cursor: pointer;">
                                    <div class="card-body">
                                        <i class="fas fa-shopping-cart fa-3x"></i>
                                        <h4 class="mt-2">Pesanan</h4>
                                        <p><?= $totalPesanan; ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <a href="views/pembayaran/index.php" style="text-decoration: none;">
                                <div class="card bg-danger text-white mb-4" style="cursor: pointer;">
                                    <div class="card-body">
                                        <i class="fas fa-credit-card fa-3x"></i>
                                        <h4 class="mt-2">Pembayaran</h4>
                                        <p><?= $totalPembayaran; ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Grafik Statistik -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-line me-1"></i>
                            Grafik Statistik
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" width="100%" height="40"></canvas>
                        </div>
                    </div>
                </div>
            </main>
            <?php include_once("views/partials/footer.php") ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="public/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="public/js/datatables-simple-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Grafik Chart.js -->
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'],
                datasets: [{
                    label: 'Jumlah Pesanan',
                    data: [5, 10, 15, 20, 25],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
