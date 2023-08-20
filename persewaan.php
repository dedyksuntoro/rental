<?php
include 'konfigurasi.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: auth-login.php");
}

if ($_GET['persewaan'] != 'active') {
    header("Location: error-404.php");
}

if (isset($_POST['delete'])) {
    $id = $_POST['delete'];

    $sql_delete = "DELETE FROM tbl_persewaan WHERE id = $id";

    if (mysqli_query($conn, $sql_delete)) {
        $_SESSION['pesannya'] = '<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> Data berhasil dihapus.</div>';
    } else {
        // var_dump("Error: " . $sql . "<br>" . mysqli_error($conn));
        $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Data gagal dihapus.</div>';
    }
}

if (isset($_POST['moving'])) {
    $id = $_POST['moving'];

    $sql_delete = "UPDATE tbl_persewaan SET status_sewa = 'Moving' WHERE id = $id";

    if (mysqli_query($conn, $sql_delete)) {
        $_SESSION['pesannya'] = '<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> Data berhasil dipindah.</div>';
    } else {
        // var_dump("Error: " . $sql . "<br>" . mysqli_error($conn));
        $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Data gagal dipindah.</div>';
    }
}

if (isset($_POST['extend'])) {
    $id = $_POST['extend'];

    $sql_delete = "UPDATE tbl_persewaan SET status_sewa = 'Extend' WHERE id = $id";

    if (mysqli_query($conn, $sql_delete)) {
        $_SESSION['pesannya'] = '<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> Data berhasil dipindah.</div>';
    } else {
        // var_dump("Error: " . $sql . "<br>" . mysqli_error($conn));
        $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Data gagal dipindah.</div>';
    }
}

if (isset($_POST['garage'])) {
    $id = $_POST['garage'];

    $sql_delete = "UPDATE tbl_persewaan SET status_sewa = 'Garage' WHERE id = $id";

    if (mysqli_query($conn, $sql_delete)) {
        $_SESSION['pesannya'] = '<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> Data berhasil dipindah.</div>';
    } else {
        // var_dump("Error: " . $sql . "<br>" . mysqli_error($conn));
        $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Data gagal dipindah.</div>';
    }
}

if (isset($_POST['cancel'])) {
    $id = $_POST['cancel'];

    $sql_delete = "UPDATE tbl_persewaan SET status_sewa = 'Cancel' WHERE id = $id";

    if (mysqli_query($conn, $sql_delete)) {
        $_SESSION['pesannya'] = '<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> Data berhasil dipindah.</div>';
    } else {
        // var_dump("Error: " . $sql . "<br>" . mysqli_error($conn));
        $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Data gagal dipindah.</div>';
    }
}

