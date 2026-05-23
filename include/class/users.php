<?php

class users extends database
{
    public function create(string $username, string $password, string $nama): void
    {
        $password = MD5($password);

        $sql = "INSERT INTO users (id_user, username, password, nama, role) VALUES (NULL, ?, ?, ?, 'user')";
        $stmt = mysqli_prepare($this->koneksi, $sql);

        mysqli_stmt_bind_param($stmt, "sss", $username, $password, $nama);
        $result = mysqli_stmt_execute($stmt);
    }

    public function get_user(string $username, string $password): bool
    {
        $sql = "SELECT * FROM users WHERE username = ? and password = ?";
        $stmt = mysqli_prepare($this->koneksi, $sql);

        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        $result = mysqli_stmt_execute($stmt);

        return $result;
    }

    public function get_id(string $password): string
    {
        $password = MD5($password);

        $sql = "SELECT id_user FROM users WHERE password = ?";
        $stmt = mysqli_prepare($this->koneksi, $sql);

        mysqli_stmt_bind_param($stmt, "s", $password);
        $result = mysqli_stmt_execute($stmt);

        $users_data = mysqli_stmt_get_result($stmt);

        foreach ($users_data as $value) {
            return $value["id_user"];
        }
        return "Missing id_user";
    }


    public function get_data(): mysqli_result|bool
    {
        $data = mysqli_query($this->koneksi, 'SELECT * FROM users');
        return $data;
    }

    public function get_nama(int $id_user): string
    {
        $sql = "SELECT nama FROM users WHERE id_user = ?";
        $stmt = mysqli_prepare($this->koneksi, $sql);

        mysqli_stmt_bind_param($stmt, "s", $id_user);
        $result = mysqli_stmt_execute($stmt);

        $users_data = mysqli_stmt_get_result($stmt);

        foreach ($users_data as $value) {
            return $value['nama'];
        }
        return "Missing nama";
    }

    public function userCheck(int $id_user): string
    {
        $sql = "SELECT * FROM users WHERE id_user = ?";
        $stmt = mysqli_prepare($this->koneksi, $sql);

        mysqli_stmt_bind_param($stmt, "s", $id_user);
        $result = mysqli_stmt_execute($stmt);

        $user_data = mysqli_stmt_get_result($stmt);

        foreach ($user_data as $value) {
            switch ($value['role']) {
                case 'user':
                    return "user";
                case 'admin':
                    return "admin";

                default:
                    return "user check gagal";
            }
        }
        return "user check gagal";
    }
}
