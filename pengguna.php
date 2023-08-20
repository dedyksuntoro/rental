<?php
include 'konfigurasi.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: auth-login.php");
}

if ($_GET['pengguna'] != 'active') {
    header("Location: error-404.php");
}

if (isset($_POST['delete'])) {
    $id = $_POST['delete'];

    $sql_delete = "DELETE FROM tbl_pengguna WHERE id = $id";

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
                <h3>Pengguna</h3>
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
                                <a href="pengguna-create.php?pengguna=active" class="btn icon icon-left btn-primary"><i data-feather="plus"></i> Tambah Data</a>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <?php
                                    $sql = "SELECT
                                                tbl_pengguna.id,
                                                tbl_pengguna.nama,
                                                tbl_pengguna.alamat,
                                                tbl_pengguna.email,
                                                tbl_kantor.nama_kantor AS kantor,
                                                tbl_hak_akses.nama_hak_akses AS akses
                                            FROM
                                                tbl_pengguna
                                            LEFT JOIN tbl_kantor ON tbl_kantor.id = tbl_pengguna.kantor
                                            LEFT JOIN tbl_hak_akses ON tbl_hak_akses.id = tbl_pengguna.akses";
                                    $result = mysqli_query($conn, $sql);
                                    $number = 1;
                                    if (mysqli_num_rows($result) > 0) {
                                        echo '<div class="table-responsive">';
                                        echo '<table class="table table-hover" id="table1">';
                                        echo '<thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>NAMA</th>
                                                    <th>ALAMAT</th>
                                                    <th>EMAIL</th>
                                                    <th>KANTOR</th>
                                                    <th>AKSES</th>
                                                    <th class="text-center">EDIT</th>
                                                    <th class="text-center">HAPUS</th>
                                                </tr>
                                            </thead>';
                                        echo '<tbody>';
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>
                                                    <td style='width:1%'>" . $number . "</td>
                                                    <td>" . $row['nama'] . "</td>
                                                    <td>" . $row['alamat'] . "</td>
                                                    <td>" . $row['email'] . "</td>
                                                    <td>" . $row['kantor'] . "</td>
                                                    <td>" . $row['akses'] . "</td>
                                                    <td style='width:1%' class='text-center'>
                                                        <form class='form' method='POST' action='pengguna-edit.php?pengguna=active'>
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