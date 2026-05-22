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
            }

            $text = "Edit Barang";
            $aksi = "edit-barang";
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

    $barang = new barang();
    $barang->create($nama_barang, $harga_barang, $stok);

    $text = "Tambah Barang Berhasil";
    $aksi = "proses";
    $proses = "tambah";
}
if (isset($_POST['edit-barang'])) {
    $id_barang = (int) $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga_barang = (int) $_POST['harga_barang'];
    $stok = (int) $_POST['stok'];

    $barang = new barang();
    $barang->edit_barang($id_barang, $nama_barang, $harga_barang, $stok);

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
                    </div>

                    <form action="barang_proses.php" method="post">
                        <div class="row">
                            <div class="col">
                                <input type="text" name="nama_barang" value="<?= $nama_barang ?? "" ?>">
                            </div>
                            <div class="col">
                                <input type="number" name="harga_barang" value="<?= $harga_barang ?? "" ?>" step="500" min="0">
                            </div>
                            <div class="col">
                                <input type="number" name="stok" value="<?= $stok ?? "" ?>" min="0">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col text-center">
                                <input type="hidden" name="id_barang" value="<?= $value['id_barang'] ?? "" ?>">

                                <label for="barang-proses" class="input-button <?= $aksi == "tambah-barang" ? "success" : "" ?>">
                                    <span><?= $text ?></span>
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