<?php

include '../include/database.php';


session_start();
if (isset($_SESSION['login_proses'])) {
    echo "<script>
        alert('Email atau Password Anda Salah!')
        </script>";
    unset($_SESSION['login_proses']);
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
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/auth.css">

    <!-- my script -->
    <script src="../assets/js/input.js" defer></script>


    <title>Login Form</title>
</head>

<body>
    <section id="login">
        <div class="section-container">
            <div class="container">
                <h1 class="text-center">Login Form</h1>

                <form action="proses.php" method="post">
                    <div class="row">
                        <div class="col col-3">Username</div>
                        <div class="col">
                            <input type="text" name="username" id="username" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-3">Password</div>
                        <div class="col">
                            <input type="password" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="row text-end">
                        <div class="col">
                            <label for="btnlogin" class="input-button">
                                <span>Login</span>
                                <input type="submit" value="Login" name="btnlogin" id="btnlogin">
                            </label>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <small class="col justify-content-end">
                        <div class="text-end">
                            Belum punya akun?
                            <a href="register.php">register sekarang</a>
                        </div>
                    </small>
                </div>

            </div>
        </div>
    </section>
</body>

</html>