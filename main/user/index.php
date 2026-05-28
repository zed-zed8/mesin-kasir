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
            <div class="home-head">
                <?php $users = new users(); ?>
                <h1 class="text-center">Selamat Datang Admin <?= $users->get_nama($_SESSION['login']) ?></h1>
                <h3 class="fw-normal text-center">
                    Kedalam DashBoard Mesin Kasir <span class="brand-primary">Zid</span><span class="brand-secondary">Mart</span>
                </h3>
            </div>


            <div class="news-container">
                <div class="news container">
                    <div class="row table-head">
                        <div class="col justify-content-start">
                            <span>News</span>
                        </div>
                    </div>
                    <div class="row row-head">
                        <div class="col col-2">
                            <span>Tipe</span>
                        </div>
                        <div class="col">
                            <span>Isi</span>
                        </div>
                        <div class="col col-2">
                            <span>Tanggal</span>
                        </div>
                    </div>

                    <?php
                    $news = new news();
                    foreach ($news->get_data() as $value): ?>
                        <div class="row">
                            <div class="col col-2">
                                <span><?= ucwords($value['tipe']) ?></span>
                            </div>
                            <div class="col justify-content-start">
                                <span><?= ucfirst($value['isi']) ?></span>
                            </div>
                            <div class="col col-2">
                                <span><?= $value['tanggal'] ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>


                <div class="pendapatan-container card">
                    <?php $penjualan = new penjualan() ?>
                    <div class="card-header">
                        <div class="">
                            <span class="">Pendapatan bulan ini</span>
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <div class="pendapatan-hasil">
                            <span class=""><?= numsFormat($penjualan->pendapatan()) ?>,00</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</body>

</html>