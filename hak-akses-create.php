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
    $nama_hak_akses = $_POST['nama_hak_akses'];
    $create = $_POST['create'];
    $read = $_POST['read'];
    $update = $_POST['update'];
    $delete = $_POST['delete'];
    $created_at = date("Y-m-d h:i:s");

    $sql = "INSERT INTO tbl_hak_akses (nama_hak_akses, `create`, `read`, `update`, `delete`, created_at)
            VALUES ('$nama_hak_akses', $create, $read, $update, $delete, '$created_at')";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        session_start();
        $_SESSION['pesannya'] = '<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> Data berhasil ditambahkan.</div>';
        header('Location: hak-akses.php?hak-akses=active');
    } else {
        // var_dump("Error: " . $sql . "<br>" . mysqli_error($conn));
        mysqli_close($conn);
        session_start();
        $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Data gagal ditambahkan.</div>';
        header('Location: hak-akses.php?hak-akses=active');
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
                <h3>Tambah Hak Akses</h3>
            </div>
            <section class="section">
                <div class="row" id="table-hover-row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form" method="POST" action="">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="nama-hak-akses-column">Nama Hak Akses</label>
                                                    <input type="text" id="nama-hak-akses-column" class="form-control" placeholder="Masukkan nama hak akses" name="nama_hak_akses">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="create-column">Buat</label>
                                                    <select class="choices form-select" name="create">
                                                        <option value="" selected disabled>-- Pilih --</option>
                                                        <option value="1">Iya</option>
                                                        <option value="0">Tidak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="read-column">Lihat</label>
                                                    <select class="choices form-select" name="read">
                                                        <option value="" selected disabled>-- Pilih --</option>
                                                        <option value="1">Iya</option>
                                                        <option value="0">Tidak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="update-column">Edit</label>
                                                    <select class="choices form-select" name="update">
                                                        <option value="" selected disabled>-- Pilih --</option>
                                                        <option value="1">Iya</option>
                                                        <option value="0">Tidak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="delete-column">Hapus</label>
                                                    <select class="choices form-select" name="delete">
                                                        <option value="" selected disabled>-- Pilih --</option>
                                                        <option value="1">Iya</option>
                                                        <option value="0">Tidak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button name="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
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

    <script src="assets/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="assets/js/pages/form-element-select.js"></script>

</body>

</html>