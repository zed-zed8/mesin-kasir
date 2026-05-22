<?php

class users extends database
{
    public function create(string $username, string $password, string $nama): mysqli_result|bool
    {
        $result = mysqli_query(
            $this->koneksi,
            "INSERT INTO users VALUES (NULL, '$username', '$password', '$nama', 'user')"
        );
        return $result;
    }

    public function get_user(string $username, string $password): mysqli_result|bool
    {
        $result = mysqli_query(
            $this->koneksi,
            "SELECT * FROM users WHERE username='$username' and password='$password'"
        );
        return $result;
    }

    public function get_data(): mysqli_result|bool
    {
        $data = mysqli_query($this->koneksi, 'select * from users');
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
        $user_data = mysqli_query($this->koneksi, "select * from users where password = '$password'");
        foreach ($user_data as $value) {
            switch ($value['role']) {
                case 'user':
                    return "user";
                case 'admin':
                    return "admin";

                default:
                    return error_log("user check gagal");
            }
        }
        return error_log("user check gagal");
    }
}
