<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\RegisterModel;

class RegisterController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        $data = ['pageTitle' => 'Register'];
        $this->view('auth/Register', $data);
    }

    // Xử lý đăng ký
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username']; // Đã đổi từ 'name' thành 'username'
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Khởi tạo RegisterModel và kiểm tra đăng ký
            $registerModel = new RegisterModel();

            // Kiểm tra nếu email đã tồn tại
            if ($registerModel->checkEmailExists($email)) {
                $data = [
                    'pageTitle' => 'Register',
                    'error' => 'Email already exists. Please use a different email.'
                ];
                $this->view('auth/Register', $data);
                return;
            }

            // Lưu thông tin người dùng mới
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $isRegistered = $registerModel->registerUser($username, $email, $hashedPassword);

            if ($isRegistered) {
                // Thành công, điều hướng đến trang login
                header('Location: /manga_shop/login');
                exit();
            } else {
                $data = [
                    'pageTitle' => 'Register',
                    'error' => 'Registration failed. Please try again later.'
                ];
                $this->view('auth/Register', $data);
            }
        }
    }
}
