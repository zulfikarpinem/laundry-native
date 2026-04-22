<?php
$title = 'Pengguna';
include '../templates/header.php';

$pengguna = query("SELECT tb_user.*, tb_outlet.nama AS nama_outlet FROM tb_user, tb_outlet WHERE tb_user.id_outlet = tb_outlet.id");

?>
<?php include '../templates/admin/navbar.php'; ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php
    if (isset($_SESSION['inserted'])) {
        echo '<div class="alert alert-success">Data added successfully!</div>';
        unset($_SESSION['inserted']);
    } elseif (isset($_SESSION['updated'])) {
        echo '<div class="alert alert-success">Data changed successfully!</div>';
        unset($_SESSION['updated']);
    } elseif (isset($_SESSION['deleted'])) {
        echo '<div class="alert alert-success">Data deleted successfully!</div>';
        unset($_SESSION['deleted']);
    } elseif (isset($_SESSION['notDeleted'])) {
        echo '<div class="alert alert-danger">Data deletion failed!</div>';
        unset($_SESSION['notDeleted']);
    }
    ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User</h1>
        <a class="btn btn-primary" href="tambah_pengguna.php"><i class="fas fa-plus mr-2"></i>Add User</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Data</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Outlet</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Outlet</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pengguna as $p) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $p['nama']; ?></td>
                                <td><?= $p['username']; ?></td>
                                <td><?= $p['nama_outlet']; ?></td>
                                <td>
                                    <a class="btn btn-sm btn-warning" href="edit_pengguna.php?id=<?= $p['id']; ?>"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusModal" data-id="<?= $p['id']; ?>" id="tombolModalHapus"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

<!-- Hapus Modal-->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusModalLabel">Are you sure you want to delete this data?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Click the delete button to delete.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="" id="tombolHapus">Accept</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '#tombolModalHapus', function() {
        $('#tombolHapus').attr('href', 'hapus_pengguna.php?id=' + $(this).data('id'));
    });
</script>
<?php include '../templates/footer.php'; ?>