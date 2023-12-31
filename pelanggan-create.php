<?php
include 'konfigurasi.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: auth-login.php");
}

if ($_GET['pelanggan'] != 'active') {
    header("Location: error-404.php");
}

if (isset($_POST['submit'])) {
    $rand = time();
    $syarat_ekstensi =  array('png','jpg','jpeg');

    $nama_pelanggan = !empty($_POST['nama_pelanggan']) ? $_POST['nama_pelanggan'] : 'null';
    $tgl_lahir_pelanggan = !empty($_POST['tgl_lahir_pelanggan']) ? $_POST['tgl_lahir_pelanggan'] : 'null';
    $tempat_lahir_pelanggan = !empty($_POST['tempat_lahir_pelanggan']) ? $_POST['tempat_lahir_pelanggan'] : 'null';
    $jenis_kelamin_pelanggan = !empty($_POST['jenis_kelamin_pelanggan']) ? $_POST['jenis_kelamin_pelanggan'] : 'null';
    $no_telp_pelanggan = !empty($_POST['no_telp_pelanggan']) ? $_POST['no_telp_pelanggan'] : 'null';
    $alamat_pelanggan = !empty($_POST['alamat_pelanggan']) ? $_POST['alamat_pelanggan'] : 'null';
    if(!empty($_FILES['gambar1']['name'])){
        $gambar1_name = $_FILES['gambar1']['name'];
        $gambar1_size = $_FILES['gambar1']['size'];
        $gambar1_ext = pathinfo($gambar1_name, PATHINFO_EXTENSION);
        $gambar1 = 'gambar/gambar1_' . $rand . '.' . $gambar1_ext; 
        if (!in_array($gambar1_ext, $syarat_ekstensi)) {
            $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Ekstensi file tidak sesuai.</div>';
            header('Location: pelanggan.php?pelanggan=active');
            exit();
        } else {
            if ($gambar1_size > 1044070) {
                $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Ukuran file tidak boleh lebih dari 1MB.</div>';
                header('Location: pelanggan.php?pelanggan=active');
                exit();
            }
        }
    } else {
        $gambar1 = 'null';
    }
    $keterangan_gambar1 = !empty($_POST['keterangan_gambar1']) ? $_POST['keterangan_gambar1'] : 'null';
    if(!empty($_FILES['gambar2']['name'])){
        $gambar2_name = $_FILES['gambar2']['name'];
        $gambar2_size = $_FILES['gambar2']['size'];
        $gambar2_ext = pathinfo($gambar2_name, PATHINFO_EXTENSION);
        $gambar2 = 'gambar/gambar2_' . $rand . '.' . $gambar2_ext; 
        if (!in_array($gambar2_ext, $syarat_ekstensi)) {
            $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Ekstensi file tidak sesuai.</div>';
            header('Location: pelanggan.php?pelanggan=active');
            exit();
        } else {
            if ($gambar2_size > 1044070) {
                $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Ukuran file tidak boleh lebih dari 1MB.</div>';
                header('Location: pelanggan.php?pelanggan=active');
                exit();
            }
        }
    } else {
        $gambar2 = 'null';
    }
    $keterangan_gambar2 = !empty($_POST['keterangan_gambar2']) ? $_POST['keterangan_gambar2'] : 'null';
    if(!empty($_FILES['gambar3']['name'])){
        $gambar3_name = $_FILES['gambar3']['name'];
        $gambar3_size = $_FILES['gambar3']['size'];
        $gambar3_ext = pathinfo($gambar3_name, PATHINFO_EXTENSION);
        $gambar3 = 'gambar/gambar3_' . $rand . '.' . $gambar3_ext; 
        if (!in_array($gambar3_ext, $syarat_ekstensi)) {
            $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Ekstensi file tidak sesuai.</div>';
            header('Location: pelanggan.php?pelanggan=active');
            exit();
        } else {
            if ($gambar3_size > 1044070) {
                $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Ukuran file tidak boleh lebih dari 1MB.</div>';
                header('Location: pelanggan.php?pelanggan=active');
                exit();
            }
        }
    } else {
        $gambar3 = 'null';
    }
    $keterangan_gambar3 = !empty($_POST['keterangan_gambar3']) ? $_POST['keterangan_gambar3'] : 'null';
    if(!empty($_FILES['gambar4']['name'])){
        $gambar4_name = $_FILES['gambar4']['name'];
        $gambar4_size = $_FILES['gambar4']['size'];
        $gambar4_ext = pathinfo($gambar4_name, PATHINFO_EXTENSION);
        $gambar4 = 'gambar/gambar4_' . $rand . '.' . $gambar4_ext; 
        if (!in_array($gambar4_ext, $syarat_ekstensi)) {
            $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Ekstensi file tidak sesuai.</div>';
            header('Location: pelanggan.php?pelanggan=active');
            exit();
        } else {
            if ($gambar4_size > 1044070) {
                $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Ukuran file tidak boleh lebih dari 1MB.</div>';
                header('Location: pelanggan.php?pelanggan=active');
                exit();
            }
        }
    } else {
        $gambar4 = 'null';
    }
    $keterangan_gambar4 = !empty($_POST['keterangan_gambar4']) ? $_POST['keterangan_gambar4'] : 'null';
    if(!empty($_FILES['gambar5']['name'])){
        $gambar5_name = $_FILES['gambar5']['name'];
        $gambar5_size = $_FILES['gambar5']['size'];
        $gambar5_ext = pathinfo($gambar5_name, PATHINFO_EXTENSION);
        $gambar5 = 'gambar/gambar5_' . $rand . '.' . $gambar5_ext; 
        if (!in_array($gambar5_ext, $syarat_ekstensi)) {
            $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Ekstensi file tidak sesuai.</div>';
            header('Location: pelanggan.php?pelanggan=active');
            exit();
        } else {
            if ($gambar5_size > 1044070) {
                $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Ukuran file tidak boleh lebih dari 1MB.</div>';
                header('Location: pelanggan.php?pelanggan=active');
                exit();
            }
        }
    } else {
        $gambar5 = 'null';
    }
    $keterangan_gambar5 = !empty($_POST['keterangan_gambar5']) ? $_POST['keterangan_gambar5'] : 'null';
    if (!empty($_FILES['gambar6']['name'])) {
        $gambar6_name = $_FILES['gambar6']['name'];
        $gambar6_size = $_FILES['gambar6']['size'];
        $gambar6_ext = pathinfo($gambar6_name, PATHINFO_EXTENSION);
        $gambar6 = 'gambar/gambar6_' . $rand  . '.' . $gambar6_ext; 
        if (!in_array($gambar5_ext, $syarat_ekstensi)) {
            $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Ekstensi file tidak sesuai.</div>';
            header('Location: pelanggan.php?pelanggan=active');
            exit();
        } else {
            if ($gambar5_size > 1044070) {
                $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Ukuran file tidak boleh lebih dari 1MB.</div>';
                header('Location: pelanggan.php?pelanggan=active');
                exit();
            }
        }
    } else {
        $gambar6 = 'null';
    }
    $keterangan_gambar6 = !empty($_POST['keterangan_gambar6']) ? $_POST['keterangan_gambar6'] : 'null';
    $kantor = !empty($_POST['kantor']) ? $_POST['kantor'] : 'null';
    $status_pelanggan = !empty($_POST['status_pelanggan']) ? $_POST['status_pelanggan'] : 'null';
    $created_at = date("Y-m-d h:i:s");

    $sql = "INSERT INTO tbl_pelanggan (nama_pelanggan, tgl_lahir_pelanggan, tempat_lahir_pelanggan, jenis_kelamin_pelanggan, no_telp_pelanggan, alamat_pelanggan, gambar1, keterangan_gambar1, gambar2, keterangan_gambar2, gambar3, keterangan_gambar3, gambar4, keterangan_gambar4, gambar5, keterangan_gambar5, gambar6, keterangan_gambar6, kantor, status_pelanggan, created_at)
            VALUES ('$nama_pelanggan', '$tgl_lahir_pelanggan', '$tempat_lahir_pelanggan', '$jenis_kelamin_pelanggan', '$no_telp_pelanggan', '$alamat_pelanggan', '$gambar1', '$keterangan_gambar1', '$gambar2', '$keterangan_gambar2', '$gambar3', '$keterangan_gambar3', '$gambar4', '$keterangan_gambar4', '$gambar5', '$keterangan_gambar5', '$gambar6', '$keterangan_gambar6', $kantor, '$status_pelanggan', '$created_at')";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        if ($gambar1 != 'null') {
            move_uploaded_file($_FILES['gambar1']['tmp_name'], $gambar1);
        }
        if ($gambar2 != 'null') {
            move_uploaded_file($_FILES['gambar2']['tmp_name'], $gambar2);
        }
        if ($gambar3 != 'null') {
            move_uploaded_file($_FILES['gambar3']['tmp_name'], $gambar3);
        }
        if ($gambar4 != 'null') {
            move_uploaded_file($_FILES['gambar4']['tmp_name'], $gambar4);
        }
        if ($gambar5 != 'null') {
            move_uploaded_file($_FILES['gambar5']['tmp_name'], $gambar5);
        }
        if ($gambar6 != 'null') {
            move_uploaded_file($_FILES['gambar6']['tmp_name'], $gambar6);
        }
        $_SESSION['pesannya'] = '<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> Data berhasil ditambahkan.</div>';
        header('Location: pelanggan.php?pelanggan=active');
    } else {
        // var_dump("Error: " . $sql . "<br>" . mysqli_error($conn));
        mysqli_close($conn);
        $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Data gagal ditambahkan.</div>';
        header('Location: pelanggan.php?pelanggan=active');
    }
}

