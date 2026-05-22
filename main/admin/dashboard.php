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

    <section id="index.php">
        <div class="section-container">
            <?php $users = new users(); ?>
            <h1 class="text-center">Selamat Datang Admin <?= $users->get_nama($_SESSION['login']) ?></h1>
            <h3 class="fw-normal text-center">
                Kedalam DashBoard Mesin Kasir <span class="brand-primary">Zid</span><span class="brand-secondary">Mart</span>
            </h3>

            <p class="muted-text">Data Semua kasir</p>
            <div class="container">
                <div class="row table-head">
                    <div class="col">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <span>Id</span>
                                </div>
                                <div class="col">
                                    <span>Username</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col">Pasword</div> -->
                    <div class="col">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <span>Nama Kasir</span>
                                </div>
                                <div class="col">
                                    <span>Role</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $users = new users();
                foreach ($users->get_data() as $value) { ?>
                    <div class="row">
                        <div class="col">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <span><?= $value['id_user'] ?></span>
                                    </div>
                                    <div class="col">
                                        <span><?= $value['username'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <span><?= $value['nama'] ?></span>
                                    </div>
                                    <div class="col">
                                        <span class="<?= match ($value['role']) {
                                                            "user" => "text-primary",
                                                            "admin" => "text-secondary",
                                                            default => "text-danger",
                                                        }; ?>">
                                            <?= $value['role'] ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php
                } ?>
            </div>
        </div>
    </section>
</body>

</html>