<?php
$title = 'Pelanggan';
include '../templates/header.php';

$pelanggan = query("SELECT * FROM tb_member");

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
        echo '<div class="alert alert-danger">Data delation failed!</div>';
        unset($_SESSION['notDeleted']);
    }
    ?>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customer</h1>
        <a class="btn btn-primary" href="tambah_pelanggan.php"><i class="fas fa-plus mr-2"></i>Add Customer</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Customer Data</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Mobile Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Mobile Number</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pelanggan as $p) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $p['nama']; ?></td>
                                <td><?= $p['alamat']; ?></td>
                                <td><?= ($p['jenis_kelamin'] == 'L') ? 'Male' : 'Female'; ?></td>
                                <td><?= $p['tlp']; ?></td>
                                <td>
                                    <a class="btn btn-sm btn-warning" href="edit_pelanggan.php?id=<?= $p['id']; ?>"><i class="fa fa-edit"></i></a>
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
        $('#tombolHapus').attr('href', 'hapus_pelanggan.php?id=' + $(this).data('id'));
    });
</script>
<?php include '../templates/footer.php'; ?>