if (isset($_POST['order'])) {
    $id = $_POST['order'];

    $sql_delete = "UPDATE tbl_persewaan SET status_sewa = 'Order' WHERE id = $id";

    if (mysqli_query($conn, $sql_delete)) {
        $_SESSION['pesannya'] = '<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> Data berhasil dipindah.</div>';
    } else {
        // var_dump("Error: " . $sql . "<br>" . mysqli_error($conn));
        $_SESSION['pesannya'] = '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Data gagal dipindah.</div>';
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
                <h3>Persewaan</h3>
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
                                <a href="persewaan-create.php?persewaan=active" class="btn icon icon-left btn-primary"><i data-feather="plus"></i> Tambah Data</a>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="order-tab" data-bs-toggle="tab" href="#order" role="tab" aria-controls="order" aria-selected="true">Order</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="cancel-tab" data-bs-toggle="tab" href="#cancel" role="tab" aria-controls="cancel" aria-selected="false">Cancel</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="garage-tab" data-bs-toggle="tab" href="#garage" role="tab" aria-controls="garage" aria-selected="false">Garage</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="extend-tab" data-bs-toggle="tab" href="#extend" role="tab" aria-controls="extend" aria-selected="false">Extend</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="moving-tab" data-bs-toggle="tab" href="#moving" role="tab" aria-controls="moving" aria-selected="false">Moving</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="order" role="tabpanel" aria-labelledby="order-tab">
                                            <br />
                                            <?php
                                            $sql = "SELECT
                                                            tbl_persewaan.id,
                                                            tbl_persewaan.nomor_order,
                                                            tbl_kantor.nama_kantor AS kantor,
                                                            tbl_mobil.merek AS mobil,
                                                            tbl_pelanggan.nama_pelanggan AS pelanggan,
                                                            tbl_persewaan.tanggal_sewa,
                                                            tbl_persewaan.tipe_sewa,
                                                            tbl_order_vendor.nama_vendor AS pesan_dari,
                                                            tbl_persewaan.dikirim,
                                                            tbl_persewaan.alamat_pengiriman,
                                                            tbl_persewaan.mulai_sewa,
                                                            tbl_persewaan.selesai_sewa,
                                                            tbl_persewaan.potongan_harga,
                                                            tbl_persewaan.total_harga 
                                                        FROM
                                                            tbl_persewaan
                                                            LEFT JOIN tbl_kantor ON tbl_kantor.id = tbl_persewaan.kantor
                                                            LEFT JOIN tbl_mobil ON tbl_mobil.id = tbl_persewaan.mobil
                                                            LEFT JOIN tbl_order_vendor ON tbl_order_vendor.id = tbl_persewaan.pesan_dari
                                                            LEFT JOIN tbl_pelanggan ON tbl_pelanggan.id = tbl_persewaan.pelanggan
                                                        WHERE tbl_persewaan.status_sewa = 'Order'";
                                            $result = mysqli_query($conn, $sql);
                                            $number = 1;
                                            if (mysqli_num_rows($result) > 0) {
                                                echo '<div class="table-responsive">';
                                                echo '<table class="table table-hover" id="table1">';
                                                echo '<thead>
                                                            <tr>
                                                                <th>NO</th>
                                                                <th>KODE</th>
                                                                <th>KANTOR</th>
                                                                <th>MOBIL</th>
                                                                <th>PELANGGAN</th>
                                                                <th>TANGGAL</th>
                                                                <th>TIPE</th>
                                                                <th>PESAN DARI</th>
                                                                <th>DIKIRIM</th>
                                                                <th>ALAMAT PENGIRIMAN</th>
                                                                <th>MULAI</th>
                                                                <th>SELESAI</th>
                                                                <th>DISKON</th>
                                                                <th>TOTAL HARGA</th>
                                                                <th class="text-center">OPSI</th>
                                                                <th class="text-center">EDIT</th>
                                                                <th class="text-center">HAPUS</th>
                                                            </tr>
                                                        </thead>';
                                                echo '<tbody>';
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>
                                                        <td style='width:1%'>" . $number . "</td>
                                                        <td>" . $row['nomor_order'] . "</td>
                                                        <td>" . $row['kantor'] . "</td>
                                                        <td>" . $row['mobil'] . "</td>
                                                        <td>" . $row['pelanggan'] . "</td>
                                                        <td>" . $row['tanggal_sewa'] . "</td>
                                                        <td>" . $row['tipe_sewa'] . "</td>
                                                        <td>" . $row['pesan_dari'] . "</td>
                                                        <td>" . $row['dikirim'] . "</td>
                                                        <td>" . ($row['alamat_pengiriman'] != '' ? $row['alamat_pengiriman'] : '-') . "</td>
                                                        <td>" . $row['mulai_sewa'] . "</td>
                                                        <td>" . $row['selesai_sewa'] . "</td>
                                                        <td>" . ($row['potongan_harga'] != null ? $row['potongan_harga'] . '%' : '-') . "</td>
                                                        <td>" . rupiah($row['total_harga']) . "</td>
                                                        <td style='width:1%' class='text-center'>
                                                            <form class='form' method='POST' action=''>
                                                                <div class='btn-group dropstart'>
                                                                    <button class='btn btn-sm btn-primary icon dropdown-toggle' type='button' id='dropdownMenuCancel' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                                        <i class='bi bi-gear'></i>
                                                                    </button>
                                                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuCancel'>
                                                                        <button name='moving' value='" . $row['id'] . "' class='dropdown-item'>Moving</button>
                                                                        <button name='extend' value='" . $row['id'] . "' class='dropdown-item'>Extend</button>
                                                                        <button name='garage' value='" . $row['id'] . "' class='dropdown-item'>Garage</button>
                                                                        <button name='cancel' value='" . $row['id'] . "' class='dropdown-item'>Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                        <td style='width:1%' class='text-center'>
                                                            <form class='form' method='POST' action='persewaan-edit.php?persewaan=active'>
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
                                                        </div>";
                                            }
                                            ?>
                                        </div>
                                        <div class="tab-pane fade" id="cancel" role="tabpanel" aria-labelledby="cancel-tab">
                                            <br />
                                            <?php
                                            $sql = "SELECT
                                                            tbl_persewaan.id,
                                                            tbl_persewaan.nomor_order,
                                                            tbl_kantor.nama_kantor AS kantor,
                                                            tbl_mobil.merek AS mobil,
                                                            tbl_pelanggan.nama_pelanggan AS pelanggan,
                                                            tbl_persewaan.tanggal_sewa,
                                                            tbl_persewaan.tipe_sewa,
                                                            tbl_order_vendor.nama_vendor AS pesan_dari,
                                                            tbl_persewaan.dikirim,
                                                            tbl_persewaan.alamat_pengiriman,
                                                            tbl_persewaan.mulai_sewa,
                                                            tbl_persewaan.selesai_sewa,
                                                            tbl_persewaan.potongan_harga,
                                                            tbl_persewaan.total_harga 
                                                        FROM
                                                            tbl_persewaan
                                                            LEFT JOIN tbl_kantor ON tbl_kantor.id = tbl_persewaan.kantor
                                                            LEFT JOIN tbl_mobil ON tbl_mobil.id = tbl_persewaan.mobil
                                                            LEFT JOIN tbl_order_vendor ON tbl_order_vendor.id = tbl_persewaan.pesan_dari
                                                            LEFT JOIN tbl_pelanggan ON tbl_pelanggan.id = tbl_persewaan.pelanggan
                                                        WHERE tbl_persewaan.status_sewa = 'Cancel'";
                                            $result = mysqli_query($conn, $sql);
                                            $number = 1;
                                            if (mysqli_num_rows($result) > 0) {
                                                echo '<div class="table-responsive">';
                                                echo '<table class="table table-hover" id="table2">';
                                                echo '<thead>
                                                            <tr>
                                                                <th>NO</th>
                                                                <th>KODE</th>
                                                                <th>KANTOR</th>
                                                                <th>MOBIL</th>
                                                                <th>PELANGGAN</th>
                                                                <th>TANGGAL</th>
                                                                <th>TIPE</th>
                                                                <th>PESAN DARI</th>
                                                                <th>DIKIRIM</th>
                                                                <th>ALAMAT PENGIRIMAN</th>
                                                                <th>MULAI</th>
                                                                <th>SELESAI</th>
                                                                <th>DISKON</th>
                                                                <th>TOTAL HARGA</th>
                                                                <th class="text-center">OPSI</th>
                                                                <th class="text-center">EDIT</th>
                                                                <th class="text-center">HAPUS</th>
                                                            </tr>
                                                        </thead>';
                                                echo '<tbody>';
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>
                                                        <td style='width:1%'>" . $number . "</td>
                                                        <td>" . $row['nomor_order'] . "</td>
                                                        <td>" . $row['kantor'] . "</td>
                                                        <td>" . $row['mobil'] . "</td>
                                                        <td>" . $row['pelanggan'] . "</td>
                                                        <td>" . $row['tanggal_sewa'] . "</td>
                                                        <td>" . $row['tipe_sewa'] . "</td>
                                                        <td>" . $row['pesan_dari'] . "</td>
                                                        <td>" . $row['dikirim'] . "</td>
                                                        <td>" . ($row['alamat_pengiriman'] != '' ? $row['alamat_pengiriman'] : '-') . "</td>
                                                        <td>" . $row['mulai_sewa'] . "</td>
                                                        <td>" . $row['selesai_sewa'] . "</td>
                                                        <td>" . ($row['potongan_harga'] != null ? $row['potongan_harga'] . '%' : '-') . "</td>
                                                        <td>" . rupiah($row['total_harga']) . "</td>
                                                        <td style='width:1%' class='text-center'>
                                                            <form class='form' method='POST' action=''>
                                                                <div class='btn-group dropstart'>
                                                                    <button class='btn btn-sm btn-primary icon dropdown-toggle' type='button' id='dropdownMenuCancel' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                                        <i class='bi bi-gear'></i>
                                                                    </button>
                                                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuCancel'>
                                                                        <button name='moving' value='" . $row['id'] . "' class='dropdown-item'>Moving</button>
                                                                        <button name='extend' value='" . $row['id'] . "' class='dropdown-item'>Extend</button>
                                                                        <button name='garage' value='" . $row['id'] . "' class='dropdown-item'>Garage</button>
                                                                        <button name='order' value='" . $row['id'] . "' class='dropdown-item'>Order</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                        <td style='width:1%' class='text-center'>
                                                            <form class='form' method='POST' action='persewaan-edit.php?persewaan=active'>
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
                                                        </div>";
                                            }
                                            ?>
                                        </div>
                                        <div class="tab-pane fade" id="garage" role="tabpanel" aria-labelledby="garage-tab">
                                            <br />
                                            <?php
                                            $sql = "SELECT
                                                            tbl_persewaan.id,
                                                            tbl_persewaan.nomor_order,
                                                            tbl_kantor.nama_kantor AS kantor,
                                                            tbl_mobil.merek AS mobil,
                                                            tbl_pelanggan.nama_pelanggan AS pelanggan,
                                                            tbl_persewaan.tanggal_sewa,
                                                            tbl_persewaan.tipe_sewa,
                                                            tbl_order_vendor.nama_vendor AS pesan_dari,
                                                            tbl_persewaan.dikirim,
                                                            tbl_persewaan.alamat_pengiriman,
                                                            tbl_persewaan.mulai_sewa,
                                                            tbl_persewaan.selesai_sewa,
                                                            tbl_persewaan.potongan_harga,
                                                            tbl_persewaan.total_harga 
                                                        FROM
                                                            tbl_persewaan
                                                            LEFT JOIN tbl_kantor ON tbl_kantor.id = tbl_persewaan.kantor
                                                            LEFT JOIN tbl_mobil ON tbl_mobil.id = tbl_persewaan.mobil
                                                            LEFT JOIN tbl_order_vendor ON tbl_order_vendor.id = tbl_persewaan.pesan_dari
                                                            LEFT JOIN tbl_pelanggan ON tbl_pelanggan.id = tbl_persewaan.pelanggan
                                                        WHERE tbl_persewaan.status_sewa = 'Garage'";
                                            $result = mysqli_query($conn, $sql);
                                            $number = 1;
                                            if (mysqli_num_rows($result) > 0) {
                                                echo '<div class="table-responsive">';
                                                echo '<table class="table table-hover" id="table3">';
                                                echo '<thead>
                                                            <tr>
                                                                <th>NO</th>
                                                                <th>KODE</th>
                                                                <th>KANTOR</th>
                                                                <th>MOBIL</th>
                                                                <th>PELANGGAN</th>
                                                                <th>TANGGAL</th>
                                                                <th>TIPE</th>
                                                                <th>PESAN DARI</th>
                                                                <th>DIKIRIM</th>
                                                                <th>ALAMAT PENGIRIMAN</th>
                                                                <th>MULAI</th>
                                                                <th>SELESAI</th>
                                                                <th>DISKON</th>
                                                                <th>TOTAL HARGA</th>
                                                                <th class="text-center">OPSI</th>
                                                                <th class="text-center">EDIT</th>
                                                                <th class="text-center">HAPUS</th>
                                                            </tr>
                                                        </thead>';
                                                echo '<tbody>';
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>
                                                        <td style='width:1%'>" . $number . "</td>
                                                        <td>" . $row['nomor_order'] . "</td>
                                                        <td>" . $row['kantor'] . "</td>
                                                        <td>" . $row['mobil'] . "</td>
                                                        <td>" . $row['pelanggan'] . "</td>
                                                        <td>" . $row['tanggal_sewa'] . "</td>
                                                        <td>" . $row['tipe_sewa'] . "</td>
                                                        <td>" . $row['pesan_dari'] . "</td>
                                                        <td>" . $row['dikirim'] . "</td>
                                                        <td>" . ($row['alamat_pengiriman'] != '' ? $row['alamat_pengiriman'] : '-') . "</td>
                                                        <td>" . $row['mulai_sewa'] . "</td>
                                                        <td>" . $row['selesai_sewa'] . "</td>
                                                        <td>" . ($row['potongan_harga'] != null ? $row['potongan_harga'] . '%' : '-') . "</td>
                                                        <td>" . rupiah($row['total_harga']) . "</td>
                                                        <td style='width:1%' class='text-center'>
                                                            <form class='form' method='POST' action=''>
                                                                <div class='btn-group dropstart'>
                                                                    <button class='btn btn-sm btn-primary icon dropdown-toggle' type='button' id='dropdownMenuCancel' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                                        <i class='bi bi-gear'></i>
                                                                    </button>
                                                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuCancel'>
                                                                        <button name='moving' value='" . $row['id'] . "' class='dropdown-item'>Moving</button>
                                                                        <button name='extend' value='" . $row['id'] . "' class='dropdown-item'>Extend</button>
                                                                        <button name='cancel' value='" . $row['id'] . "' class='dropdown-item'>Cancel</button>
                                                                        <button name='order' value='" . $row['id'] . "' class='dropdown-item'>Order</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                        <td style='width:1%' class='text-center'>
                                                            <form class='form' method='POST' action='persewaan-edit.php?persewaan=active'>
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
                                                        </div>";
                                            }
                                            ?>
                                        </div>
                                        <div class="tab-pane fade" id="extend" role="tabpanel" aria-labelledby="extend-tab">
                                            <br />
                                            <?php
                                            $sql = "SELECT
                                                            tbl_persewaan.id,
                                                            tbl_persewaan.nomor_order,
                                                            tbl_kantor.nama_kantor AS kantor,
                                                            tbl_mobil.merek AS mobil,
                                                            tbl_pelanggan.nama_pelanggan AS pelanggan,
                                                            tbl_persewaan.tanggal_sewa,
                                                            tbl_persewaan.tipe_sewa,
                                                            tbl_order_vendor.nama_vendor AS pesan_dari,
                                                            tbl_persewaan.dikirim,
                                                            tbl_persewaan.alamat_pengiriman,
                                                            tbl_persewaan.mulai_sewa,
                                                            tbl_persewaan.selesai_sewa,
                                                            tbl_persewaan.potongan_harga,
                                                            tbl_persewaan.total_harga 
                                                        FROM
                                                            tbl_persewaan
                                                            LEFT JOIN tbl_kantor ON tbl_kantor.id = tbl_persewaan.kantor
                                                            LEFT JOIN tbl_mobil ON tbl_mobil.id = tbl_persewaan.mobil
                                                            LEFT JOIN tbl_order_vendor ON tbl_order_vendor.id = tbl_persewaan.pesan_dari
                                                            LEFT JOIN tbl_pelanggan ON tbl_pelanggan.id = tbl_persewaan.pelanggan
                                                        WHERE tbl_persewaan.status_sewa = 'Extend'";
                                            $result = mysqli_query($conn, $sql);
                                            $number = 1;
                                            if (mysqli_num_rows($result) > 0) {
                                                echo '<div class="table-responsive">';
                                                echo '<table class="table table-hover" id="table4">';
                                                echo '<thead>
                                                            <tr>
                                                                <th>NO</th>
                                                                <th>KODE</th>
                                                                <th>KANTOR</th>
                                                                <th>MOBIL</th>
                                                                <th>PELANGGAN</th>
                                                                <th>TANGGAL</th>
                                                                <th>TIPE</th>
                                                                <th>PESAN DARI</th>
                                                                <th>DIKIRIM</th>
                                                                <th>ALAMAT PENGIRIMAN</th>
                                                                <th>MULAI</th>
                                                                <th>SELESAI</th>
                                                                <th>DISKON</th>
                                                                <th>TOTAL HARGA</th>
                                                                <th class="text-center">OPSI</th>
                                                                <th class="text-center">EDIT</th>
                                                                <th class="text-center">HAPUS</th>
                                                            </tr>
                                                        </thead>';
                                                echo '<tbody>';
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>
                                                        <td style='width:1%'>" . $number . "</td>
                                                        <td>" . $row['nomor_order'] . "</td>
                                                        <td>" . $row['kantor'] . "</td>
                                                        <td>" . $row['mobil'] . "</td>
                                                        <td>" . $row['pelanggan'] . "</td>
                                                        <td>" . $row['tanggal_sewa'] . "</td>
                                                        <td>" . $row['tipe_sewa'] . "</td>
                                                        <td>" . $row['pesan_dari'] . "</td>
                                                        <td>" . $row['dikirim'] . "</td>
                                                        <td>" . ($row['alamat_pengiriman'] != '' ? $row['alamat_pengiriman'] : '-') . "</td>
                                                        <td>" . $row['mulai_sewa'] . "</td>
                                                        <td>" . $row['selesai_sewa'] . "</td>
                                                        <td>" . ($row['potongan_harga'] != null ? $row['potongan_harga'] . '%' : '-') . "</td>
                                                        <td>" . rupiah($row['total_harga']) . "</td>
                                                        <td style='width:1%' class='text-center'>
                                                            <form class='form' method='POST' action=''>
                                                                <div class='btn-group dropstart'>
                                                                    <button class='btn btn-sm btn-primary icon dropdown-toggle' type='button' id='dropdownMenuCancel' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                                        <i class='bi bi-gear'></i>
                                                                    </button>
                                                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuCancel'>
                                                                        <button name='moving' value='" . $row['id'] . "' class='dropdown-item'>Moving</button>
                                                                        <button name='garage' value='" . $row['id'] . "' class='dropdown-item'>Garage</button>
                                                                        <button name='cancel' value='" . $row['id'] . "' class='dropdown-item'>Cancel</button>
                                                                        <button name='order' value='" . $row['id'] . "' class='dropdown-item'>Order</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                        <td style='width:1%' class='text-center'>
                                                            <form class='form' method='POST' action='persewaan-edit.php?persewaan=active'>
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
                                                        </div>";
                                            }
                                            ?>
                                        </div>
                                        <div class="tab-pane fade" id="moving" role="tabpanel" aria-labelledby="moving-tab">
                                            <br />
                                            <?php
                                            $sql = "SELECT
                                                            tbl_persewaan.id,
                                                            tbl_persewaan.nomor_order,
                                                            tbl_kantor.nama_kantor AS kantor,
                                                            tbl_mobil.merek AS mobil,
                                                            tbl_pelanggan.nama_pelanggan AS pelanggan,
                                                            tbl_persewaan.tanggal_sewa,
                                                            tbl_persewaan.tipe_sewa,
                                                            tbl_order_vendor.nama_vendor AS pesan_dari,
                                                            tbl_persewaan.dikirim,
                                                            tbl_persewaan.alamat_pengiriman,
                                                            tbl_persewaan.mulai_sewa,
                                                            tbl_persewaan.selesai_sewa,
                                                            tbl_persewaan.potongan_harga,
                                                            tbl_persewaan.total_harga 
                                                        FROM
                                                            tbl_persewaan
                                                            LEFT JOIN tbl_kantor ON tbl_kantor.id = tbl_persewaan.kantor
                                                            LEFT JOIN tbl_mobil ON tbl_mobil.id = tbl_persewaan.mobil
                                                            LEFT JOIN tbl_order_vendor ON tbl_order_vendor.id = tbl_persewaan.pesan_dari
                                                            LEFT JOIN tbl_pelanggan ON tbl_pelanggan.id = tbl_persewaan.pelanggan
                                                        WHERE tbl_persewaan.status_sewa = 'Moving'";
                                            $result = mysqli_query($conn, $sql);
                                            $number = 1;
                                            if (mysqli_num_rows($result) > 0) {
                                                echo '<div class="table-responsive">';
                                                echo '<table class="table table-hover" id="table5">';
                                                echo '<thead>
                                                            <tr>
                                                                <th>NO</th>
                                                                <th>KODE</th>
                                                                <th>KANTOR</th>
                                                                <th>MOBIL</th>
                                                                <th>PELANGGAN</th>
                                                                <th>TANGGAL</th>
                                                                <th>TIPE</th>
                                                                <th>PESAN DARI</th>
                                                                <th>DIKIRIM</th>
                                                                <th>ALAMAT PENGIRIMAN</th>
                                                                <th>MULAI</th>
                                                                <th>SELESAI</th>
                                                                <th>DISKON</th>
                                                                <th>TOTAL HARGA</th>
                                                                <th class="text-center">OPSI</th>
                                                                <th class="text-center">EDIT</th>
                                                                <th class="text-center">HAPUS</th>
                                                            </tr>
                                                        </thead>';
                                                echo '<tbody>';
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>
                                                        <td style='width:1%'>" . $number . "</td>
                                                        <td>" . $row['nomor_order'] . "</td>
                                                        <td>" . $row['kantor'] . "</td>
                                                        <td>" . $row['mobil'] . "</td>
                                                        <td>" . $row['pelanggan'] . "</td>
                                                        <td>" . $row['tanggal_sewa'] . "</td>
                                                        <td>" . $row['tipe_sewa'] . "</td>
                                                        <td>" . $row['pesan_dari'] . "</td>
                                                        <td>" . $row['dikirim'] . "</td>
                                                        <td>" . ($row['alamat_pengiriman'] != '' ? $row['alamat_pengiriman'] : '-') . "</td>
                                                        <td>" . $row['mulai_sewa'] . "</td>
                                                        <td>" . $row['selesai_sewa'] . "</td>
                                                        <td>" . ($row['potongan_harga'] != null ? $row['potongan_harga'] . '%' : '-') . "</td>
                                                        <td>" . rupiah($row['total_harga']) . "</td>
                                                        <td style='width:1%' class='text-center'>
                                                            <form class='form' method='POST' action=''>
                                                                <div class='btn-group dropstart'>
                                                                    <button class='btn btn-sm btn-primary icon dropdown-toggle' type='button' id='dropdownMenuCancel' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                                        <i class='bi bi-gear'></i>
                                                                    </button>
                                                                    <div class='dropdown-menu' aria-labelledby='dropdownMenuCancel'>
                                                                        <button name='extend' value='" . $row['id'] . "' class='dropdown-item'>Extend</button>
                                                                        <button name='garage' value='" . $row['id'] . "' class='dropdown-item'>Garage</button>
                                                                        <button name='cancel' value='" . $row['id'] . "' class='dropdown-item'>Cancel</button>
                                                                        <button name='order' value='" . $row['id'] . "' class='dropdown-item'>Order</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                        <td style='width:1%' class='text-center'>
                                                            <form class='form' method='POST' action='persewaan-edit.php?persewaan=active'>
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
                                                        </div>";
                                            }
                                            ?>
                                        </div>
                                    </div>
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

    <!-- <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/js/pages/simple-datatables.js"></script> -->

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
    <script>
        new DataTable('#table1', {
            responsive: true
        });
        new DataTable('#table2', {
            responsive: true
        });
        new DataTable('#table3', {
            responsive: true
        });
        new DataTable('#table4', {
            responsive: true
        });
        new DataTable('#table5', {
            responsive: true
        });
    </script>

</body>

</html>