<?php
include 'konfigurasi.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: auth-login.php");
}

if ($_GET['order-vendor'] != 'active') {
    session_start();
    session_destroy();

    header("Location: auth-login.php");
}

if (isset($_POST['submit'])) {
    $nama_vendor = $_POST['nama_vendor'];
    $created_at = date("Y-m-d h:i:s");

    $sql = "INSERT INTO tbl_order_vendor (nama_vendor, created_at)
            VALUES ('$nama_vendor', '$created_at')";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        $_SESSION['pesannya'] = '<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> Data berhasil ditambahkan.</div>';
        header('Location: order-vendor.php?order-vendor=active');
    } else {
        // var_dump("Error: " . $sql . "<br>" . mysqli_error($conn));
        mysqli_close($conn);
        $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Data gagal ditambahkan.</div>';
        header('Location: order-vendor.php?order-vendor=active');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<?php include 'header.php'; ?>

<body>
    <div id="app">
        <?php include 'sidebar.php'; ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Tambah Order Vendor</h3>
            </div>
            <section class="section">
                <div class="row" id="table-hover-row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form" method="POST" action="" data-parsley-validate>
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="nama-vendor-column">Nama Vendor</label>
                                                    <input type="text" id="nama-vendor-column" class="form-control" placeholder="Masukkan nama vendor" name="nama_vendor" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button name="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                                <a href="order-vendor.php?order-vendor=active" class="btn btn-light-secondary me-1 mb-1">Batal</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <?php include 'footer.php'; ?>
        </div>
    </div>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/extensions/jquery/jquery.min.js"></script>
    <script src="assets/extensions/parsleyjs/parsley.min.js"></script>
    <script src="assets/js/pages/parsley.js"></script>

</body>

</html>