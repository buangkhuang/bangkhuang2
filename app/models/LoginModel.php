<?php

namespace App\Models;

use App\Core\Model;

class LoginModel extends Model
{
    // Lấy thông tin người dùng theo email
    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->query($query, ['email' => $email]); // Trả về PDOStatement
        return $stmt->fetch(\PDO::FETCH_ASSOC); // Dùng fetch để lấy kết quả dưới dạng mảng
    }

    // Kiểm tra thông tin đăng nhập
    public function checkLogin($email, $password)
    {
        $user = $this->getUserByEmail($email);

        if ($user && password_verify($password, $user['password_hash'])) {
            // Nếu thông tin hợp lệ, trả về thông tin người dùng
            return $user;
        }
        return null; // Sai email hoặc mật khẩu
    }

    // Cập nhật thời gian đăng nhập cuối cùng
    public function updateLastLogin($userId)
    {
        $query = "UPDATE users SET last_login = NOW() WHERE id = :id";
        return $this->query($query, ['id' => $userId]);
    }
}
