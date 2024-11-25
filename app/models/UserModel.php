<?php

namespace App\Models;

use App\Core\Model;

class UserModel extends Model {

    // Lấy tất cả người dùng
    public function getAllUsers() {
        return $this->getAll('users');
    }

    // Thêm người dùng mới
    public function addUser($username, $email, $password_hash, $role = 'client') {
        $query = "INSERT INTO users (username, email, password_hash, role) 
                  VALUES (:username, :email, :password_hash, :role)";
        return $this->query($query, [
            'username' => $username,
            'email' => $email,
            'password_hash' => $password_hash,
            'role' => $role
        ]);
    }

    // Cập nhật thông tin người dùng
    public function updateUser($id, $username, $email, $password_hash = null, $role = 'client') {
        $query = "UPDATE users 
                  SET username = :username, email = :email, role = :role";
        $params = [
            'id' => $id,
            'username' => $username,
            'email' => $email,
            'role' => $role
        ];

        if ($password_hash) {
            $query .= ", password_hash = :password_hash";
            $params['password_hash'] = $password_hash;
        }

        $query .= " WHERE id = :id";
        return $this->query($query, $params);
    }

    // Xóa người dùng
    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = :id";
        return $this->query($query, ['id' => $id]);
    }

    // Lấy thông tin người dùng theo ID
    public function getUserById($id) {
        return $this->getById('users', $id);
    }
}
?>
