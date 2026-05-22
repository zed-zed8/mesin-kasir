<?php

class barang  extends database
{
    public function create(string $nama_barang, int $harga_barang, int $stok): void
    {
        mysqli_query(
            $this->koneksi,
            "INSERT INTO barang VALUES (NULL, '$nama_barang', '$harga_barang', '$stok')"
        );
    }

    public function get_data(): mysqli_result|bool
    {
        $data = mysqli_query($this->koneksi, 'select * from barang');
        return $data;
    }

    public function get_data_id(int $id_barang): mysqli_result|bool
    {
        $data = mysqli_query($this->koneksi, "SELECT * FROM barang WHERE id_barang = '$id_barang'");
        return $data;
    }

    public function edit_barang(int $id_barang, string $nama_barang, int $harga_barang, int $stok)
    {
        mysqli_query(
            $this->koneksi,
            "UPDATE barang SET nama_barang = '$nama_barang', harga_barang = '$harga_barang' , stok = '$stok' WHERE id_barang = '$id_barang'"
        );
    }

    public function delete_barang(int $id_barang)
    {
        mysqli_query(
            $this->koneksi,
            "DELETE FROM barang WHERE id_barang = '$id_barang'"
        );
    }
}
