<?php

include '../include/database.php';

session_start();

$proses = "";
$text = "";
$formPath = "";

if (isset($_POST['btnlogin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $users = new users();
    $result = $users->get_user($username, $password);

    if ($result) {
        $_SESSION['login'] = $users->get_id($password);

        $proses = "login_berhasil";
        $text = "Login Berhasil";
        $formPath = '../index.php';
    } else {
        // $_SESSION['login_proses'] = "gagal";
        $proses = "login_gagal";
        $text = "Login Gagal";
        $formPath = 'login.php';
    }
}

if (isset($_POST['btnregister'])) {
    $username = $_POST['username'];
    $password = MD5($_POST['password']);
    $nama = $_POST['nama'];

    $users = new users();
    $users->create($username, $password, $nama);

    $_SESSION['login'] = $password;
    $proses = "register";
    $text = "Register Berhasil";
    $formPath = 'login.php';
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

    <!-- my script -->
    <script src="../assets/js/input.js" defer></script>


    <title>Auth Proses</title>
</head>

<body>
    <section id="login_proses">
        <div class="section-container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h3 class="display-3 fw-bolder"><?= $text ?></h3>
                    </div>
                </div>
                <div class="row">
                    <form action="<?= $formPath ?>">
                        <div class="col">
                            <label for="btnproses"
                                class="input-button <?= $proses == "login_gagal" ? "danger" : "success" ?>">
                                <span>GO</span>
                                <input type="submit" value="Login" name="btnproses" id="btnproses">
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
                window.location = '<?= $formPath ?>';
            }
        })
    </script>
</body>

</html>