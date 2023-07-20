<?php
include 'konfigurasi.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: auth-login.php");
}

if ($_GET['mobil'] != 'active') {
    header("Location: error-404.php");
}

if (isset($_POST['delete'])) {
    $id = $_POST['delete'];

    $sql_delete = "DELETE FROM tbl_mobil WHERE id = $id";

    if (mysqli_query($conn, $sql_delete)) {
        $_SESSION['pesannya'] = '<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> Data berhasil dihapus.</div>';
    } else {
        // var_dump("Error: " . $sql . "<br>" . mysqli_error($conn));
        $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Data gagal dihapus.</div>';
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
                <h3>Mobil</h3>
            </div>
            <section class="section">
                <div class="row" id="table-hover-row">
                    <div class="col-12">
                        <?php
                        if (isset($_SESSION['pesannya'])) {
                            echo $_SESSION['pesannya'];
                            unset($_SESSION['pesannya']);
                        }
                        ?>
                        <div class="card">
                            <div class="card-header">
                                <a href="mobil-create.php?mobil=active" class="btn icon icon-left btn-primary"><i data-feather="plus"></i> Tambah Data</a>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <?php
                                    $sql = "SELECT
                                                tbl_mobil.id,
                                                tbl_pabrikan.pabrikan AS pabrikan,
                                                tbl_mobil.merek,
                                                tbl_mobil.tahun,
                                                tbl_mobil.nomor_rangka,
                                                tbl_mobil.nomor_mesin,
                                                tbl_mobil.nopol,
                                                tbl_mobil.pemilik,
                                                tbl_mobil.alamat,
                                                tbl_kantor.nama_kantor AS kantor,
                                                tbl_mobil.harga_perbulan,
                                                tbl_mobil.harga_perminggu,
                                                tbl_mobil.harga_perhari,
                                                tbl_mobil.harga_perjam,
                                                tbl_mobil.status
                                            FROM
                                                tbl_mobil
                                            LEFT JOIN tbl_pabrikan ON tbl_pabrikan.id = tbl_mobil.pabrikan
                                            LEFT JOIN tbl_kantor ON tbl_kantor.id = tbl_mobil.kantor";
                                    $result = mysqli_query($conn, $sql);
                                    $number = 1;
                                    if (mysqli_num_rows($result) > 0) {
                                        echo '<div class="table-responsive">';
                                        echo '<table class="table table-hover" id="table1">';
                                        echo '<thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>PABRIKAN</th>
                                                    <th>MEREK</th>
                                                    <th>TAHUN</th>
                                                    <th>NO RANGKA</th>
                                                    <th>NO MESIN</th>
                                                    <th>NOPOL</th>
                                                    <th>PEMILIK</th>
                                                    <th>ALAMAT</th>
                                                    <th>KANTOR</th>
                                                    <th>PERBULAN</th>
                                                    <th>PERMINGGU</th>
                                                    <th>PERHARI</th>
                                                    <th>PERJAM</th>
                                                    <th>STATUS</th>
                                                    <th class="text-center" colspan="2">TINDAKAN</th>
                                                </tr>
                                            </thead>';
                                        echo '<tbody>';
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>
                                                    <td style='width:1%'>" . $number . "</td>
                                                    <td>" . $row['pabrikan'] . "</td>
                                                    <td>" . $row['merek'] . "</td>
                                                    <td>" . $row['tahun'] . "</td>
                                                    <td>" . $row['nomor_rangka'] . "</td>
                                                    <td>" . $row['nomor_mesin'] . "</td>
                                                    <td>" . $row['nopol'] . "</td>
                                                    <td>" . $row['pemilik'] . "</td>
                                                    <td>" . $row['alamat'] . "</td>
                                                    <td>" . $row['kantor'] . "</td>
                                                    <td>" . rupiah($row['harga_perbulan']) . "</td>
                                                    <td>" . rupiah($row['harga_perminggu']) . "</td>
                                                    <td>" . rupiah($row['harga_perhari']) . "</td>
                                                    <td>" . rupiah($row['harga_perjam']) . "</td>
                                                    <td>" . $row['status'] . "</td>
                                                    <td style='width:1%' class='text-center'>
                                                        <form class='form' method='POST' action='mobil-edit.php?mobil=active'>
                                                            <button name='edit' value='" . $row['id'] . "' class='btn btn-sm icon btn-success'><i class='bi bi-pencil'></i></button>
                                                        </form>
                                                    </td>
                                                    <td style='width:1%' class='text-center'>
                                                        <form class='form' method='POST' action=''>
                                                            <div class='btn-group dropstart'>
                                                                <button class='btn btn-sm btn-danger icon dropdown-toggle' type='button' id='dropdownMenuDelete' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                                    <i class='bi bi-x'></i>
                                                                </button>
                                                                <div class='dropdown-menu' aria-labelledby='dropdownMenuDelete'>
                                                                    <button name='delete' value='" . $row['id'] . "' class='dropdown-item'>Ya</button>
                                                                    <button class='dropdown-item'>Tidak</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>";
                                            $number++;
                                        }
                                        echo '</tbody>';
                                        echo '</table>';
                                        echo '</div>';
                                    } else {
                                        echo "
                                            <div class='alert alert-warning'>
                                                <h4 class='alert-heading'>Data Kosong</h4>
                                                <p>Tidak ada data untuk ditampilkan.</p>
                                            </div>
                                        ";
                                    }
                                    ?>
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

    <!-- Need: Apexcharts -->
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/js/pages/simple-datatables.js"></script>

</body>

</html>