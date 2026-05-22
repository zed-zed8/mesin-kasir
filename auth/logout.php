<?php

include '../include/database.php';


session_start();
if (isset($_SESSION['login'])) {
    unset($_SESSION);
    session_destroy();
    // echo "<script type='text/javascript'>
    // alert('Logout Berhasil');
    //     window.location = './login.php'
    // </script>";
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
    <link rel="stylesheet" href="../assets/css/proses.css">


    <title>Logout</title>
</head>

<body>
    <section id="logout">
        <div class="section-container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h3 class="display-3 fw-bolder main-text">Logout Berhasil</h3>
                    </div>
                </div>
                <div class="row">
                    <form action="login.php">
                        <div class="col">
                            <label for="btnlogout" class="input-button success">
                                <span>GO</span>
                                <input type="submit" value="Login" name="btnlogout" id="btnlogout">
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("keydown", (event) => {
            console.log(event);
            if (event.key == "Enter") {
                window.location = 'login.php';
            }
        })
    </script>
</body>

</html>