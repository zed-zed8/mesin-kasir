<?php

class barang  extends database
{
    public function create(string $nama_barang, int $harga_barang, int $stok, int $diskon): void
    {
        $sql = "INSERT INTO barang (id_barang, nama_barang, harga_barang, stok, diskon) 
            VALUES (NULL, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->koneksi, $sql);

        mysqli_stmt_bind_param($stmt, "siii", $nama_barang, $harga_barang, $stok, $diskon);
        $result = mysqli_stmt_execute($stmt);
    }

    public function get_data(): mysqli_result|bool
    {
        $data = mysqli_query($this->koneksi, 'select * from barang');
        return $data;
    }

    public function get_data_id(int $id_barang): mysqli_result|bool
    {
        $sql = "SELECT * FROM barang WHERE id_barang = ?";
        $stmt = mysqli_prepare($this->koneksi, $sql);

        mysqli_stmt_bind_param($stmt, "i", $id_barang);
        $result = mysqli_stmt_execute($stmt);

        $barang_data = mysqli_stmt_get_result($stmt);
        return $barang_data;
    }

    public function edit_barang(int $id_barang, string $nama_barang, int $harga_barang, int $stok, int $diskon): void
    {
        $sql = "UPDATE barang SET nama_barang = ?, harga_barang = ?, stok = ?, diskon = ? WHERE id_barang = ?";
        $stmt = mysqli_prepare($this->koneksi, $sql);

        mysqli_stmt_bind_param($stmt, "siiii", $nama_barang, $harga_barang, $stok, $diskon, $id_barang);
        $result = mysqli_stmt_execute($stmt);
    }

    public function edit_diskon(int $id_barang, int $diskon): void
    {
        $sql = "UPDATE barang SET diskon = ? WHERE id_barang = ?";
        $stmt = mysqli_prepare($this->koneksi, $sql);

        mysqli_stmt_bind_param($stmt, "ii", $diskon, $id_barang);
        $result = mysqli_stmt_execute($stmt);
    }

    public function delete_barang(int $id_barang): void
    {
        $sql = "DELETE FROM barang WHERE id_barang = ?";
        $stmt = mysqli_prepare($this->koneksi, $sql);

        mysqli_stmt_bind_param($stmt, "i", $id_barang);
        $result = mysqli_stmt_execute($stmt);
    }
}
