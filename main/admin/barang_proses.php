<?php

include '../../include/database.php';
include '../../include/function/numsformat.php';

session_start();
if (!isset($_SESSION['login'])) {
    header('location:../../../auth/login.php');
}

$text = "";
$aksi = "";
if (isset($_POST['aksi'])) {
    switch ($_POST['aksi']) {
        case 'tambah-barang':
            $text = "Tambah Barang";
            $aksi = "tambah-barang";
            break;

        case 'edit-barang':
            $barang = new barang();
            foreach ($barang->get_data_id($_POST['id_barang']) as $value) {
                $nama_barang = $value['nama_barang'];
                $harga_barang = $value['harga_barang'];
                $stok = $value['stok'];
                $diskon = $value['diskon'];
            }

            $text = "Edit Barang";
            $aksi = "edit-barang";
            break;

        case 'edit-diskon':
            $barang = new barang();
            foreach ($barang->get_data_id($_POST['id_barang']) as $value) {
                $nama_barang = $value['nama_barang'];
                $harga_barang = $value['harga_barang'];
                $stok = $value['stok'];
                $diskon = $value['diskon'];
            }

            $text = "Edit Diskon";
            $aksi = "edit-diskon";
            break;

        case 'delete-barang':
            $id_barang = (int) $_POST['id_barang'];

            $barang = new barang();
            $barang->delete_barang($id_barang);

            $text = "Delete Barang Berhasil";
            $aksi = "proses";
            $proses = "delete";
            break;

        default:
            $text = "";
            $aksi = "proses";
            break;
    }
}

if (isset($_POST['tambah-barang'])) {
    $nama_barang = $_POST['nama_barang'];
    $harga_barang = (int) $_POST['harga_barang'];
    $stok = (int) $_POST['stok'];
    $diskon = (int) $_POST['diskon'];

    $barang = new barang();
    $barang->create($nama_barang, $harga_barang, $stok, $diskon);

    $text = "Tambah Barang Berhasil";
    $aksi = "proses";
    $proses = "tambah";
}

if (isset($_POST['edit-barang'])) {
    $id_barang = (int) $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga_barang = (int) $_POST['harga_barang'];
    $stok = (int) $_POST['stok'];
    $diskon = (int) $_POST['diskon'];

    $barang = new barang();
    $barang->edit_barang($id_barang, $nama_barang, $harga_barang, $stok, $diskon);

    $text = "Edit Barang Berhasil";
    $aksi = "proses";
    $proses = "edit";
}

if (isset($_POST['edit-diskon'])) {
    $id_barang = (int) $_POST['id_barang'];
    $diskon = (int) $_POST['diskon'];

    $barang = new barang();
    $barang->edit_diskon($id_barang, $diskon);

    $text = "Edit Barang Berhasil";
    $aksi = "proses";
    $proses = "edit";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- my style -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="../../assets/css/proses.css">

    <!-- my script -->
    <script src="../../assets/js/input.js" defer></script>

    <title>Proses Barang</title>
</head>

<body>
    <section id="barang_proses">
        <div class="section-container">

            <?php if ($aksi !== "proses"): ?>
                <div class="container">
                    <div class="row table-head">
                        <div class="col col-2">
                            <span>
                                <a class="fw-normal" href="barang.php">Go back</a>
                            </span>
                        </div>
                        <div class="col col-10">
                            <span>
                                <h2><?= $text ?></h2>
                            </span>
                        </div>
                    </div>

                    <div class="row row-head">
                        <div class="col">
                            <span>Nama Barang</span>
                        </div>
                        <div class="col">
                            <span>Harga Barang</span>
                        </div>
                        <div class="col">
                            <span>Stok</span>
                        </div>
                        <div class="col">
                            <span>Diskon(%)</span>
                        </div>
                    </div>

                    <form action="barang_proses.php" method="post">
                        <div class="row">
                            <div class="col">
                                <input type="text" name="nama_barang" value="<?= $nama_barang ?? "" ?>"
                                    <?= $aksi == "edit-diskon" ? "disabled" : "" ?>>
                            </div>
                            <div class="col">
                                <input type="number" name="harga_barang" value="<?= $harga_barang ?? "" ?>" step="500" min="0" <?= $aksi == "edit-diskon" ? "disabled" : "" ?>>
                            </div>
                            <div class="col">
                                <input type="number" name="stok" value="<?= $stok ?? "" ?>" min="0"
                                    <?= $aksi == "edit-diskon" ? "disabled" : "" ?>>
                            </div>
                            <div class="col">
                                <input type="number" name="diskon" value="<?= $diskon ?? 0 ?>" min="0">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col text-center">
                                <input type="hidden" name="id_barang" value="<?= $value['id_barang'] ?? "" ?>">

                                <label for="barang-proses" class="input-button 
                                <?= match ($aksi) {
                                    "tambah-barang" => "success",
                                    "edit-barang" => "primary",
                                    "edit-diskon" => "warning",
                                } ?>">
                                    <?php switch ($aksi) {
                                        case 'tambah-barang': ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                            </svg>
                                        <?php break;

                                        case 'edit-barang': ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                            </svg>
                                        <?php break;

                                        case 'edit-diskon': ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-percent" viewBox="0 0 16 16">
                                                <path d="M13.442 2.558a.625.625 0 0 1 0 .884l-10 10a.625.625 0 1 1-.884-.884l10-10a.625.625 0 0 1 .884 0M4.5 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5m7 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                            </svg>
                                    <?php break;
                                    }; ?>

                                    <span>&nbsp; <?= $text ?></span>
                                    <input type="submit" value="barang proses" name="<?= $aksi ?>" id="barang-proses">
                                </label>
                            </div>
                        </div>
                    </form>
                </div>

            <?php else: ?>
                <form action="barang.php" method="post">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <h3 class="display-3 fw-bolder">
                                    <?= $text ?>
                                </h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="btnlogin"
                                    class="input-button <?= match ($proses) {
                                                            "delete" => "danger",
                                                            "tambah" => "success",
                                                            "edit" => "primary",
                                                            default => "success",
                                                        } ?>">
                                    <span>GO</span>
                                    <input type="submit" value="Login" name="btnlogin" id="btnlogin">
                                </label>
                            </div>
                        </div>
                    </div>
                </form>

                <script>
                    document.addEventListener("keydown", (event) => {
                        // console.log(event);
                        if (event.key == "Enter") {
                            window.location = 'barang.php';
                        }
                    })
                </script>

            <?php endif; ?>

        </div>
    </section>

</body>

</html>