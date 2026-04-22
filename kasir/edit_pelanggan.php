<?php
$title = 'Pelanggan';
include '../templates/header.php';

$id = $_GET['id'];
$pelanggan = query("SELECT * FROM tb_member WHERE id = $id")[0];

if (isset($_POST['update'])) {
    if (updateDataPelanggan($_POST) > 0) {
        $_SESSION['updated'] = true;
        echo "<script>window.location.href = 'pelanggan.php'</script>";
    } else {
        $_SESSION['notUpdated'] = true;
    }
}
?>
<?php include '../templates/kasir/navbar.php'; ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php
    if (isset($_SESSION['notUpdated'])) {
        echo '<div class="alert alert-danger">Data failed to change!</div>';
        unset($_SESSION['notUpdated']);
    }
    ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customer</h1>
        <a class="btn btn-secondary" href="pelanggan.php"><i class="fas fa-arrow-left mr-2"></i>Back</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Customer</h6>
        </div>
        <div class="row card-body align-items-center">
            <div class="col-md text-center">
                <img src="../assets/img/undraw_text_field_htlv.svg" alt="" style="width: 350px;">
            </div>
            <div class="col-md">
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $pelanggan['id']; ?>">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $pelanggan['nama']; ?>" required>
                        <label for="nama">Customer Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="alamat" name="alamat" required><?= $pelanggan['alamat']; ?></textarea>
                        <label for="alamat">Address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="jenisKelamin" aria-label="Floating label select example" name="jenisKelamin" required>
                            <option>Select Gender</option>
                            <option value="L" <?= ($pelanggan['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>Male</option>
                            <option value="P" <?= ($pelanggan['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>Female</option>
                        </select>
                        <label for="jenisKelamin">Gender</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $pelanggan['tlp']; ?>" required>
                        <label for="telepon">No. Telepon</label>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" name="update">Update</button>
                </form>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
<?php include '../templates/footer.php'; ?>