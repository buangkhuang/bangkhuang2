<?php

namespace App\Core;

class Controller {
    
    // Phương thức để tải view
    public function view($view, $data = []) {
        // Kiểm tra nếu file view tồn tại
        if (file_exists("../app/views/" . $view . ".php")) {
            // Chuyển dữ liệu vào view
            extract($data);
            include "../app/views/" . $view . ".php";
        } else {
            die("View does not exist.");
        }
    }
    
    // Phương thức để chuyển hướng
    public function redirect($url) {
        header("Location: " . $url);
        exit();
    }
}
