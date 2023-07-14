<?php
include 'konfigurasi.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: auth-login.php");
}

if ($_GET['pengguna'] != 'active') {
    session_start();
    session_destroy();

    header("Location: auth-login.php");
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $kantor = $_POST['kantor'];
    $akses = $_POST['akses'];
    $created_at = date("Y-m-d h:i:s");

    $sql = "INSERT INTO tbl_pengguna (nama, alamat, email, `password`, kantor, akses, created_at)
            VALUES ('$nama', '$alamat', '$email', '$password', $kantor, $akses, '$created_at')";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        $_SESSION['pesannya'] = '<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> Data berhasil ditambahkan.</div>';
        header('Location: pengguna.php?pengguna=active');
    } else {
        // var_dump("Error: " . $sql . "<br>" . mysqli_error($conn));
        mysqli_close($conn);
        $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Data gagal ditambahkan.</div>';
        header('Location: pengguna.php?pengguna=active');
    }
}

$sql_kantor = "SELECT * FROM tbl_kantor";
$result_kantor = mysqli_query($conn, $sql_kantor);

$sql_akses = "SELECT * FROM tbl_hak_akses";
$result_akses = mysqli_query($conn, $sql_akses);

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
                <h3>Tambah Pengguna</h3>
            </div>
            <section class="section">
                <div class="row" id="table-hover-row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form" method="POST" action="" data-parsley-validate>
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="nama-pengguna-column">Nama Pengguna</label>
                                                    <input type="text" id="nama-pengguna-column" class="form-control" placeholder="Masukkan nama pengguna" name="nama" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="alamat-pengguna-column">Alamat Pengguna</label>
                                                    <input type="text" id="alamat-pengguna-column" class="form-control" placeholder="Masukkan alamat pengguna" name="alamat" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email-pengguna-column">Email Pengguna</label>
                                                    <input type="email" id="email-pengguna-column" class="form-control" placeholder="Masukkan email pengguna" name="email" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="password-pengguna-column">Password Pengguna</label>
                                                    <input type="password" id="password-pengguna-column" class="form-control" placeholder="Masukkan password pengguna" name="password" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="kantor-column">Kantor</label>
                                                    <select class="form-select" id="kantor-column" name="kantor" data-parsley-required="true">
                                                        <option value="" selected disabled>-- Pilih --</option>
                                                        <?php
                                                            while ($row_kantor = mysqli_fetch_array($result_kantor)) {
                                                                echo "<option value='".$row_kantor['id']."'>".$row_kantor['nama_kantor']."</option>";
                                                            } 
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="akses-column">Akses</label>
                                                    <select class="form-select" id="akses-column" name="akses" data-parsley-required="true">
                                                        <option value="" selected disabled>-- Pilih --</option>
                                                        <?php
                                                            while ($row_akses = mysqli_fetch_array($result_akses)) {
                                                                echo "<option value='".$row_akses['id']."'>".$row_akses['nama_hak_akses']."</option>";
                                                            } 
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button name="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                                <a href="pengguna.php?pengguna=active" class="btn btn-light-secondary me-1 mb-1">Batal</a>
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