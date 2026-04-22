<?php
$title = 'Paket';
include '../templates/header.php';

$outlet = query("SELECT id, nama FROM tb_outlet");

if (isset($_POST['simpan'])) {
    if (insertDataPaket($_POST) > 0) {
        $_SESSION['inserted'] = true;
        echo "<script>window.location.href = 'paket.php'</script>";
    } else {
        $_SESSION['notInserted'] = true;
    }
}
?>
<?php include '../templates/admin/navbar.php'; ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php
    if (isset($_SESSION['notInserted'])) {
        echo '<div class="alert alert-danger">Data gagal ditambahkan!</div>';
        unset($_SESSION['notInserted']);
    }
    ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Paket</h1>
        <a class="btn btn-secondary" href="paket.php"><i class="fas fa-arrow-left mr-2"></i>Back</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Package</h6>
        </div>
        <div class="row card-body align-items-center">
            <div class="col-md text-center">
                <img src="../assets/img/undraw_order_delivered_re_v4ab.svg" alt="" style="width: 350px;">
            </div>
            <div class="col-md">
                <form action="" method="post">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="outlet" aria-label="Floating label select example" name="outlet" required>
                            <option selected disabled>Select Outlet</option>
                            <?php foreach ($outlet as $o) : ?>
                                <option value="<?= $o['id']; ?>"><?= $o['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="outlet">Outlet</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="jenis" aria-label="Floating label select example" name="jenis" required>
                            <option selected disabled>Select the package type</option>
                            <option value="kiloan">Kilos</option>
                            <option value="selimut">A blanket</option>
                            <option value="bed cover">Bed Cover</option>
                            <option value="kaos">Shirt</option>
                            <option value="lain">Other</option>
                        </select>
                        <label for="jenis">Package Type</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nama" placeholder="" name="nama" required>
                        <label for="nama">Package Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="harga" placeholder="" name="harga" required>
                        <label for="harga">Price</label>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" name="simpan">Save</button>
                </form>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
<?php include '../templates/footer.php'; ?>