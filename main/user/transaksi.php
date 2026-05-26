<?php

include '../../include/database.php';
include '../../include/function/numsformat.php';


session_start();
if (!isset($_SESSION['login'])) {
    header('location:auth/login.php');
}

if (isset($_POST['aksi'])) {
    $jumlah = $_POST['jumlah'];
    if ($_POST['aksi'] == "tambah") {
        $jumlah++;
    }
    if ($_POST['aksi'] == "kurang") {
        $jumlah--;
    }
} else {
    $jumlah = 1;
}

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";
// echo $jumlah;

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
    <link rel="stylesheet" href="../../assets/css/custom/custom_select.css">

    <!-- my style -->
    <script src="../../assets/js/custom_select.js" defer></script>
    <script src="../../assets/js/input.js" defer></script>

    <title>Transaksi</title>
</head>

<body>
    <?php
    include 'nav.php';
    ?>

    <section id="transaksi">
        <div class="section-container">
            <h1 class="text-center">Transaksi</h1>

            <div class="container">
                <div class="row table-head">
                    <div class="col col-2 text-end">
                        <form action="" method="post">
                            <input type="hidden" name="jumlah" value="<?= $jumlah ?>">
                            <label for="tambah" class="input-button success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z" />
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                </svg>

                                <span>&nbsp; Tambah</span>
                                <input type="submit" name="aksi" id="tambah" value="tambah">
                            </label>
                        </form>
                    </div>
                    <div class="col col-2 text-start">
                        <form action="" method="post">
                            <input type="hidden" name="jumlah" value="<?= $jumlah ?>">
                            <label for="kurang" class="input-button danger <?= $jumlah < 2 ? "disabled" : "" ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-dash" viewBox="0 0 16 16">
                                    <path d="M6.5 7a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1z" />
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                </svg>

                                <span>&nbsp; Kurang</span>
                                <input type="submit" name="aksi" id="kurang" value="kurang" <?= $jumlah < 2 ? "disabled" : "" ?>>
                            </label>
                        </form>
                    </div>
                </div>

                <form action="transaksi_proses.php" method="post">
                    <div class="row row-head">
                        <div class="col col-1">
                            <span>No</span>
                        </div>
                        <div class="col col-8">
                            <div class="container">
                                <div class="row">
                                    <div class="col text-start">
                                        <span>Nama Barang</span>
                                    </div>
                                    <div class="col">
                                        <span>Harga Barang</span>
                                    </div>
                                    <div class="col text-end">
                                        <Span>Stok</Span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-3">
                            <span>Jumlah</span>
                        </div>
                    </div>

                    <?php
                    $barang = new barang();
                    for ($i = 0; $i < $jumlah; $i++): ?>
                        <div class="row select-parent">
                            <div class="col col-1">
                                <span><?= $i + 1 ?></span>
                            </div>
                            <div class="col col-8">
                                <div class="custom-select-wrapper">
                                    <input type="hidden" class="real-input" name="keranjang[<?= $i ?>][id_barang]"
                                        value="<?php foreach ($barang->get_data() as $value):
                                                    echo $value['id_barang'];
                                                    break;
                                                endforeach; ?>">

                                    <div class="select-trigger row">
                                        <?php foreach ($barang->get_data() as $value): ?>
                                            <div class="col text-start">
                                                <span><?= $value['nama_barang'] ?></span>
                                            </div>
                                            <div class="col">
                                                <span>RP<?= numsFormat($value['harga_barang']) ?></span>
                                            </div>
                                            <div class="col text-end">
                                                <span><?= numsFormat($value['stok']) ?></span>
                                            </div>
                                        <?php break;
                                        endforeach; ?>
                                    </div>

                                    <div class="custom-options container">
                                        <?php foreach ($barang->get_data() as $value): ?>
                                            <div class="custom-option row d-flex <?= $value['stok'] == 0 ? "danger" : ""; ?>"
                                                data-value="<?= $value['id_barang'] ?>" data-stok="<?= $value['stok'] ?>">
                                                <div class="col text-start">
                                                    <span><?= $value['nama_barang'] ?></span>
                                                </div>
                                                <div class="col">
                                                    <span>RP<?= numsFormat($value['harga_barang']) ?></span>
                                                </div>
                                                <div class="col text-end">
                                                    <span><?= numsFormat($value['stok']) ?></span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <span></span>
                                    </div>

                                    <svg xmlns="http://www.w3.org/2000/svg" class="svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path class="arrow-up" d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z" />
                                        <path class="arrow-down" d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col col-3">
                                <input type="number" class="input-jumlah" name="keranjang[<?= $i ?>][jumlah_barang]" min="0"
                                    max="<?php foreach ($barang->get_data() as $value):
                                                echo $value['stok'];
                                                break;
                                            endforeach; ?>" required>
                            </div>
                        </div>
                    <?php endfor; ?>

                    <div class="row">
                        <div class="col col-9">
                            <span>Jumlah Uang</span>
                        </div>
                        <div class="col col-3">
                            <input type="number" name="uang" min="500" step="500" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-9">
                            <span>Nama Pembeli</span>
                        </div>
                        <div class="col col-3">
                            <input type="text" name="nama_pembeli" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="beli" class="input-button primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart-check" viewBox="0 0 16 16">
                                    <path d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                                </svg>

                                <span class="fw-bolder">&nbsp; Beli</span>
                                <input type="submit" name="aksi" id="beli" value="beli">
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>