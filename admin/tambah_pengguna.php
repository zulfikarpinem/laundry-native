<?php
$title = 'Pengguna';
include '../templates/header.php';

$outlet = query("SELECT id, nama FROM tb_outlet");

if (isset($_POST['simpan'])) {
    if (insertDataPengguna($_POST) > 0) {
        $_SESSION['inserted'] = true;
        echo "<script>window.location.href = 'pengguna.php'</script>";
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
        <h1 class="h3 mb-0 text-gray-800">User</h1>
        <a class="btn btn-secondary" href="pengguna.php"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add User</h6>
        </div>
        <div class="row card-body align-items-center">
            <div class="col-md text-center">
                <img src="../assets/img/undraw_add_user_re_5oib.svg" alt="" style="width: 350px;">
            </div>
            <div class="col-md">
                <form action="" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nama" placeholder="" name="nama" required>
                        <label for="nama">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" placeholder="" name="username" required>
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" placeholder="" name="password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="outlet" aria-label="Floating label select example" name="outlet" required>
                            <option selected>Pilih outlet</option>
                            <?php foreach ($outlet as $o) : ?>
                                <option value="<?= $o['id']; ?>"><?= $o['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="outlet">Outlet</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="role" aria-label="Floating label select example" name="role" required>
                            <option selected>Select role</option>
                            <option value="admin">Admin</option>
                            <option value="kasir">Cashier</option>
                            <option value="owner">Owner</option>
                        </select>
                        <label for="role">Role</label>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" name="simpan">Simpan</button>
                </form>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
<?php include '../templates/footer.php'; ?>