<?php
$title = 'Dashboard';
include '../templates/header.php';

$baru = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE status = 'baru'");
$jumlahBaru = mysqli_num_rows($baru);
$proses = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE status = 'proses'");
$jumlahProses = mysqli_num_rows($proses);
$selesai = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE status = 'selesai'");
$jumlahSelesai = mysqli_num_rows($selesai);
$diambil = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE status = 'diambil'");
$jumlahDiambil = mysqli_num_rows($diambil);

$transaksi = query("SELECT * FROM tb_transaksi ORDER BY id DESC");
?>
<?php include '../templates/kasir/navbar.php'; ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Baru Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                New</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahBaru; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Proses Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Process</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahProses; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-sync fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Selesai Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Finished</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahSelesai; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Diambil Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Taken</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahDiambil; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hand-holding fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transaction History</h6>
        </div>
        <div class="card-body">
            <?php foreach ($transaksi as $t) : ?>
                <div class="d-flex align-items-center justify-content-between pr-5 border-bottom mb-3">
                    <div>
                        <h5 class="mb-0">Invoice</h5>
                        <p><?= $t['kode_invoice']; ?></p>
                    </div>
                    <?php
                    if ($t['status'] == 'baru') {
                        echo '<span class="badge badge-primary">' . $t['status'] . '</span>';
                    } elseif ($t['status'] == 'proses') {
                        echo '<span class="badge badge-warning">' . $t['status'] . '</span>';
                    } elseif ($t['status'] == 'selesai') {
                        echo '<span class="badge badge-info">' . $t['status'] . '</span>';
                    } elseif ($t['status'] == 'diambil') {
                        echo '<span class="badge badge-success">' . $t['status'] . '</span>';
                    }
                    ?>
                    <?php
                    if ($t['dibayar'] == 'dibayar') {
                        echo '<span class="badge badge-success">' . $t['dibayar'] . '</span>';
                    } elseif ($t['dibayar'] == 'belum dibayar') {
                        echo '<span class="badge badge-danger">' . $t['dibayar'] . '</span>';
                    }
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

<?php include '../templates/footer.php'; ?>