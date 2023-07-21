<?php
include 'konfigurasi.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: auth-login.php");
}

if ($_GET['pelanggan-lain'] != 'active') {
    header("Location: error-404.php");
}

if (isset($_POST['submit'])) {
    $id = !empty($_POST['submit']) ? $_POST['submit'] : 'null';;
    $nama_pelanggan = !empty($_POST['nama_pelanggan']) ? $_POST['nama_pelanggan'] : 'null';
    $nama_rentcar = !empty($_POST['nama_rentcar']) ? $_POST['nama_rentcar'] : 'null';
    $tgl_lahir_pelanggan = !empty($_POST['tgl_lahir_pelanggan']) ? $_POST['tgl_lahir_pelanggan'] : 'null';
    $tempat_lahir_pelanggan = !empty($_POST['tempat_lahir_pelanggan']) ? $_POST['tempat_lahir_pelanggan'] : 'null';
    $jenis_kelamin_pelanggan = !empty($_POST['jenis_kelamin_pelanggan']) ? $_POST['jenis_kelamin_pelanggan'] : 'null';
    $no_telp_pelanggan = !empty($_POST['no_telp_pelanggan']) ? $_POST['no_telp_pelanggan'] : 'null';
    $alamat_pelanggan = !empty($_POST['alamat_pelanggan']) ? $_POST['alamat_pelanggan'] : 'null';
    $kantor = !empty($_POST['kantor']) ? $_POST['kantor'] : 'null';
    $status_pelanggan = !empty($_POST['status_pelanggan']) ? $_POST['status_pelanggan'] : 'null';

    $sql = "UPDATE tbl_pelanggan_rental_lain SET nama_pelanggan = '$nama_pelanggan', nama_rentcar = '$nama_rentcar', tgl_lahir_pelanggan = '$tgl_lahir_pelanggan', tempat_lahir_pelanggan = '$tempat_lahir_pelanggan', jenis_kelamin_pelanggan = '$jenis_kelamin_pelanggan', no_telp_pelanggan = $no_telp_pelanggan, alamat_pelanggan = '$alamat_pelanggan', kantor = $kantor, status_pelanggan = '$status_pelanggan'
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        $_SESSION['pesannya'] = '<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> Data berhasil diperbarui.</div>';
        header('Location: pelanggan-lain.php?pelanggan-lain=active');
    } else {
        // var_dump("Error: " . $sql . "<br>" . mysqli_error($conn));
        mysqli_close($conn);
        $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Data gagal diperbarui.</div>';
        header('Location: pelanggan-lain.php?pelanggan-lain=active');
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['edit'];
    $sql_edit = "SELECT * FROM tbl_pelanggan_rental_lain WHERE id = $id";
    $result = mysqli_query($conn, $sql_edit);
    $row = mysqli_fetch_array($result);

    $sql_kantor = "SELECT * FROM tbl_kantor";
    $result_kantor = mysqli_query($conn, $sql_kantor);
} else {
    header('Location: pelanggan-lain.php?pelanggan-lain=active');
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
                <h3>Edit Pelanggan Rental Lain</h3>
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
                                                    <label for="nama-pelanggan-column">Nama Pelanggan</label>
                                                    <input type="text" id="nama-pelanggan-column" class="form-control" placeholder="Masukkan nama pelanggan" name="nama_pelanggan" data-parsley-required="true" value="<?php echo $row['nama_pelanggan'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="nama-rental-column">Nama Rental</label>
                                                    <input type="text" id="nama-rental-column" class="form-control" placeholder="Masukkan nama rental" name="nama_rentcar" data-parsley-required="true" value="<?php echo $row['nama_rentcar'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="tgl-lahir-column">Tgl Lahir Pelanggan</label>
                                                    <input type="date" id="tgl-lahir-column" class="form-control" placeholder="Masukkan tgl lahir pelanggan" name="tgl_lahir_pelanggan" data-parsley-required="true" value="<?php echo $row['tgl_lahir_pelanggan'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="tempat-lahir-column">Tempat Lahir Pelanggan</label>
                                                    <input type="text" id="tempat-lahir-column" class="form-control" placeholder="Masukkan tempat lahir" name="tempat_lahir_pelanggan" data-parsley-required="true" value="<?php echo $row['tempat_lahir_pelanggan'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="jk-column">Jenis Kelamin Pelanggan</label>
                                                    <select class="form-select" id="jk-column" name="jenis_kelamin_pelanggan" data-parsley-required="true">
                                                        <option value="" disabled>-- Pilih --</option>
                                                        <option <?php echo ($row['jenis_kelamin_pelanggan'] == 'Laki-laki' ? 'selected' : '' ) ?> value="Laki-laki">Laki-laki</option>
                                                        <option <?php echo ($row['jenis_kelamin_pelanggan'] == 'Perempuan' ? 'selected' : '' ) ?> value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="no-telp-column">No Telp Pelanggan</label>
                                                    <input type="number" id="no-telp-column" class="form-control" placeholder="Masukkan nomor telp pelanggan" name="no_telp_pelanggan" data-parsley-required="true" value="<?php echo $row['no_telp_pelanggan'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="alamat-pelanggan-column">Alamat Pelanggan</label>
                                                    <input type="text" id="alamat-pelanggan-column" class="form-control" placeholder="Masukkan alamat pelanggan" name="alamat_pelanggan" data-parsley-required="true" value="<?php echo $row['alamat_pelanggan'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="status-column">Status</label>
                                                    <select class="form-select" id="status-column" name="status_pelanggan" data-parsley-required="true">
                                                        <option value="" disabled>-- Pilih --</option>
                                                        <option <?php echo ($row['status_pelanggan'] == 'Aktif' ? 'selected' : '' ) ?> value="Aktif">Aktif</option>
                                                        <option <?php echo ($row['status_pelanggan'] == 'Blokir' ? 'selected' : '' ) ?> value="Blokir">Blokir</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="kantor-column">Kantor</label>
                                                    <select class="form-select" id="kantor-column" name="kantor" data-parsley-required="true">
                                                        <option value="" disabled>-- Pilih --</option>
                                                        <?php
                                                        while ($row_kantor = mysqli_fetch_array($result_kantor)) {
                                                            echo "<option " . ($row_kantor['id'] == $row['kantor'] ? "selected" : "") . " value='" . $row_kantor['id'] . "'>" . $row_kantor['nama_kantor'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button name="submit" value="<?php echo $row['id']; ?>" class="btn btn-primary me-1 mb-1">Simpan</button>
                                                <a href="pelanggan-lain.php?pelanggan-lain=active" class="btn btn-light-secondary me-1 mb-1">Batal</a>
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