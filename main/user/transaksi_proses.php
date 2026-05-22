<?php

include '../../include/database.php';
include '../../include/function/numsformat.php';


if ($_POST['aksi'] == "beli") {
    $keranjang = $_POST['keranjang'];
    $nama_pembeli = $_POST['nama_pembeli'];
    $uang = (int) $_POST['uang'];

    $penjualan = new penjualan();
    $penjualan->create($keranjang, $nama_pembeli, $uang);

    // header("location:transaksi.php");
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


    <title>Transaksi</title>
</head>

<body>

    <section id="proses">
        <div class="section-container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h3 class="display-3 fw-bolder">
                            Transaksi Berhasil
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <form action="transaksi.php">
                            <label for="btnlogin" class="input-button">
                                <span>GO</span>
                                <input type="submit" value="Login" name="btnlogin" id="btnlogin">
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        document.addEventListener("keydown", (event) => {
            console.log(event);
            if (event.key == "Enter") {
                window.location = 'transaksi.php';
            }
        })
    </script>
</body>

</html>