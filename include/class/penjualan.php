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
        $sql = "SELECT * FROM keranjang WHERE id_penjualan = ?";
        $stmt = mysqli_prepare($this->koneksi, $sql);

        mysqli_stmt_bind_param($stmt, "i", $id_penjualan);
        $result = mysqli_stmt_execute($stmt);

        $keranjang = mysqli_stmt_get_result($stmt);

        $keranjang_belanja = [];

        foreach ($keranjang as $value) {
            $nama_barang = $value['nama_barang'];
            $harga_barang = $value['harga_barang'];
            $jumlah_barang = $value['jumlah_barang'];
            $total_harga = $value['total_harga'];
            $diskon_barang = $value['diskon_barang'];

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
                'total_harga' => $total_harga,
                'diskon_barang' => $diskon_barang,
            ];
        }

        return $keranjang_belanja;
    }


    public function create(array $keranjang, string $nama_pembeli, int $uang): void
    {
        $total_harga = $this->total($keranjang);
        $tanggal = date("Y-m-d");

        $sql = "INSERT INTO penjualan (id_penjualan, nama_pembeli, total_harga, uang, tanggal) 
                VALUES (NULL, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->koneksi, $sql);

        mysqli_stmt_bind_param($stmt, "siis", $nama_pembeli, $total_harga, $uang, $tanggal);
        $result = mysqli_stmt_execute($stmt);

        $id_penjualan = mysqli_query(
            $this->koneksi,
            "SELECT id_penjualan FROM penjualan ORDER BY id_penjualan DESC LIMIT 1"
        );
        foreach ($id_penjualan as $value) {
            $id_penjualan_value = $value['id_penjualan'];
        }

        $this->create_keranjang($keranjang, $id_penjualan_value);

        //* membenarkan total harga berdasarkan diskon 
        $data_keranjang = $this->get_data_keranjang($id_penjualan);
        foreach ($data_keranjang as $value) {
            $total_harga -= $value['diskon'];
        }
        mysqli_query(
            $this->koneksi,
            "UPDATE penjualan SET total_harga = '$total_harga' WHERE id_penjualan = '$id_penjualan'"
        );
    }

    private function create_keranjang(array $keranjang, int $id_penjualan): int
    {
        foreach ($keranjang as $value) {
            $id_barang = $value['id_barang'];
            $jumlah_barang = $value['jumlah_barang'];

            $sql = "SELECT * FROM barang WHERE id_barang = ?";
            $stmt = mysqli_prepare($this->koneksi, $sql);

            mysqli_stmt_bind_param($stmt, "i", $id_barang);
            $result = mysqli_stmt_execute($stmt);

            $barang_data = mysqli_stmt_get_result($stmt);
            foreach ($barang_data as $value2) {
                $nama_barang = $value2['nama_barang'];
                $harga_barang = $value2['harga_barang'];
                $diskon = $value2['diskon'];
            }

            $total_harga = $harga_barang * $jumlah_barang;

            //* diskon 
            if ($diskon !== 0) {
                $diskon_barang = $total_harga * ($diskon / 100);
            } else $diskon_barang = 0;
            $total_harga = $total_harga - $diskon_barang;


            $sql = "INSERT INTO keranjang (id_keranjang, id_penjualan, nama_barang, harga_barang, jumlah_barang, total_harga, diskon_barang) 
                    VALUES (NULL, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($this->koneksi, $sql);

            mysqli_stmt_bind_param($stmt, "isiiii", $id_penjualan, $nama_barang, $harga_barang, $jumlah_barang, $total_harga, $diskon_barang);
            $result = mysqli_stmt_execute($stmt);

            return $diskon_barang;
        }
        return 0;
    }

    private function total(array $keranjang): int|float
    {
        $total = 0;

        foreach ($keranjang as $value) {
            $id_barang = $value['id_barang'];
            $jumlah_barang = $value['jumlah_barang'];

            $sql = "SELECT * FROM barang WHERE id_barang = ?";
            $stmt = mysqli_prepare($this->koneksi, $sql);

            mysqli_stmt_bind_param($stmt, "i", $id_barang);
            $result = mysqli_stmt_execute($stmt);

            $barang_data = mysqli_stmt_get_result($stmt);
            foreach ($barang_data as $value2) {
                $harga_barang = $value2['harga_barang'];
                $new_stok = $value2['stok'] - $jumlah_barang;

                $sql = "UPDATE barang SET stok = ? WHERE id_barang = ?";
                $stmt = mysqli_prepare($this->koneksi, $sql);

                mysqli_stmt_bind_param($stmt, "ii", $new_stok, $id_barang);
                $result = mysqli_stmt_execute($stmt);
            }

            $total += $harga_barang * $jumlah_barang;
        }

        return $total;
    }

    public function clear_penjualan(): void
    {
        mysqli_query(
            $this->koneksi,
            "DELETE FROM penjualan"
        );
    }

    public function pendapatan(): int
    {
        $data_penjualan = mysqli_query(
            $this->koneksi,
            "SELECT * FROM penjualan"
        );

        $pendapatan = 0;
        foreach ($data_penjualan as $value) {
            $pendapatan += $value['total_harga'];
        }
        return $pendapatan;
    }
}
