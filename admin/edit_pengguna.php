<?php
$title = 'Pengguna';
include '../templates/header.php';

$id = $_GET['id'];
$pengguna = query("SELECT * FROM tb_user WHERE id = $id")[0];
$outlet = query("SELECT id, nama FROM tb_outlet");

if (isset($_POST['update'])) {
    if (updateDataPengguna($_POST) > 0) {
        $_SESSION['updated'] = true;
        echo "<script>window.location.href = 'pengguna.php'</script>";
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
        <h1 class="h3 mb-0 text-gray-800">User</h1>
        <a class="btn btn-secondary" href="pengguna.php"><i class="fas fa-arrow-left mr-2"></i>Back</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
        </div>
        <div class="row card-body align-items-center">
            <div class="col-md text-center">
                <img src="../assets/img/undraw_text_field_htlv.svg" alt="" style="width: 350px;">
            </div>
            <div class="col-md">
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $pengguna['id']; ?>">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nama" placeholder="" name="nama" value="<?= $pengguna['nama']; ?>" required>
                        <label for="nama">nama_outlet</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" placeholder="" name="username" value="<?= $pengguna['username']; ?>" readonly>
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="outlet" aria-label="Floating label select example" name="outlet" required>
                            <option selected>Select outlet</option>
                            <?php foreach ($outlet as $o) : ?>
                                <option value="<?= $o['id']; ?>" <?= ($pengguna['id_outlet'] == $o['id']) ? 'selected' : ''; ?>><?= $o['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="outlet">Outlet</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="role" aria-label="Floating label select example" name="role" required>
                            <option selected>Select role</option>
                            <option value="admin" <?= ($pengguna['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                            <option value="kasir" <?= ($pengguna['role'] == 'kasir') ? 'selected' : ''; ?>>Cashier</option>
                            <option value="owner" <?= ($pengguna['role'] == 'owner') ? 'selected' : ''; ?>>Owner</option>
                        </select>
                        <label for="role">Role</label>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" name="update">Update</button>
                </form>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
<?php include '../templates/footer.php'; ?>