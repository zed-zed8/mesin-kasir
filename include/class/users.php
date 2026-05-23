<?php

class users extends database
{
    public function create(string $username, string $password, string $nama): void
    {
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

    public function get_data(): mysqli_result|bool
    {
        $data = mysqli_query($this->koneksi, 'SELECT * FROM users');
        return $data;
    }

    public function get_nama(string $password): string
    {
        $users_data = mysqli_query($this->koneksi, "SELECT * FROM users");

        foreach ($users_data as $value) {
            if ($password == $value['password']) {
                return $value['nama'];
            }
        }
        return "Missing nama";
    }

    public function userCheck(string $password): string
    {
        $sql = "SELECT * FROM users WHERE password = ?";
        $stmt = mysqli_prepare($this->koneksi, $sql);

        mysqli_stmt_bind_param($stmt, "s", $password);
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
