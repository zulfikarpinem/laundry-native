<?php
$title = 'Outlet';
include '../templates/header.php';

if (isset($_POST['simpan'])) {
    if (insertDataOutlet($_POST) > 0) {
        $_SESSION['inserted'] = true;
        echo "<script>window.location.href = 'outlet.php'</script>";
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
        <h1 class="h3 mb-0 text-gray-800">Outlet</h1>
        <a class="btn btn-secondary" href="outlet.php"><i class="fas fa-arrow-left mr-2"></i>Back</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Outlet</h6>
        </div>
        <div class="row card-body align-items-center">
            <div class="col-md text-center">
                <img src="../assets/img/undraw_at_home_octe.svg" alt="" style="width: 350px;">
            </div>
            <div class="col-md">
                <form action="" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nama" placeholder="" name="nama" required>
                        <label for="nama">Outlet Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="" id="alamat" name="alamat" required></textarea>
                        <label for="alamat">Address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="telepon" placeholder="" name="telepon" required>
                        <label for="telepon">Mobile Number</label>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" name="simpan">Next</button>
                </form>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
<?php include '../templates/footer.php'; ?>