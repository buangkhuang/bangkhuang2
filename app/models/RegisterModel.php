<?php

namespace App\Models;

use App\Core\Model;

class RegisterModel extends Model
{
    // Kiểm tra xem email đã tồn tại trong bảng `users`
    public function checkEmailExists($email)
    {
        $query = "SELECT id FROM users WHERE email = :email";
        $params = [':email' => $email];
        $stmt = $this->query($query, $params);
        return $stmt->rowCount() > 0; // Trả về true nếu email tồn tại
    }

    // Thêm một người dùng mới vào cơ sở dữ liệu
    public function registerUser($username, $email, $hashedPassword)
    {
        $query = "INSERT INTO users (username, email, password_hash, role, created_at) 
                  VALUES (:username, :email, :password_hash, 'client', NOW())"; // Đã sửa 'password' thành 'password_hash'
        $params = [
            ':username' => $username,
            ':email' => $email,
            ':password_hash' => $hashedPassword, // Sử dụng 'password_hash' thay vì 'password'
        ];
        return $this->query($query, $params)->rowCount() > 0; // Trả về true nếu thêm thành công
    }

    // Lấy thông tin của người dùng bằng email
    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $params = [':email' => $email];
        $stmt = $this->query($query, $params);
        return $stmt->fetch(\PDO::FETCH_ASSOC); // Trả về thông tin người dùng hoặc false nếu không tìm thấy
    }
}
