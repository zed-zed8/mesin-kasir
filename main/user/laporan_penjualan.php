<?php

include '../../include/database.php';
include '../../include/function/numsformat.php';


session_start();
if (!isset($_SESSION['login'])) {
    header('location:../../auth/login.php');
}

if (isset($_POST['clear'])) {
    $penjualan = new penjualan();
    $penjualan->clear_penjualan();
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
    <link rel="stylesheet" href="../../assets/css/laporan_penjualan.css">

    <title>Laporan Penjualan</title>
</head>

<body>
    <?php
    include 'nav.php';
    ?>

    <section id="laporan_penjualan" class="no-print">
        <div class="section-container">
            <div class="container h-auto">
                <div class="row">
                    <div class="col justify-content-center">
                        <h2 class="text-center">Laporan Penjualan</h2>
                    </div>
                </div>
            </div>

            <div class="bon-container">

                <?php
                $penjualan = new penjualan();
                foreach ($penjualan->get_data() as $value) :
                ?>

                    <div class="container">
                        <h4 class="fw-normal text-center">ZidMart</h4>
                        <h4 class="fw-normal text-center">085351728442</h4>
                        <h5 class="fw-normal text-center">JL Caringin Dalam NO. 09</h5>

                        <hr>

                        <div class="row">
                            <div class="col justify-content-start container">
                                <div class="row">
                                    <div class="col col-7">
                                        <span>Nama Pembeli</span>
                                    </div>
                                    <div class="col col-1">
                                        <span>:</span>
                                    </div>
                                    <div class="col col-3">
                                        <span><?= $value['nama_pembeli'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col col-3 text-center">
                                <span>Nama Barang</span>
                            </div>
                            <div class="col col-6 justify-content-evenly">
                                <div class="d-flex flex-column">
                                    <span>Jumlah</span>
                                    <span>Barang</span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span>Harga</span>
                                    <span>Barang</span>
                                </div>
                            </div>
                            <div class="col col-3 text-center">
                                <Span>Total Harga</Span>
                            </div>
                        </div>

                        <?php
                        $total_item = 0;
                        foreach ($penjualan->get_data_keranjang($value['id_penjualan']) as $value2) :
                            $total_item++;
                        ?>
                            <div class="row">
                                <div class="col col-3 ">
                                    <span><?= $value2['nama_barang'] ?></span>
                                </div>
                                <div class="col col-6 justify-content-evenly">
                                    <div class="d-flex flex-column">
                                        <span><?= numsFormat($value2['jumlah_barang']) ?></span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <Span><?= numsFormat($value2['harga_barang']) ?></Span>
                                    </div>
                                </div>
                                <div class="col col-3 text-center">
                                    <span><?= numsFormat($value2['total_harga']) ?></span>
                                </div>
                            </div>
                            <?php if ($value2['diskon_barang'] > 0): ?>
                                <div class="row mb-3">
                                    <div class="col col-9 justify-content-start">
                                        <div class="d-flex flex-column me-5">
                                            <span>diskon :</span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <Span>-<?= numsFormat($value2['diskon_barang']) ?></Span>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <hr>

                        <div class="row">
                            <div class="col col-9 justify-content-start container">
                                <div class="row">
                                    <div class="col col-6">
                                        <span>Total</span>
                                        <span>Item</span>
                                    </div>
                                    <div class="col col-1">
                                        <span>:</span>
                                    </div>
                                    <div class="col">
                                        <span><?= numsFormat($total_item) ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-3 ">
                                <span><?= numsFormat($value['total_belanja']) ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-9 justify-content-end">
                                <span>Pajak PPN</span>
                            </div>
                            <div class="col col-3">
                                <span><?= $value['pajak'] ?>%</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-9 justify-content-start">
                                <span>Total Pajak</span>
                            </div>
                            <div class="col col-3 ">
                                <span><?= $value['total_belanja'] * ($value['pajak'] / 100) ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-9 justify-content-start">
                                <span>Total Harga</span>
                            </div>
                            <div class="col col-3 ">
                                <span><?= numsFormat($value['total_harga']) ?></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-9 justify-content-start">
                                <span>Uang</span>
                            </div>
                            <div class="col col-3 ">
                                <span><?= numsFormat($value['uang']) ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-9 justify-content-start">
                                <span>Kembalian</span>
                            </div>
                            <div class="col col-3 ">
                                <span><?= numsFormat($value['uang'] - $value['total_harga'])  ?>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col justify-content-start container">
                                <div class="row">
                                    <div class="col">
                                        <span>Tanggal</span>
                                    </div>
                                    <div class="col col-1 ">
                                        <span>:</span>
                                    </div>
                                    <div class="col">
                                        <span><?= $value['tanggal'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
    </section>

</body>

</html>