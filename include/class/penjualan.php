<?php

class penjualan  extends database
{
    public function get_data(): mysqli_result
    {
        $data = mysqli_query($this->koneksi, 'SELECT * FROM penjualan');
        return $data;
    }
    public function get_latest_data(): mysqli_result
    {
        $data = mysqli_query($this->koneksi, 'SELECT * FROM penjualan  ORDER BY id_penjualan DESC  LIMIT 1');
        return $data;
    }

    public function get_data_keranjang(int $id_penjualan): array
    {
        $keranjang = mysqli_query($this->koneksi, "SELECT * FROM keranjang WHERE id_penjualan='$id_penjualan'");
        $keranjang_belanja = [];

        foreach ($keranjang as $value) {
            $nama_barang = $value['nama_barang'];
            $harga_barang = $value['harga_barang'];
            $jumlah_barang = $value['jumlah_barang'];

            // $data_barang = mysqli_query(
            //     $this->koneksi,
            //     "SELECT * FROM barang WHERE id_barang ='$id_barang'"
            // );
            // foreach ($data_barang as $value2) {
            //     $nama_barang = $value2['nama_barang'];
            //     $harga_barang = $value2['harga_barang'];
            // }

            $keranjang_belanja[] = [
                'nama_barang' => $nama_barang,
                'jumlah_barang' =>  $jumlah_barang,
                'harga_barang' => $harga_barang,
                'total_harga' => $harga_barang * $jumlah_barang,
            ];
        }

        return $keranjang_belanja;
    }


    public function create(array $keranjang, string $nama_pembeli, int $uang): void
    {
        $total_harga = $this->total($keranjang);
        $tanggal = date("Y-m-d");

        mysqli_query(
            $this->koneksi,
            "INSERT INTO penjualan VALUES (NULL, '$nama_pembeli', '$total_harga', '$uang', '$tanggal')"
        );

        $id_penjualan = mysqli_query(
            $this->koneksi,
            "SELECT id_penjualan FROM penjualan ORDER BY id_penjualan DESC LIMIT 1"
        );
        foreach ($id_penjualan as $value) {
            $id_penjualan_value = $value['id_penjualan'];
        }

        $this->create_keranjang($keranjang, $id_penjualan_value);
    }

    public function create_keranjang(array $keranjang, int $id_penjualan): void
    {
        foreach ($keranjang as $value) {
            $id_barang = $value['id_barang'];
            $jumlah_barang = $value['jumlah_barang'];

            $barang_data = mysqli_query(
                $this->koneksi,
                "SELECT * FROM barang WHERE id_barang = '$id_barang'"
            );
            foreach ($barang_data as $value2) {
                $nama_barang = $value2['nama_barang'];
                $harga_barang = $value2['harga_barang'];
            }

            mysqli_query(
                $this->koneksi,
                "INSERT INTO keranjang VALUES (NULL, '$id_penjualan', '$nama_barang', '$harga_barang', '$jumlah_barang')"
            );
        }
    }

    public function total(array $keranjang)
    {
        $total = 0;

        foreach ($keranjang as $value) {
            $id_barang = $value['id_barang'];
            $jumlah_barang = $value['jumlah_barang'];

            $barang_data = mysqli_query(
                $this->koneksi,
                "SELECT * FROM barang WHERE id_barang = '$id_barang'"
            );
            foreach ($barang_data as $value2) {
                $harga_barang = $value2['harga_barang'];

                $new_stok = $value2['stok'] - $jumlah_barang;
                mysqli_query(
                    $this->koneksi,
                    "UPDATE barang SET stok = '$new_stok' WHERE id_barang = '$id_barang'"
                );
            }

            $total += $harga_barang * $jumlah_barang;
        }

        return $total;
    }
}
