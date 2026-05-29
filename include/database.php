<?php

class database
{
    public string $host = "localhost", $user = "root", $pass = "", $db = "mesin_kasir";
    public mixed $koneksi;

    public function __construct()
    {
        $this->koneksi = mysqli_connect(
            $this->host,
            $this->user,
            $this->pass,
            $this->db
        );
        if ($this->koneksi) {
            // echo "koneksi database berhasil";
        } else {
            echo "Koneksi Database Gagal";
        }
    }
}

//? database table
include 'class/news.php';
include 'class/users.php';
include 'class/barang.php';
include 'class/penjualan.php';


//! Koneksi DB
$db = new database();
