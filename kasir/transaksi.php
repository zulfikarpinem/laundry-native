<?php
$title = 'Transaksi';
include '../templates/header.php';

$transaksi = query("SELECT tb_transaksi.*, tb_outlet.id AS outlet_id, tb_outlet.nama AS outlet_nama, tb_member.id AS member_id, tb_member.nama AS member_nama, tb_user.id AS user_id, tb_user.nama AS user_nama FROM tb_transaksi, tb_outlet, tb_member, tb_user WHERE tb_transaksi.id_outlet = tb_outlet.id AND tb_transaksi.id_member = tb_member.id AND tb_transaksi.id_user = tb_user.id");

?>
<?php include '../templates/kasir/navbar.php'; ?>
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
        <h1 class="h3 mb-0 text-gray-800">Transaction</h1>
        <a class="btn btn-primary" href="tambah_transaksi.php"><i class="fas fa-plus mr-2"></i>Add Transaction</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Outlet</th>
                            <th>Invoice Code</th>
                            <th>Member Name</th>
                            <th>Transaction Date</th>
                            <th>Deadline</th>
                            <th>Payment Date</th>
                            <th>Additional Cost</th>
                            <th>Discount</th>
                            <th>Tax</th>
                            <th>Status</th>
                            <th>Paid</th>
                            <th>Officer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Outlet</th>
                            <th>Invoice Code</th>
                            <th>Member Name</th>
                            <th>Transaction Date</th>
                            <th>Deadline</th>
                            <th>Payment Date</th>
                            <th>Additional Cost</th>
                            <th>Discount</th>
                            <th>Tax</th>
                            <th>Status</th>
                            <th>Paid</th>
                            <th>Officer</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($transaksi as $t) : ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $t['outlet_nama']; ?></td>
                                <td><?= $t['kode_invoice']; ?></td>
                                <td><?= $t['member_nama']; ?></td>
                                <td><?= $t['tgl']; ?></td>
                                <td><?= $t['batas_waktu']; ?></td>
                                <td><?= $t['tgl_bayar']; ?></td>
                                <td>Rp<?= number_format($t['biaya_tambahan'], 0, ',', '.'); ?></td>
                                <td>Rp<?= number_format($t['diskon'], 0, ',', '.'); ?></td>
                                <td>Rp<?= number_format($t['pajak'], 0, ',', '.'); ?></td>
                                <td><?php
                                    if ($t['status'] == 'baru') {
                                        echo '<span class="badge badge-primary">' . $t['status'] . '</span>';
                                    } elseif ($t['status'] == 'proses') {
                                        echo '<span class="badge badge-warning">' . $t['status'] . '</span>';
                                    } elseif ($t['status'] == 'selesai') {
                                        echo '<span class="badge badge-info">' . $t['status'] . '</span>';
                                    } elseif ($t['status'] == 'diambil') {
                                        echo '<span class="badge badge-success">' . $t['status'] . '</span>';
                                    }
                                    ?></td>
                                <td><?php
                                    if ($t['dibayar'] == 'dibayar') {
                                        echo '<span class="badge badge-success">' . $t['dibayar'] . '</span>';
                                    } elseif ($t['dibayar'] == 'belum dibayar') {
                                        echo '<span class="badge badge-danger">' . $t['dibayar'] . '</span>';
                                    }
                                    ?></td>
                                <td><?= $t['user_nama']; ?></td>
                                <td>
                                    <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal<?= $t['id']; ?>" id="tombolModalDetail"><i class="far fa-file-alt"></i></a>
                                    <a class="btn btn-sm btn-warning" href="proses_transaksi.php?id=<?= $t['id']; ?>"><i class="fas fa-sync"></i></a>
                                    <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusModal" data-id="<?= $t['id']; ?>" id="tombolModalHapus"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php
                            $detail = query("SELECT tb_detail_transaksi.*, tb_paket.nama_paket, tb_paket.harga FROM tb_detail_transaksi, tb_paket WHERE id_transaksi = $t[id] AND tb_detail_transaksi.id_paket = tb_paket.id");
                            ?>
                            <?php foreach ($detail as $d) : ?>
                                <?php
                                $harga = ($d['harga'] * $d['qty'] - $t['diskon']) + $t['biaya_tambahan'] + $t['pajak'];
                                ?>
                                <!-- Detail Modal-->
                                <div class="modal fade" id="detailModal<?= $t['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModalLabel">Detail Transaksi</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <p>Nama Paket :</p>
                                                    <p><?= $d['nama_paket']; ?></p>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <p>Jumlah :</p>
                                                    <p><?= $d['qty']; ?></p>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <p>Harga :</p>
                                                    <p>Rp<?= number_format($harga, 0, ',', '.'); ?></p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
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
                <h5 class="modal-title" id="hapusModalLabel">Yakin ingin menghapus data ini?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Klik tombol hapus untuk menghapus.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger" href="" id="tombolHapus">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '#tombolModalHapus', function() {
        $('#tombolHapus').attr('href', 'hapus_transaksi.php?id=' + $(this).data('id'));
    });
</script>
<?php include '../templates/footer.php'; ?>