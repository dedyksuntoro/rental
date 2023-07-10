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
                        <div class="card">
                            <div class="card-header">
                                <!-- <h4 class="card-title">Hoverable rows</h4> -->
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <?php
                                    $sql = "SELECT
                                                id,
                                                nama_hak_akses,
                                            IF
                                                ( tbl_hak_akses.`created` = 1, 'Yes', 'No' ) AS `create`,
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
                                    <!-- <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>NAMA HAK AKSES</th>
                                                    <th>BUAT</th>
                                                    <th>LIHAT</th>
                                                    <th>PEMBARUAN</th>
                                                    <th>HAPUS</th>
                                                    <th>TINDAKAN</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-bold-500">Michael Right</td>
                                                    <td>$15/hr</td>
                                                    <td class="text-bold-500">UI/UX</td>
                                                    <td>Remote</td>
                                                    <td>Austin,Taxes</td>
                                                    <td><a href="#"><i class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="mail"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-500">Morgan Vanblum</td>
                                                    <td>$13/hr</td>
                                                    <td class="text-bold-500">Graphic concepts</td>
                                                    <td>Remote</td>
                                                    <td>Shangai,China</td>
                                                    <td><a href="#"><i class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="mail"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-500">Tiffani Blogz</td>
                                                    <td>$15/hr</td>
                                                    <td class="text-bold-500">Animation</td>
                                                    <td>Remote</td>
                                                    <td>Austin,Texas</td>
                                                    <td><a href="#"><i class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="mail"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-500">Ashley Boul</td>
                                                    <td>$15/hr</td>
                                                    <td class="text-bold-500">Animation</td>
                                                    <td>Remote</td>
                                                    <td>Austin,Texas</td>
                                                    <td><a href="#"><i class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="mail"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-bold-500">Mikkey Mice</td>
                                                    <td>$15/hr</td>
                                                    <td class="text-bold-500">Animation</td>
                                                    <td>Remote</td>
                                                    <td>Austin,Texas</td>
                                                    <td><a href="#"><i class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="mail"></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> -->
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