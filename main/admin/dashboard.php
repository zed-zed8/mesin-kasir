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

    <title>DashBoard</title>
</head>

<body>
    <?php
    include 'nav.php';
    ?>

    <section id="dashBoard.php">
        <div class="section-container">
            <div class="home-head">
                <?php $users = new users(); ?>
                <h1 class="text-center">Selamat Datang Admin <?= $users->get_nama($_SESSION['login']) ?></h1>
                <h3 class="fw-normal text-center">
                    Kedalam DashBoard Mesin Kasir <span class="brand-primary">Zid</span><span class="brand-secondary">Mart</span>
                </h3>
            </div>

            <div class="news-container">
                <div class="news"></div>

                <div class="pendapatan-container">
                    <?php $penjualan = new penjualan() ?>
                    <div class="pendapatan-text">
                        <span class="">Pendapatan bulan ini</span>
                    </div>
                    <div class="pendapatan-hasil">
                        <span class=""><?= numsFormat($penjualan->pendapatan()) ?>,00</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>