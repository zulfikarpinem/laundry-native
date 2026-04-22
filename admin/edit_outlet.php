<?php
$title = 'Outlet';
include '../templates/header.php';

$id = $_GET['id'];
$outlet = query("SELECT * FROM tb_outlet WHERE id = $id")[0];

if (isset($_POST['update'])) {
    if (updateDataOutlet($_POST) > 0) {
        $_SESSION['updated'] = true;
        echo "<script>window.location.href = 'outlet.php'</script>";
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
        echo '<div class="alert alert-danger">Data failed to change!</div>';
        unset($_SESSION['notUpdated']);
    }
    ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Outlet</h1>
        <a class="btn btn-secondary" href="outlet.php"><i class="fas fa-arrow-left mr-2"></i>Back</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Outlet</h6>
        </div>
        <div class="row card-body align-items-center">
            <div class="col-md text-center">
                <img src="../assets/img/undraw_text_field_htlv.svg" alt="" style="width: 350px;">
            </div>
            <div class="col-md">
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $outlet['id']; ?>">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $outlet['nama']; ?>" required>
                        <label for="nama">Outlet Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="alamat" name="alamat" required><?= $outlet['alamat']; ?></textarea>
                        <label for="alamat">Address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $outlet['tlp']; ?>" required>
                        <label for="telepon">Mobile Number</label>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" name="update">Update</button>
                </form>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
<?php include '../templates/footer.php'; ?>