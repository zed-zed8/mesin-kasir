<?php

enum tipe_news: string
{
    case tambah_barang = "barang Baru";
    case update_nama = "nama baru";
    case update_harga = "harga baru";
    case update_diskon = "update diskon";
    case new_diskon = "diskon baru";
    case restok = "restok";
    case delete_barang = "barang dihapus";
}

class news extends database
{
    public function create(iterable $barang_data, tipe_news $tipe): void
    {
        $tanggal = date("Y-m-d");

        foreach ($barang_data as $value) {
            switch ($tipe) {
                case tipe_news::tambah_barang:
                    $isi = "Terdapat barang baru bernama " . $value['nama_barang'] . " dengan harga RP" . numsFormat($value['harga_barang']);
                    if ($value['diskon'] !== 0) {
                        $isi .= " dan dengan diskon " . $value['diskon'] . "%";
                    }
                    break;

                case tipe_news::update_nama:
                    $isi = $value['nama_barang_old'] . " mendapat nama baru menjadi " . $value['nama_barang'];
                    break;
                case tipe_news::update_harga:
                    $isi = "Harga " . $value['nama_barang_old'] . " berubah dari RP" . numsFormat($value['harga_barang_old']) . " menjadi RP" . numsFormat($value['harga_barang']);
                    break;
                case tipe_news::update_diskon:
                    $isi = "Diskon " . $value['nama_barang_old'] . " berubah dari " . $value['diskon_old'] . "% menjadi " . $value['diskon'] . "%";
                    break;
                case tipe_news::restok:
                    $isi = $value['nama_barang'] . " mendapat restok. Stoknya dari " . $value['stok_old'] . " menjadi " . numsFormat($value['stok']);
                    break;
                case tipe_news::new_diskon:
                    $isi = $value['nama_barang'] . " mendapat diskon " . $value['diskon'] . "%";
                    break;

                case tipe_news::delete_barang:
                    $isi = $value['nama_barang'] . " dihapus";
                    break;

                default:
                    error_log("tipe news not found");
            }
        }

        $tipe = $tipe->value;
        $sql = "INSERT INTO news (id, isi, tipe, tanggal) 
                VALUES (NULL, ?, ?, ?)";
        $stmt = mysqli_prepare($this->koneksi, $sql);

        mysqli_stmt_bind_param($stmt, "sss", $isi, $tipe, $tanggal);
        $result = mysqli_stmt_execute($stmt);
    }

    public function get_data(): mysqli_result|bool
    {
        $data = mysqli_query($this->koneksi, "SELECT * FROM news");
        return $data;
    }
}
