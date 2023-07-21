<?php
include 'konfigurasi.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: auth-login.php");
}

if ($_GET['mobil'] != 'active') {
    header("Location: error-404.php");
}

if (isset($_POST['submit'])) {
    $pabrikan = !empty($_POST['pabrikan']) ? $_POST['pabrikan'] : 'null';
    $merek = !empty($_POST['merek']) ? $_POST['merek'] : 'null';
    $tahun = !empty($_POST['tahun']) ? $_POST['tahun'] : 'null';
    $nomor_rangka = !empty($_POST['nomor_rangka']) ? $_POST['nomor_rangka'] : 'null';
    $nomor_mesin = !empty($_POST['nomor_mesin']) ? $_POST['nomor_mesin'] : 'null';
    $nopol = !empty($_POST['nopol']) ? $_POST['nopol'] : 'null';
    $pemilik = !empty($_POST['pemilik']) ? $_POST['pemilik'] : 'null';
    $alamat = !empty($_POST['alamat']) ? $_POST['alamat'] : 'null';
    $kantor = !empty($_POST['kantor']) ? $_POST['kantor'] : 'null';
    $harga_perbulan = !empty($_POST['harga_perbulan']) ? $_POST['harga_perbulan'] : 'null';
    $harga_perminggu = !empty($_POST['harga_perminggu']) ? $_POST['harga_perminggu'] : 'null';
    $harga_perhari = !empty($_POST['harga_perhari']) ? $_POST['harga_perhari'] : 'null';
    $harga_perjam = !empty($_POST['harga_perjam']) ? $_POST['harga_perjam'] : 'null';
    $status = !empty($_POST['status']) ? $_POST['status'] : 'null';
    $created_at = date("Y-m-d h:i:s");

    $sql = "INSERT INTO tbl_mobil (pabrikan, merek, tahun, nomor_rangka, nomor_mesin, nopol, pemilik, alamat, kantor, harga_perbulan, harga_perminggu, harga_perhari, harga_perjam, `status`, created_at)
            VALUES ($pabrikan, '$merek', $tahun, '$nomor_rangka', '$nomor_mesin', '$nopol', '$pemilik', '$alamat', $kantor, $harga_perbulan, $harga_perminggu, $harga_perhari, $harga_perjam, '$status', '$created_at')";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        $_SESSION['pesannya'] = '<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> Data berhasil ditambahkan.</div>';
        header('Location: mobil.php?mobil=active');
    } else {
        // echo '<script>alert("'.$sql.'")</script>';
        var_dump("Error: " . $sql . "<br>" . mysqli_error($conn));
        mysqli_close($conn);
        $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Data gagal ditambahkan.</div>';
        // header('Location: mobil.php?mobil=active');
    }
}

$sql_kantor = "SELECT * FROM tbl_kantor";
$result_kantor = mysqli_query($conn, $sql_kantor);

$sql_pabrikan = "SELECT * FROM tbl_pabrikan";
$result_pabrikan = mysqli_query($conn, $sql_pabrikan);

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
                <h3>Tambah Mobil</h3>
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
                                                    <label for="pabrikan-column">Pabrikan</label>
                                                    <select class="form-select" id="pabrikan-column" name="pabrikan" data-parsley-required="true">
                                                        <option value="" selected disabled>-- Pilih --</option>
                                                        <?php
                                                        while ($row_pabrikan = mysqli_fetch_array($result_pabrikan)) {
                                                            echo "<option value='" . $row_pabrikan['id'] . "'>" . $row_pabrikan['pabrikan'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="merek-mobil-column">Merek Mobil</label>
                                                    <input type="text" id="merek-mobil-column" class="form-control" placeholder="Masukkan merek mobil" name="merek" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="tahun-mobil-column">Tahun Mobil</label>
                                                    <input type="number" id="tahun-mobil-column" class="form-control" placeholder="Masukkan tahun mobil" name="tahun" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="nomor-rangka-column">Nomor Rangka</label>
                                                    <input type="number" id="nomor-rangka-column" class="form-control" placeholder="Masukkan nomor rangka" name="nomor_rangka" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="nomor-mesin-column">Nomor Mesin</label>
                                                    <input type="number" id="nomor-mesin-column" class="form-control" placeholder="Masukkan nomor mesin" name="nomor_mesin" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="nopol-mobil-column">Nopol</label>
                                                    <input type="text" id="nopo-mobil-column" class="form-control" placeholder="Masukkan nopol mobil" name="nopol" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="pemilik-mobil-column">Pemilik</label>
                                                    <input type="text" id="pemilik-mobil-column" class="form-control" placeholder="Masukkan pemilik mobil" name="pemilik" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="alamat-pemilik-column">Alamat</label>
                                                    <input type="text" id="alamat-pemilik-column" class="form-control" placeholder="Masukkan alamat pemilik" name="alamat" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="kantor-column">Kantor</label>
                                                    <select class="form-select" id="kantor-column" name="kantor" data-parsley-required="true">
                                                        <option value="" selected disabled>-- Pilih --</option>
                                                        <?php
                                                        while ($row_kantor = mysqli_fetch_array($result_kantor)) {
                                                            echo "<option value='" . $row_kantor['id'] . "'>" . $row_kantor['nama_kantor'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="harga-perbulan-column">Harga Sewa Perbulan</label>
                                                    <input type="number" id="harga-perbulan-column" class="form-control" placeholder="Masukkan harga sewa perbulan" name="harga_perbulan" data-parsley-required="false">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="harga-perminggu-column">Harga Sewa Perminggu</label>
                                                    <input type="number" id="harga-perminggu-column" class="form-control" placeholder="Masukkan harga sewa perminggu" name="harga_perminggu" data-parsley-required="false">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="harga-perhari-column">Harga Sewa Perhari</label>
                                                    <input type="number" id="harga-perhari-column" class="form-control" placeholder="Masukkan harga sewa perhari" name="harga_perhari" data-parsley-required="false">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="harga-perjam-column">Harga Sewa Perjam</label>
                                                    <input type="number" id="harga-perjam-column" class="form-control" placeholder="Masukkan harga sewa perjam" name="harga_perjam" data-parsley-required="false">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="status-column">Status</label>
                                                    <select class="form-select" id="status-column" name="status" data-parsley-required="true">
                                                        <option value="" selected disabled>-- Pilih --</option>
                                                        <option value="Disewakan">Disewakan</option>
                                                        <option value="Dikantor">Dikantor</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button name="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                                <a href="mobil.php?mobil=active" class="btn btn-light-secondary me-1 mb-1">Batal</a>
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