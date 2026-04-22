<?php
$title = 'Paket';
include '../templates/header.php';

$id = $_GET['id'];
$paket = query("SELECT * FROM tb_paket WHERE id = $id")[0];
$outlet = query("SELECT id, nama FROM tb_outlet");

if (isset($_POST['update'])) {
    if (updateDataPaket($_POST) > 0) {
        $_SESSION['updated'] = true;
        echo "<script>window.location.href = 'paket.php'</script>";
    } else {
        $_SESSION['notUpdated'] = true;
    }
}
?>
<?php include '../templates/admin/navbar.php'; ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php
    if (isset($_SESSION['notUpdated'])) {
        echo '<div class="alert alert-danger">Data gagal ditambahkan!</div>';
        unset($_SESSION['notUpdated']);
    }
    ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Paket</h1>
        <a class="btn btn-secondary" href="paket.php"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Package</h6>
        </div>
        <div class="row card-body align-items-center">
            <div class="col-md text-center">
                <img src="../assets/img/undraw_order_delivered_re_v4ab.svg" alt="" style="width: 350px;">
            </div>
            <div class="col-md">
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $paket['id']; ?>">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="outlet" aria-label="Floating label select example" name="outlet" required>
                            <option disabled>Select outlet</option>
                            <?php foreach ($outlet as $o) : ?>
                                <option value="<?= $o['id']; ?>" <?= ($paket['id_outlet'] == $o['id']) ? 'selected' : ''; ?>><?= $o['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="outlet">Outlet</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="jenis" aria-label="Floating label select example" name="jenis" required>
                            <option disabled>Pilih jenis paket</option>
                            <option value="kiloan" <?= ($paket['jenis'] == 'kiloan') ? 'selected' : ''; ?>>Kiloan</option>
                            <option value="selimut" <?= ($paket['jenis'] == 'selimut') ? 'selected' : ''; ?>>Selimut</option>
                            <option value="bed cover" <?= ($paket['jenis'] == 'bed cover') ? 'selected' : ''; ?>>Bed Cover</option>
                            <option value="kaos" <?= ($paket['jenis'] == 'kaos') ? 'selected' : ''; ?>>Kaos</option>
                            <option value="lain" <?= ($paket['jenis'] == 'lain') ? 'selected' : ''; ?>>Lainnya</option>
                        </select>
                        <label for="jenis">Jenis Paket</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nama" placeholder="" name="nama" value="<?= $paket['nama_paket']; ?>" required>
                        <label for="nama">Nama Paket</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="harga" placeholder="" name="harga" value="<?= $paket['harga']; ?>" required>
                        <label for="harga">Harga</label>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" name="update">Update</button>
                </form>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
<?php include '../templates/footer.php'; ?>