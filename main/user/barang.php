<?php

include '../../include/database.php';

include '../../include/function/numsformat.php';


session_start();
if (!isset($_SESSION['login'])) {
    header('location:../../auth/login.php');
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


    <title>Login Form</title>
</head>

<body>
    <?php
    include 'nav.php';
    ?>

    <section id="index.php">
        <div class="section-container">
            <h1 class="table-desc">Inilah barang-barang yang kita jual</h1>
            <div class="container">
                <div class="row table-head">
                    <div class="col">
                        <span>No</span>
                    </div>
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

                <?php
                $barang = new barang();
                $no = 1;
                foreach ($barang->get_data() as $value) : ?>
                    <div class="row">
                        <div class="col">
                            <Span><?= $no ?></Span>
                        </div>
                        <div class="col">
                            <span><?= $value['nama_barang'] ?></span>
                        </div>
                        <div class="col">
                            <Span>RP <?= numsFormat($value['harga_barang']) ?></Span>
                        </div>
                        <div class="col">
                            <span><?= numsFormat($value['stok']) ?></span>
                        </div>
                    </div>
                <?php $no++;
                endforeach; ?>

            </div>
        </div>
    </section>
</body>

</html>