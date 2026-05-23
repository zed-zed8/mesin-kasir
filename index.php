<?php

include 'include/database.php';

session_start();

$users = new users();
if (!isset($_SESSION['login'])) {
    header("location:auth/login.php");
    exit;
}

if (isset($_POST['logout'])) {
    header("location:auth/logout.php");
    exit;
}

echo "<pre>";
var_dump($_SESSION['login']);
echo "</pre>";

switch ($users->userCheck($_SESSION['login'])) {
    case 'user':
        header("location:main/user/index.php");
        break;

    case 'admin':
        header("location:main/admin/dashboard.php");
        break;

    default:
        error_log("userCheck fail");
        break;
}
