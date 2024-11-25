<?php

use App\Core\Router;

// Khởi động router và điều hướng yêu cầu
$router = new Router();

// Cấu hình route cho Category
$router->add('GET', '/manga_shop/categories', 'CategoryController@index');            // Hiển thị tất cả danh mục
$router->add('GET', '/manga_shop/categories/create', 'CategoryController@create');    // Hiển thị form thêm danh mục
$router->add('POST', '/manga_shop/categories/store', 'CategoryController@store');     // Xử lý thêm danh mục
$router->add('GET', '/manga_shop/categories/edit/{id}', 'CategoryController@edit');   // Hiển thị form sửa danh mục
$router->add('POST', '/manga_shop/categories/update/{id}', 'CategoryController@update'); // Xử lý cập nhật danh mục
$router->add('GET', '/manga_shop/categories/delete/{id}', 'CategoryController@delete'); // Xử lý xóa danh mục

// Cấu hình route cho Model (Mô hình)
$router->add('GET', '/manga_shop/models', 'ModelController@index');                     // Hiển thị tất cả mô hình
$router->add('GET', '/manga_shop/models/create', 'ModelController@create');             // Hiển thị form thêm mô hình
$router->add('POST', '/manga_shop/models/store', 'ModelController@store');              // Xử lý thêm mô hình
$router->add('GET', '/manga_shop/models/edit/{id}', 'ModelController@edit');            // Hiển thị form sửa mô hình
$router->add('POST', '/manga_shop/models/update/{id}', 'ModelController@update');       // Xử lý cập nhật mô hình
$router->add('GET', '/manga_shop/models/delete/{id}', 'ModelController@delete');        // Xử lý xóa mô hình
$router->add('GET', '/manga_shop/models/search', 'ModelController@search');             // Tìm kiếm mô hình

// Cấu hình route cho User (Người dùng)
$router->add('GET', '/manga_shop/users', 'UserController@index');                  // Hiển thị danh sách người dùng
$router->add('GET', '/manga_shop/users/create', 'UserController@create');          // Hiển thị form thêm người dùng
$router->add('POST', '/manga_shop/users/store', 'UserController@store');           // Xử lý thêm người dùng
$router->add('GET', '/manga_shop/users/edit/{id}', 'UserController@edit');         // Hiển thị form sửa người dùng
$router->add('POST', '/manga_shop/users/update/{id}', 'UserController@update');    // Xử lý cập nhật người dùng
$router->add('GET', '/manga_shop/users/delete/{id}', 'UserController@delete');     // Xử lý xóa người dùng
$router->add('GET', '/manga_shop/users/search', 'UserController@search');          // Tìm kiếm người dùng

// Cấu hình route cho Payment (Thanh toán)
$router->add('GET', '/payments', 'PaymentController@index');                            // Hiển thị trang thanh toán

// Cấu hình route cho Order (Đơn hàng)
// Routes for Order Management
$router->add('GET', '/manga_shop/orders', 'OrderController@index');                   // Hiển thị danh sách đơn hàng
$router->add('GET', '/manga_shop/orders/create', 'OrderController@create');           // Hiển thị form thêm mới đơn hàng
$router->add('POST', '/manga_shop/orders/store', 'OrderController@store');            // Xử lý lưu trữ đơn hàng mới
$router->add('GET', '/manga_shop/orders/edit/{id}', 'OrderController@edit');          // Hiển thị form chỉnh sửa đơn hàng
$router->add('POST', '/manga_shop/orders/update/{id}', 'OrderController@update');     // Xử lý cập nhật đơn hàng
$router->add('GET', '/manga_shop/orders/delete/{id}', 'OrderController@delete');      // Xóa đơn hàng
$router->add('GET', '/manga_shop/orders/show/{id}', 'OrderController@show');          // Hiển thị chi tiết đơn hàng

// Lấy URL hiện tại và phương thức HTTP
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Dispatch route
$router->dispatch($url, $method);