$sql_kantor = "SELECT * FROM tbl_kantor";
$result_kantor = mysqli_query($conn, $sql_kantor);

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
                <h3>Tambah Pelanggan</h3>
            </div>
            <section class="section">
                <div class="row" id="table-hover-row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form" method="POST" action="" enctype="multipart/form-data" data-parsley-validate>
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="nama-pelanggan-column">Nama Pelanggan</label>
                                                    <input type="text" id="nama-pelanggan-column" class="form-control" placeholder="Masukkan nama pelanggan" name="nama_pelanggan" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="tgl-lahir-column">Tgl Lahir Pelanggan</label>
                                                    <input type="date" id="tgl-lahir-column" class="form-control" placeholder="Masukkan tgl lahir pelanggan" name="tgl_lahir_pelanggan" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="tempat-lahir-column">Tempat Lahir Pelanggan</label>
                                                    <input type="text" id="tempat-lahir-column" class="form-control" placeholder="Masukkan tempat lahir" name="tempat_lahir_pelanggan" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="jk-column">Jenis Kelamin Pelanggan</label>
                                                    <select class="form-select" id="jk-column" name="jenis_kelamin_pelanggan" data-parsley-required="true">
                                                        <option value="" selected disabled>-- Pilih --</option>
                                                        <option value="Laki-laki">Laki-laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="no-telp-column">No Telp Pelanggan</label>
                                                    <input type="number" id="no-telp-column" class="form-control" placeholder="Masukkan nomor telp pelanggan" name="no_telp_pelanggan" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="alamat-pelanggan-column">Alamat Pelanggan</label>
                                                    <input type="text" id="alamat-pelanggan-column" class="form-control" placeholder="Masukkan alamat pelanggan" name="alamat_pelanggan" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="gambar1-column">KTP Pelanggan</label>
                                                    <input type="file" id="gambar1-column" class="form-control" placeholder="Masukkan gambar KTP pelanggan" name="gambar1" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="keterangan-gambar1-column">No KTP Pelanggan</label>
                                                    <input type="text" id="keterangan-gambar1-column" class="form-control" placeholder="Masukkan nomor KTP pelanggan" name="keterangan_gambar1" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="gambar2-column">SIM Pelanggan</label>
                                                    <input type="file" id="gambar2-column" class="form-control" placeholder="Masukkan gambar SIM pelanggan" name="gambar2" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="keterangan-gambar2-column">No SIM Pelanggan</label>
                                                    <input type="text" id="keterangan-gambar2-column" class="form-control" placeholder="Masukkan nomor SIM pelanggan" name="keterangan_gambar2" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="gambar3-column">Sosial Media</label>
                                                    <input type="file" id="gambar3-column" class="form-control" placeholder="Masukkan gambar sosial media pelanggan" name="gambar3" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="keterangan-gambar3-column">ID Sosial Media</label>
                                                    <input type="text" id="keterangan-gambar3-column" class="form-control" placeholder="Masukkan ID sosial media pelanggan" name="keterangan_gambar3" data-parsley-required="true">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="gambar4-column">BPJS / NPWP / Asuransi</label>
                                                    <input type="file" id="gambar4-column" class="form-control" placeholder="Masukkan gambar BPJS / NPWP / Asuransi pelanggan" name="gambar4" data-parsley-required="false">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="keterangan-gambar4-column">No BPJS / NPWP / Asuransi</label>
                                                    <input type="text" id="keterangan-gambar4-column" class="form-control" placeholder="Masukkan nomor BPJS / NPWP / Asuransi pelanggan" name="keterangan_gambar4" data-parsley-required="false">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="gambar5-column">KK + ID Pegawai / Kartu Pelajar / Akta Lahir</label>
                                                    <input type="file" id="gambar5-column" class="form-control" placeholder="Masukkan gambar KK + ID Pegawai / Kartu Pelajar / Akta Lahir pelanggan" name="gambar5" data-parsley-required="false">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="keterangan-gambar5-column">No KK + ID Pegawai / Kartu Pelajar / Akta Lahir</label>
                                                    <input type="text" id="keterangan-gambar5-column" class="form-control" placeholder="Masukkan nomor KK + ID Pegawai / Kartu Pelajar / Akta Lahir pelanggan" name="keterangan_gambar5" data-parsley-required="false">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="gambar6-column">Kartu Kredit</label>
                                                    <input type="file" id="gambar6-column" class="form-control" placeholder="Masukkan gambar kartu kredit pelanggan" name="gambar6" data-parsley-required="false">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="status-column">Status</label>
                                                    <select class="form-select" id="status-column" name="status_pelanggan" data-parsley-required="true">
                                                        <option value="" selected disabled>-- Pilih --</option>
                                                        <option value="Aktif">Aktif</option>
                                                        <option value="Blokir">Blokir</option>
                                                    </select>
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
                                            <div class="col-12 d-flex justify-content-end">
                                                <button name="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                                <a href="pelanggan.php?pelanggan=active" class="btn btn-light-secondary me-1 mb-1">Batal</a>
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