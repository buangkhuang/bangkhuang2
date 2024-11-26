<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\LoginModel;

class LoginController extends Controller
{
    // Hiển thị form login
    public function showLoginForm()
    {
        $data = ['pageTitle' => 'Login'];
        $this->view('auth/Login', $data);
    }

    // Xử lý đăng nhập
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Khởi tạo LoginModel và kiểm tra đăng nhập
            $loginModel = new LoginModel();
            $user = $loginModel->checkLogin($email, $password);

            if ($user) {
                // Lưu thông tin user vào session
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username']; // Lưu tên người dùng vào session
                $_SESSION['role'] = $user['role'];

                // Cập nhật thời gian đăng nhập cuối cùng
                $loginModel->updateLastLogin($user['id']);

                // Điều hướng theo vai trò
                if ($user['role'] === 'admin') {
                    header('Location: /manga_shop/admin');
                } else {
                    header('Location: /manga_shop/home');
                }
                exit();
            } else {
                // Sai thông tin đăng nhập
                $data = [
                    'pageTitle' => 'Login',
                    'error' => 'Invalid email or password'
                ];
                $this->view('auth/Login', $data);
            }
        }
    }

    // Đăng xuất
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /manga_shop/login');
        exit();
    }
}
