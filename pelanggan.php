<?php
include 'konfigurasi.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: auth-login.php");
}

if ($_GET['pelanggan'] != 'active') {
    header("Location: error-404.php");
}

if (isset($_POST['delete'])) {
    $id = $_POST['delete'];

    $sql_file = "SELECT gambar1, gambar2, gambar3, gambar4, gambar5, gambar6 FROM tbl_pelanggan WHERE id = $id";
    $result_file = mysqli_query($conn, $sql_file);
    $row_file = mysqli_fetch_assoc($result_file);

    $files = [
        $row_file['gambar1'],
        $row_file['gambar2'],
        $row_file['gambar3'],
        $row_file['gambar4'],
        $row_file['gambar5'],
        $row_file['gambar6']
    ];

    $files_filter = array_filter($files);
    
    foreach ($files_filter as $file) {
        if (file_exists($file)) {
            unlink($file);
        }
    }

    $sql_delete = "DELETE FROM tbl_pelanggan WHERE id = $id";

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
                <h3>Pelanggan</h3>
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
                                <a href="pelanggan-create.php?pelanggan=active" class="btn icon icon-left btn-primary"><i data-feather="plus"></i> Tambah Data</a>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <?php
                                    $sql = "SELECT
                                                tbl_pelanggan.id,
                                                tbl_pelanggan.nama_pelanggan,
                                                tbl_pelanggan.tgl_lahir_pelanggan,
                                                tbl_pelanggan.tempat_lahir_pelanggan,
                                                tbl_pelanggan.jenis_kelamin_pelanggan,
                                                tbl_pelanggan.no_telp_pelanggan,
                                                tbl_pelanggan.alamat_pelanggan,
                                                tbl_pelanggan.gambar1,
                                                tbl_pelanggan.keterangan_gambar1,
                                                tbl_pelanggan.gambar2,
                                                tbl_pelanggan.keterangan_gambar2,
                                                tbl_pelanggan.gambar3,
                                                tbl_pelanggan.keterangan_gambar3,
                                                tbl_pelanggan.gambar4,
                                                tbl_pelanggan.keterangan_gambar4,
                                                tbl_pelanggan.gambar5,
                                                tbl_pelanggan.keterangan_gambar5,
                                                tbl_pelanggan.gambar6,
                                                tbl_pelanggan.keterangan_gambar6,
                                                tbl_pelanggan.status_pelanggan,
                                                tbl_kantor.nama_kantor
                                            FROM
                                                tbl_pelanggan
                                            LEFT JOIN tbl_kantor ON tbl_kantor.id = tbl_pelanggan.kantor
                                            WHERE tbl_pelanggan.nama_rentcar IS NULL";
                                    $result = mysqli_query($conn, $sql);
                                    $number = 1;
                                    if (mysqli_num_rows($result) > 0) {
                                        echo '<div class="table-responsive">';
                                        echo '<table class="table table-hover" id="table1">';
                                        echo '<thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>NAMA</th>
                                                    <th>TGL LAHIR</th>
                                                    <th>TEMPAT LAHIR</th>
                                                    <th>KELAMIN</th>
                                                    <th>NO TELP</th>
                                                    <th>ALAMAT</th>
                                                    <th>STATUS</th>
                                                    <th>KANTOR</th>
                                                    <th class="text-center">EDIT</th>
                                                    <th class="text-center">HAPUS</th>
                                                </tr>
                                            </thead>';
                                        echo '<tbody>';
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>
                                                    <td style='width:1%'>" . $number . "</td>
                                                    <td>" . $row['nama_pelanggan'] . "</td>
                                                    <td>" . $row['tgl_lahir_pelanggan'] . "</td>
                                                    <td>" . $row['tempat_lahir_pelanggan'] . "</td>
                                                    <td>" . $row['jenis_kelamin_pelanggan'] . "</td>
                                                    <td>" . $row['no_telp_pelanggan'] . "</td>
                                                    <td>" . $row['alamat_pelanggan'] . "</td>
                                                    <td>" . $row['status_pelanggan'] . "</td>
                                                    <td>" . $row['nama_kantor'] . "</td>
                                                    <td style='width:1%' class='text-center'>
                                                        <form class='form' method='POST' action='pelanggan-edit.php?pelanggan=active'>
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

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
    <script>
        new DataTable('#table1', {
            responsive: true
        });
    </script>

</body>

</html>