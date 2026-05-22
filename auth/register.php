<?php

include '../include/database.php';

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
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/auth.css">

    <!-- my script -->
    <script src="../assets/js/input.js" defer></script>


    <title>Register Form</title>
</head>

<body>
    <section id="register">
        <div class="section-container">
            <div class="container">
                <h1 class="text-center">Register Form</h1>
                <form action="proses.php" method="post">
                    <div class="row">
                        <div class="col col-3">Username</div>
                        <div class="col"><input type="text" name="username" id="username" required></div>
                    </div>
                    <div class="row">
                        <div class="col col-3">Password</div>
                        <div class="col"><input type="password" name="password" id="password" required></div>
                    </div>
                    <div class="row">
                        <div class="col col-3">Nama</div>
                        <div class="col"><input type="text" name="nama" id="nama" required></div>
                    </div>
                    <div class="row text-end">
                        <div class="col">
                            <label for="btnregister" class="input-button">
                                <span>Register</span>
                                <input type="submit" value="Login" name="btnregister" id="btnregister">
                            </label>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <small class="col justify-content-end">
                        <div class="text-end">
                            Sudah punya akun?
                            <a href="login.php">login sekarang</a>
                        </div>
                    </small>
                </div>
            </div>
        </div>
    </section>
</body>

</html>