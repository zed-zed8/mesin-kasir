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

        $barang_data = [[
            "nama_barang" => $nama_barang,
            "harga_barang" => $harga_barang,
            "diskon" => $diskon,
        ]];
        $news = new news();
        $news->create($barang_data, tipe_news::tambah_barang);
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
        $barang_data = $this->get_data_id($id_barang);
        foreach ($barang_data as $value) {
            $nama_barang_old = $value['nama_barang'];
            $harga_barang_old = $value['harga_barang'];
            $stok_old = $value['stok'];
            $diskon_old = $value['diskon'];
        }


        $sql = "UPDATE barang SET nama_barang = ?, harga_barang = ?, stok = ?, diskon = ? WHERE id_barang = ?";
        $stmt = mysqli_prepare($this->koneksi, $sql);

        mysqli_stmt_bind_param($stmt, "siiii", $nama_barang, $harga_barang, $stok, $diskon, $id_barang);
        $result = mysqli_stmt_execute($stmt);


        $barang_data = [[
            "nama_barang_old" => $nama_barang_old,
            "harga_barang_old" => $harga_barang_old,
            "stok_old" => $stok_old,
            "diskon_old" => $diskon_old,
            "nama_barang" => $nama_barang,
            "harga_barang" => $harga_barang,
            "stok" => $stok,
            "diskon" => $diskon,
        ]];

        $news = new news();
        if ($nama_barang_old !== $nama_barang) {
            $news->create($barang_data, tipe_news::update_nama);
        }
        if ($harga_barang_old !== $harga_barang) {
            $news->create($barang_data, tipe_news::update_harga);
        }
        if ($stok_old !== $stok) {
            $news->create($barang_data, tipe_news::restok);
        }

        if ($diskon_old !== $diskon) {
            if ($diskon_old == 0) {
                $news->create($barang_data, tipe_news::new_diskon);
            } else {
                $news->create($barang_data, tipe_news::update_diskon);
            }
        }
    }

    public function edit_diskon(int $id_barang, int $diskon): void
    {
        foreach ($this->get_data_id($id_barang) as $value) {
            $nama_barang_old = $value['nama_barang'];
            $harga_barang_old = $value['harga_barang'];
            $diskon_old = $value['diskon'];
        }


        $sql = "UPDATE barang SET diskon = ? WHERE id_barang = ?";
        $stmt = mysqli_prepare($this->koneksi, $sql);

        mysqli_stmt_bind_param($stmt, "ii", $diskon, $id_barang);
        $result = mysqli_stmt_execute($stmt);


        $barang_data = [[
            "nama_barang_old" => $nama_barang_old,
            "harga_barang_old" => $harga_barang_old,
            "diskon_old" => $diskon_old,
            "diskon" => $diskon,
        ]];
        $news = new news();
        if ($diskon_old !== $diskon) {
            if ($diskon_old == 0) {
                $news->create($barang_data, tipe_news::new_diskon);
            } else {
                $news->create($barang_data, tipe_news::update_diskon);
            }
        }
    }

    public function delete_barang(int $id_barang): void
    {
        $barang_data = NULL;
        foreach ($this->get_data_id($id_barang) as $value) {
            $barang_data = [[
                "nama_barang" => $value['nama_barang'],
            ]];
        }
        $news = new news();
        $news->create($barang_data, tipe_news::delete_barang);


        $sql = "DELETE FROM barang WHERE id_barang = ?";
        $stmt = mysqli_prepare($this->koneksi, $sql);

        mysqli_stmt_bind_param($stmt, "i", $id_barang);
        $result = mysqli_stmt_execute($stmt);
    }
}
