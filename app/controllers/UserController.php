<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\UserModel;

class UserController extends Controller
{

    // Hiển thị tất cả người dùng
    public function index()
    {
        $userModel = new UserModel();
        $users = $userModel->getAllUsers();

        $data = [
            'pageTitle' => 'Users Management',
            'users' => $users
        ];

        // Gọi view hiển thị danh sách người dùng
        $this->view('admin/UserView', $data);
    }

    // Hiển thị form thêm người dùng mới
    public function create()
    {
        $data = [
            'pageTitle' => 'Add New User'
        ];

        // Gọi view thêm người dùng
        $this->view('admin/UserAdd', $data);
    }

    // Xử lý thêm người dùng mới
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'] ?? 'client';

            // Hash mật khẩu trước khi lưu
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            // Thêm người dùng mới vào cơ sở dữ liệu
            $userModel = new UserModel();
            $userModel->addUser($username, $email, $password_hash, $role);

            // Chuyển hướng sau khi thêm thành công
            header('Location: /manga_shop/users');
            exit();
        }
    }

    // Hiển thị form sửa người dùng
    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->getUserById($id);

        if ($user) {
            $data = [
                'pageTitle' => 'Edit User',
                'user' => $user
            ];

            // Gọi view chỉnh sửa người dùng
            $this->view('admin/UserEdit', $data);
        } else {
            // Nếu không tìm thấy người dùng, chuyển hướng về danh sách
            header('Location: /manga_shop/users');
            exit();
        }
    }

    // Xử lý cập nhật thông tin người dùng
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $password = $_POST['password'] ?? null;

            // Hash mật khẩu nếu có thay đổi
            $password_hash = $password ? password_hash($password, PASSWORD_BCRYPT) : null;

            // Cập nhật thông tin người dùng
            $userModel = new UserModel();
            $userModel->updateUser($id, $username, $email, $password_hash, $role);

            // Chuyển hướng sau khi cập nhật thành công
            header('Location: /manga_shop/users');
            exit();
        }
    }

    // Xử lý xóa người dùng
    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->deleteUser($id);

        // Chuyển hướng sau khi xóa thành công
        header('Location: /manga_shop/users');
        exit();
    }

    // Hiển thị thông tin chi tiết người dùng
    public function show($id)
    {
        $userModel = new UserModel();
        $user = $userModel->getUserById($id);

        if ($user) {
            $data = [
                'pageTitle' => 'User Details',
                'user' => $user
            ];

            // Gọi view hiển thị chi tiết người dùng
            $this->view('admin/UserDetails', $data);
        } else {
            // Nếu không tìm thấy người dùng, chuyển hướng về danh sách
            header('Location: /manga_shop/users');
            exit();
        }
    }
}
