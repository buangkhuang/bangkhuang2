<?php

namespace App\Controllers;

use App\Core\Controller;

class DashboardController extends Controller {
    
    public function index() {
        // Dữ liệu mẫu để truyền vào view
        $data = [
            'pageTitle' => 'Dashboard'
        ];
        
        // Tải view của trang Dashboard
        $this->view('admin/DashBoardView', $data);
    }
}
