<?php
include 'konfigurasi.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: auth-login.php");
}

if ($_GET['persewaan'] != 'active') {
    header("Location: error-404.php");
}

if (isset($_POST['submit'])) {
    $id = $_POST['submit'];
    $kantor = !empty($_POST['kantor']) ? $_POST['kantor'] : 'null';
    $mobil = !empty($_POST['mobil']) ? $_POST['mobil'] : 'null';
    $pelanggan = !empty($_POST['pelanggan']) ? $_POST['pelanggan'] : 'null';
    $tanggal_sewa = !empty($_POST['tanggal_sewa']) ? $_POST['tanggal_sewa'] : 'null';
    $tipe_sewa = !empty($_POST['tipe_sewa']) ? $_POST['tipe_sewa'] : 'null';
    $pesan_dari = !empty($_POST['pesan_dari']) ? $_POST['pesan_dari'] : 'null';
    $dikirim = !empty($_POST['dikirim']) ? $_POST['dikirim'] : 'null';
    $alamat_pengiriman = !empty($_POST['alamat_pengiriman']) ? $_POST['alamat_pengiriman'] : null;
    $mulai_sewa = !empty($_POST['mulai_sewa']) ? $_POST['mulai_sewa'] : 'null';
    $selesai_sewa = !empty($_POST['selesai_sewa']) ? $_POST['selesai_sewa'] : 'null';
    $potongan_harga = !empty($_POST['potongan_harga']) ? $_POST['potongan_harga'] : 'null';

    if ($tipe_sewa == 'Perjam') {
        //SEWA PERJAM
        $datetime1 = new DateTime($mulai_sewa);
        $datetime2 = new DateTime($selesai_sewa);
        $interval = $datetime1->diff($datetime2);
        $interval_result = $interval->format('%h');
        if ($potongan_harga != 'null') {
            //JIKA ADA DISKON
            $sql = "UPDATE tbl_persewaan
                INNER JOIN tbl_mobil ON tbl_persewaan.mobil = tbl_mobil.id
                SET tbl_persewaan.kantor = $kantor,
                tbl_persewaan.mobil = $mobil,
                tbl_persewaan.pelanggan = $pelanggan,
                tbl_persewaan.tanggal_sewa = '$tanggal_sewa',
                tbl_persewaan.tipe_sewa = '$tipe_sewa',
                tbl_persewaan.pesan_dari = $pesan_dari,
                tbl_persewaan.dikirim = '$dikirim',
                tbl_persewaan.alamat_pengiriman = '$alamat_pengiriman',
                tbl_persewaan.mulai_sewa = '$mulai_sewa',
                tbl_persewaan.selesai_sewa = '$selesai_sewa',
                tbl_persewaan.potongan_harga = $potongan_harga,
                tbl_persewaan.total_harga = ((tbl_mobil.harga_perjam * $interval_result) - ($potongan_harga / 100) * (tbl_mobil.harga_perjam * $interval_result))
                WHERE tbl_persewaan.id = $id";

            // $sql = "INSERT INTO tbl_persewaan (nomor_order, kantor, mobil, pelanggan, tanggal_sewa, tipe_sewa, pesan_dari, dikirim, alamat_pengiriman, mulai_sewa, selesai_sewa, potongan_harga, total_harga, status_sewa, created_at)
            //     SELECT '$nomor_order', $kantor, $mobil, $pelanggan, '$tanggal_sewa', '$tipe_sewa', $pesan_dari, '$dikirim', '$alamat_pengiriman', '$mulai_sewa', '$selesai_sewa', $potongan_harga, ((tbl_mobil.harga_perjam * $interval_result) - ($potongan_harga / 100) * (tbl_mobil.harga_perjam * $interval_result)), '$status_sewa', '$created_at'
            //     FROM tbl_mobil WHERE tbl_mobil.id = $mobil";
        } else {
            //JIKA TIDAK DISKON
            $sql = "UPDATE tbl_persewaan
                INNER JOIN tbl_mobil ON tbl_persewaan.mobil = tbl_mobil.id
                SET tbl_persewaan.kantor = $kantor,
                tbl_persewaan.mobil = $mobil,
                tbl_persewaan.pelanggan = $pelanggan,
                tbl_persewaan.tanggal_sewa = '$tanggal_sewa',
                tbl_persewaan.tipe_sewa = '$tipe_sewa',
                tbl_persewaan.pesan_dari = $pesan_dari,
                tbl_persewaan.dikirim = '$dikirim',
                tbl_persewaan.alamat_pengiriman = '$alamat_pengiriman',
                tbl_persewaan.mulai_sewa = '$mulai_sewa',
                tbl_persewaan.selesai_sewa = '$selesai_sewa',
                tbl_persewaan.potongan_harga = $potongan_harga,
                tbl_persewaan.total_harga = (tbl_mobil.harga_perjam * $interval_result)
                WHERE tbl_persewaan.id = $id";

            // $sql = "INSERT INTO tbl_persewaan (nomor_order, kantor, mobil, pelanggan, tanggal_sewa, tipe_sewa, pesan_dari, dikirim, alamat_pengiriman, mulai_sewa, selesai_sewa, potongan_harga, total_harga, status_sewa, created_at)
            //     SELECT '$nomor_order', $kantor, $mobil, $pelanggan, '$tanggal_sewa', '$tipe_sewa', $pesan_dari, '$dikirim', '$alamat_pengiriman', '$mulai_sewa', '$selesai_sewa', $potongan_harga, (tbl_mobil.harga_perjam * $interval_result), '$status_sewa', '$created_at'
            //     FROM tbl_mobil WHERE tbl_mobil.id = $mobil";
        }
    } else if ($tipe_sewa == 'Perhari') {
        //SEWA PERHARI
        $datetime1 = new DateTime($mulai_sewa);
        $datetime2 = new DateTime($selesai_sewa);
        $interval = $datetime1->diff($datetime2);
        $interval_result = $interval->format('%d');
        if ($potongan_harga != 'null') {
            //JIKA ADA DISKON
            $sql = "UPDATE tbl_persewaan
            INNER JOIN tbl_mobil ON tbl_persewaan.mobil = tbl_mobil.id
            SET tbl_persewaan.kantor = $kantor,
            tbl_persewaan.mobil = $mobil,
            tbl_persewaan.pelanggan = $pelanggan,
            tbl_persewaan.tanggal_sewa = '$tanggal_sewa',
            tbl_persewaan.tipe_sewa = '$tipe_sewa',
            tbl_persewaan.pesan_dari = $pesan_dari,
            tbl_persewaan.dikirim = '$dikirim',
            tbl_persewaan.alamat_pengiriman = '$alamat_pengiriman',
            tbl_persewaan.mulai_sewa = '$mulai_sewa',
            tbl_persewaan.selesai_sewa = '$selesai_sewa',
            tbl_persewaan.potongan_harga = $potongan_harga,
            tbl_persewaan.total_harga = ((tbl_mobil.harga_perhari * $interval_result) - ($potongan_harga / 100) * (tbl_mobil.harga_perhari * $interval_result))
            WHERE tbl_persewaan.id = $id";

            // $sql = "INSERT INTO tbl_persewaan (nomor_order, kantor, mobil, pelanggan, tanggal_sewa, tipe_sewa, pesan_dari, dikirim, alamat_pengiriman, mulai_sewa, selesai_sewa, potongan_harga, total_harga, status_sewa, created_at)
            //     SELECT '$nomor_order', $kantor, $mobil, $pelanggan, '$tanggal_sewa', '$tipe_sewa', $pesan_dari, '$dikirim', '$alamat_pengiriman', '$mulai_sewa', '$selesai_sewa', $potongan_harga, ((tbl_mobil.harga_perhari * $interval_result) - ($potongan_harga / 100) * (tbl_mobil.harga_perhari * $interval_result)), '$status_sewa', '$created_at'
            //     FROM tbl_mobil WHERE tbl_mobil.id = $mobil";
        } else {
            //JIKA TIDAK DISKON
            $sql = "UPDATE tbl_persewaan
                INNER JOIN tbl_mobil ON tbl_persewaan.mobil = tbl_mobil.id
                SET tbl_persewaan.kantor = $kantor,
                tbl_persewaan.mobil = $mobil,
                tbl_persewaan.pelanggan = $pelanggan,
                tbl_persewaan.tanggal_sewa = '$tanggal_sewa',
                tbl_persewaan.tipe_sewa = '$tipe_sewa',
                tbl_persewaan.pesan_dari = $pesan_dari,
                tbl_persewaan.dikirim = '$dikirim',
                tbl_persewaan.alamat_pengiriman = '$alamat_pengiriman',
                tbl_persewaan.mulai_sewa = '$mulai_sewa',
                tbl_persewaan.selesai_sewa = '$selesai_sewa',
                tbl_persewaan.potongan_harga = $potongan_harga,
                tbl_persewaan.total_harga = (tbl_mobil.harga_perhari * $interval_result)
                WHERE tbl_persewaan.id = $id";

            // $sql = "INSERT INTO tbl_persewaan (nomor_order, kantor, mobil, pelanggan, tanggal_sewa, tipe_sewa, pesan_dari, dikirim, alamat_pengiriman, mulai_sewa, selesai_sewa, potongan_harga, total_harga, status_sewa, created_at)
            //     SELECT '$nomor_order', $kantor, $mobil, $pelanggan, '$tanggal_sewa', '$tipe_sewa', $pesan_dari, '$dikirim', '$alamat_pengiriman', '$mulai_sewa', '$selesai_sewa', $potongan_harga, (tbl_mobil.harga_perhari * $interval_result), '$status_sewa', '$created_at'
            //     FROM tbl_mobil WHERE tbl_mobil.id = $mobil";
        }
    } else if ($tipe_sewa == 'Perbulan') {
        //SEWA PERBULAN
        $datetime1 = new DateTime($mulai_sewa);
        $datetime2 = new DateTime($selesai_sewa);
        $interval = $datetime1->diff($datetime2);
        $interval_result = $interval->format('%m');
        if ($potongan_harga != 'null') {
            //JIKA ADA DISKON
            $sql = "UPDATE tbl_persewaan
            INNER JOIN tbl_mobil ON tbl_persewaan.mobil = tbl_mobil.id
            SET tbl_persewaan.kantor = $kantor,
            tbl_persewaan.mobil = $mobil,
            tbl_persewaan.pelanggan = $pelanggan,
            tbl_persewaan.tanggal_sewa = '$tanggal_sewa',
            tbl_persewaan.tipe_sewa = '$tipe_sewa',
            tbl_persewaan.pesan_dari = $pesan_dari,
            tbl_persewaan.dikirim = '$dikirim',
            tbl_persewaan.alamat_pengiriman = '$alamat_pengiriman',
            tbl_persewaan.mulai_sewa = '$mulai_sewa',
            tbl_persewaan.selesai_sewa = '$selesai_sewa',
            tbl_persewaan.potongan_harga = $potongan_harga,
            tbl_persewaan.total_harga = ((tbl_mobil.harga_perbulan * $interval_result) - ($potongan_harga / 100) * (tbl_mobil.harga_perbulan * $interval_result))
            WHERE tbl_persewaan.id = $id";

            // $sql = "INSERT INTO tbl_persewaan (nomor_order, kantor, mobil, pelanggan, tanggal_sewa, tipe_sewa, pesan_dari, dikirim, alamat_pengiriman, mulai_sewa, selesai_sewa, potongan_harga, total_harga, status_sewa, created_at)
            //     SELECT '$nomor_order', $kantor, $mobil, $pelanggan, '$tanggal_sewa', '$tipe_sewa', $pesan_dari, '$dikirim', '$alamat_pengiriman', '$mulai_sewa', '$selesai_sewa', $potongan_harga, ((tbl_mobil.harga_perbulan * $interval_result) - ($potongan_harga / 100) * (tbl_mobil.harga_perbulan * $interval_result)), '$status_sewa', '$created_at'
            //     FROM tbl_mobil WHERE tbl_mobil.id = $mobil";
        } else {
            //JIKA TIDAK DISKON
            $sql = "UPDATE tbl_persewaan
                INNER JOIN tbl_mobil ON tbl_persewaan.mobil = tbl_mobil.id
                SET tbl_persewaan.kantor = $kantor,
                tbl_persewaan.mobil = $mobil,
                tbl_persewaan.pelanggan = $pelanggan,
                tbl_persewaan.tanggal_sewa = '$tanggal_sewa',
                tbl_persewaan.tipe_sewa = '$tipe_sewa',
                tbl_persewaan.pesan_dari = $pesan_dari,
                tbl_persewaan.dikirim = '$dikirim',
                tbl_persewaan.alamat_pengiriman = '$alamat_pengiriman',
                tbl_persewaan.mulai_sewa = '$mulai_sewa',
                tbl_persewaan.selesai_sewa = '$selesai_sewa',
                tbl_persewaan.potongan_harga = $potongan_harga,
                tbl_persewaan.total_harga = (tbl_mobil.harga_perbulan * $interval_result)
                WHERE tbl_persewaan.id = $id";

            // $sql = "INSERT INTO tbl_persewaan (nomor_order, kantor, mobil, pelanggan, tanggal_sewa, tipe_sewa, pesan_dari, dikirim, alamat_pengiriman, mulai_sewa, selesai_sewa, potongan_harga, total_harga, status_sewa, created_at)
            //     SELECT '$nomor_order', $kantor, $mobil, $pelanggan, '$tanggal_sewa', '$tipe_sewa', $pesan_dari, '$dikirim', '$alamat_pengiriman', '$mulai_sewa', '$selesai_sewa', $potongan_harga, (tbl_mobil.harga_perbulan * $interval_result), '$status_sewa', '$created_at'
            //     FROM tbl_mobil WHERE tbl_mobil.id = $mobil";
        }
    }

    // $sql = "INSERT INTO tbl_persewaan (nomor_order, kantor, mobil, pelanggan, tanggal_sewa, tipe_sewa, pesan_dari, dikirim, alamat_pengiriman, mulai_sewa, selesai_sewa, potongan_harga, total_harga, status_sewa, created_at)
    //         VALUES ('$nomor_order', $kantor, $mobil, $pelanggan, '$tanggal_sewa', '$tipe_sewa', $pesan_dari, '$dikirim', '$alamat_pengiriman', '$mulai_sewa', '$selesai_sewa', $potongan_harga, $total_harga, '$status_sewa', '$created_at')";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        $_SESSION['pesannya'] = '<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> Data berhasil diperbarui.</div>';
        header('Location: persewaan.php?persewaan=active');
    } else {
        // var_dump("Error: " . $sql . "<br>" . mysqli_error($conn));
        mysqli_close($conn);
        $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Data gagal diperbarui.</div>';
        header('Location: persewaan.php?persewaan=active');
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['edit'];
    $sql_edit = "SELECT * FROM tbl_persewaan WHERE id = $id";
    $result = mysqli_query($conn, $sql_edit);
    $row = mysqli_fetch_array($result);

    $sql_kantor = "SELECT * FROM tbl_kantor";
    $result_kantor = mysqli_query($conn, $sql_kantor);

    $sql_mobil = "SELECT * FROM tbl_mobil";
    $result_mobil = mysqli_query($conn, $sql_mobil);

    $sql_pelanggan = "SELECT * FROM tbl_pelanggan";
    $result_pelanggan = mysqli_query($conn, $sql_pelanggan);

    $sql_order_vendor = "SELECT * FROM tbl_order_vendor";
    $result_order_vendor = mysqli_query($conn, $sql_order_vendor);
} else {
    header('Location: persewaan.php?persewaan=active');
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
                <h3>Edit Persewaan</h3>
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
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="mobil-column">Mobil</label>
                                                    <select class="form-select" id="mobil-column" name="mobil" data-parsley-required="true">
                                                        <option value="" disabled>-- Pilih --</option>
                                                        <?php
                                                        while ($row_mobil = mysqli_fetch_array($result_mobil)) {
                                                            echo "<option " . ($row_mobil['id'] == $row['mobil'] ? "selected" : "") . " value='" . $row_mobil['id'] . "'>" . $row_mobil['merek'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="pelanggan-column">Pelanggan</label>
                                                    <select class="form-select" id="pelanggan-column" name="pelanggan" data-parsley-required="true">
                                                        <option value="" disabled>-- Pilih --</option>
                                                        <?php
                                                        while ($row_pelanggan = mysqli_fetch_array($result_pelanggan)) {
                                                            echo "<option " . ($row_pelanggan['id'] == $row['pelanggan'] ? "selected" : "") . " value='" . $row_pelanggan['id'] . "'>" . $row_pelanggan['nama_pelanggan'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="tanggal-sewa-column">Tanggal Sewa</label>
                                                    <input type="date" id="tanggal-sewa-column" class="form-control" placeholder="Masukkan tanggal persewaan" name="tanggal_sewa" data-parsley-required="true" value="<?php echo $row['tanggal_sewa'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="tipe-sewa-column">Tipe Sewa</label>
                                                    <select class="form-select" id="tipe-sewa-column" name="tipe_sewa" data-parsley-required="true">
                                                        <option value="" disabled>-- Pilih --</option>
                                                        <option <?php echo ($row['tipe_sewa'] == "Perjam" ? "selected" : "") ?> value="Perjam">Perjam</option>
                                                        <option <?php echo ($row['tipe_sewa'] == "Perhari" ? "selected" : "") ?> value="Perhari">Perhari</option>
                                                        <option <?php echo ($row['tipe_sewa'] == "Perbulan" ? "selected" : "") ?> value="Perbulan">Perbulan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="pesan-dari-column">Pesan Dari</label>
                                                    <select class="form-select" id="pesan-dari-column" name="pesan_dari" data-parsley-required="true">
                                                        <option value="" disabled>-- Pilih --</option>
                                                        <?php
                                                        while ($row_order_vendor = mysqli_fetch_array($result_order_vendor)) {
                                                            echo "<option " . ($row_order_vendor['id'] == $row['pesan_dari'] ? "selected" : "") . " value='" . $row_order_vendor['id'] . "'>" . $row_order_vendor['nama_vendor'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="dikirim-column">Dikirim</label>
                                                    <select class="form-select" id="dikirim-column" name="dikirim" data-parsley-required="true">
                                                        <option value="" selected disabled>-- Pilih --</option>
                                                        <option <?php echo ($row['dikirim'] == "Iya" ? "selected" : "") ?> value="Iya">Iya</option>
                                                        <option <?php echo ($row['dikirim'] == "Tidak" ? "selected" : "") ?> value="Tidak">Tidak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="alamat-pengiriman-column">Alamat Pengiriman</label>
                                                    <input type="text" id="alamat-pengiriman-column" class="form-control" placeholder="Masukkan alamat pengiriman" name="alamat_pengiriman" data-parsley-required="false" value="<?php echo $row['alamat_pengiriman'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="mulai-sewa-column">Mulai Sewa</label>
                                                    <input type="datetime-local" id="mulai-sewa-column" class="form-control" placeholder="Masukkan tanggal mulai sewa" name="mulai_sewa" data-parsley-required="true" value="<?php echo $row['mulai_sewa'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="selesai-sewa-column">Selesai Sewa</label>
                                                    <input type="datetime-local" id="selesai-sewa-column" class="form-control" placeholder="Masukkan tanggal selesai sewa" name="selesai_sewa" data-parsley-required="true" value="<?php echo $row['selesai_sewa'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="potongan-harga-column">Potongan Harga</label>
                                                    <input type="number" id="potongan-harga-column" class="form-control" placeholder="Masukkan potongan harga jika ada" name="potongan_harga" data-parsley-required="false" value="<?php echo $row['potongan_harga'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button name="submit" value="<?php echo $row['id']; ?>" class="btn btn-primary me-1 mb-1">Simpan</button>
                                                <a href="persewaan.php?persewaan=active" class="btn btn-light-secondary me-1 mb-1">Batal</a>
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