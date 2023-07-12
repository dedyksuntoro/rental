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
                <h3>Hak Akses</h3>
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
                                <a href="hak-akses-create.php?hak-akses=active" class="btn icon icon-left btn-primary"><i data-feather="plus"></i> Tambah Data</a>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <?php
                                    $sql = "SELECT
                                                id,
                                                nama_hak_akses,
                                            IF
                                                ( tbl_hak_akses.`create` = 1, 'Yes', 'No' ) AS `create`,
                                            IF
                                                ( tbl_hak_akses.`read` = 1, 'Yes', 'No' ) AS `read`,
                                            IF
                                                ( tbl_hak_akses.`update` = 1, 'Yes', 'No' ) AS `update`,
                                            IF
                                                ( tbl_hak_akses.`delete` = 1, 'Yes', 'No' ) AS `delete` 
                                            FROM
                                                tbl_hak_akses";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        echo '<div class="table-responsive">';
                                        echo '<table class="table table-hover mb-0">';
                                        echo '<thead>
                                                <tr>
                                                    <th>NAMA HAK AKSES</th>
                                                    <th>BUAT</th>
                                                    <th>LIHAT</th>
                                                    <th>EDIT</th>
                                                    <th>HAPUS</th>
                                                    <th>TINDAKAN</th>
                                                </tr>
                                            </thead>';
                                        echo '<tbody>';
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>
                                                    <td>" . $row['nama_hak_akses'] . "</td>
                                                    <td>" . $row['create'] . "</td>
                                                    <td>" . $row['read'] . "</td>
                                                    <td>" . $row['update'] . "</td>
                                                    <td>" . $row['delete'] . "</td>
                                                    <td>
                                                        <a href='#'><i class='badge-circle badge-circle-light-secondary font-medium-1' data-feather='edit'></i></a>
                                                        |
                                                        <a href='#'><i class='badge-circle badge-circle-light-secondary font-medium-1' data-feather='delete'></i></a>
                                                    </td>
                                                </tr>";
                                        }
                                        echo '</tbody>';
                                        echo '</table>';
                                        echo '</div>';
                                    } else {
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

</body>

</html>