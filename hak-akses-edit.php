<?php
include 'konfigurasi.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: auth-login.php");
}

if ($_GET['hak-akses'] != 'active') {
    session_start();
    session_destroy();

    header("Location: auth-login.php");
}

if (isset($_POST['submit'])) {
    $id = $_POST['submit'];
    $nama_hak_akses = $_POST['nama_hak_akses'];
    $create = $_POST['create'];
    $read = $_POST['read'];
    $update = $_POST['update'];
    $delete = $_POST['delete'];

    $sql = "UPDATE tbl_hak_akses SET nama_hak_akses = '$nama_hak_akses', `create` = $create, `read` = $read, `update` = $update, `delete` = $delete
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        $_SESSION['pesannya'] = '<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> Data berhasil diperbarui.</div>';
        header('Location: hak-akses.php?hak-akses=active');
    } else {
        // var_dump("Error: " . $sql . "<br>" . mysqli_error($conn));
        mysqli_close($conn);
        $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Data gagal diperbarui.</div>';
        header('Location: hak-akses.php?hak-akses=active');
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['edit'];
    $sql_edit = "SELECT * FROM tbl_hak_akses WHERE id = $id";
    $result = mysqli_query($conn, $sql_edit);
    $row = mysqli_fetch_array($result);
} else {
    header('Location: hak-akses.php?hak-akses=active');
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
                <h3>Edit Hak Akses</h3>
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
                                                    <label for="nama-hak-akses-column">Nama Hak Akses</label>
                                                    <input type="text" id="nama-hak-akses-column" class="form-control" placeholder="Masukkan nama hak akses" name="nama_hak_akses" data-parsley-required="true" value="<?php echo $row['nama_hak_akses'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="create-column">Buat</label>
                                                    <select class="form-select" id="create-column" name="create" data-parsley-required="true">
                                                        <option value="" disabled>-- Pilih --</option>
                                                        <option value="1" <?php echo ($row['create'] == 1 ? 'selected' : ''); ?>>Iya</option>
                                                        <option value="0" <?php echo ($row['create'] == 0 ? 'selected' : ''); ?>>Tidak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="read-column">Lihat</label>
                                                    <select class="form-select" id="read-column" name="read" data-parsley-required="true">
                                                        <option value="" disabled>-- Pilih --</option>
                                                        <option value="1" <?php echo ($row['read'] == 1 ? 'selected' : ''); ?>>Iya</option>
                                                        <option value="0" <?php echo ($row['read'] == 0 ? 'selected' : ''); ?>>Tidak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="update-column">Edit</label>
                                                    <select class="form-select" id="update-column" name="update" data-parsley-required="true">
                                                        <option value="" disabled>-- Pilih --</option>
                                                        <option value="1" <?php echo ($row['update'] == 1 ? 'selected' : ''); ?>>Iya</option>
                                                        <option value="0" <?php echo ($row['update'] == 0 ? 'selected' : ''); ?>>Tidak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="delete-column">Hapus</label>
                                                    <select class="form-select" id="delete-column" name="delete" data-parsley-required="true">
                                                        <option value="" disabled>-- Pilih --</option>
                                                        <option value="1" <?php echo ($row['delete'] == 1 ? 'selected' : ''); ?>>Iya</option>
                                                        <option value="0" <?php echo ($row['delete'] == 0 ? 'selected' : ''); ?>>Tidak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button name="submit" value="<?php echo $row['id']; ?>" class="btn btn-primary me-1 mb-1">Simpan</button>
                                                <a href="hak-akses.php?hak-akses=active" class="btn btn-light-secondary me-1 mb-1">Batal</a>
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