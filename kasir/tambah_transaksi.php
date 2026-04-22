<?php
$title = 'Transaksi';
include '../templates/header.php';

$idTerbesar = query("SELECT MAX(id) AS idTerbesar FROM tb_transaksi")[0];
$idTransaksi = $idTerbesar['idTerbesar'] + 1;

$outlet = query("SELECT id, nama FROM tb_outlet");
$member = query("SELECT id, nama FROM tb_member");
$user = query("SELECT id, nama FROM tb_user");
$paket = query("SELECT id, nama_paket, harga FROM tb_paket");

if (isset($_POST['simpan'])) {
    // var_dump($_POST);
    if (insertDataTransaksi($_POST) > 0) {
        $_SESSION['inserted'] = true;
        echo "<script>window.location.href = 'transaksi.php'</script>";
    } else {
        $_SESSION['notInserted'] = true;
    }
}
?>
<?php include '../templates/kasir/navbar.php'; ?>
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
        <h1 class="h3 mb-0 text-gray-800">Transaction</h1>
        <a class="btn btn-secondary" href="transaksi.php"><i class="fas fa-arrow-left mr-2"></i>Back</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Transaction</h6>
        </div>
        <form action="" method="post">
            <input type="hidden" name="idTransaksi" value="<?= $idTransaksi; ?>">
            <div class="row card-body">
                <div class="col-md">
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
                        <input type="text" class="form-control" id="invoice" placeholder="" name="invoice" readonly value="<?= date('YmdHis'); ?>">
                        <label for="invoice">Invoice Code</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="member" aria-label="Floating label select example" name="member" required>
                            <option selected disabled>Select Member</option>
                            <?php foreach ($member as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="member">Member</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="tgl" placeholder="" name="tgl" readonly value="<?= date('Y-m-d'); ?>">
                        <label for="tgl">Transaction Date</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="batas" placeholder="" name="batas" required>
                        <label for="batas">Deadline</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="tglBayar" placeholder="" name="tglBayar">
                        <label for="tglBayar">Payment Date</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="tambahan" placeholder="" name="tambahan" required>
                        <label for="tambahan">Additional Cost</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="dibayar" aria-label="Floating label select example" name="dibayar" required>
                            <option value="belum dibayar" selected>Not yet paid</option>
                            <option value="dibayar">Paid</option>
                        </select>
                        <label for="dibayar">Payment Status</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="user" aria-label="Floating label select example" name="user" required>
                            <option selected disabled>Select User</option>
                            <?php foreach ($user as $u) : ?>
                                <option value="<?= $u['id']; ?>"><?= $u['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="user">Officer</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="paket" aria-label="Floating label select example" name="paket" required>
                            <option selected disabled>Select Package</option>
                            <?php foreach ($paket as $p) : ?>
                                <option value="<?= $p['id']; ?>"><?= $p['nama_paket']; ?></option>
                                <input type="hidden" name="harga" value="<?= $p['harga']; ?>">
                            <?php endforeach; ?>
                        </select>
                        <label for="paket">Officer</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="qty" placeholder="" name="qty" required>
                        <label for="qty">Qty</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="keterangan" id="keterangan" class="form-control" placeholder="" required></textarea>
                        <label for="keterangan">Information</label>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" name="simpan">Save</button>
                </div>
            </div>
        </form>
    </div>


</div>
<!-- /.container-fluid -->
<?php include '../templates/footer.php'; ?>