<?php
use App\Core\Router;
<<<<<<< HEAD
// Khởi động router và điều hướng yêu cầu
$router = new Router();

// Cấu hình route
$router->add('GET', '/manga_shop/categories', 'CategoryController@index');         // Hiển thị danh mục
$router->add('GET', '/manga_shop/categories/create', 'CategoryController@create'); // Hiển thị form thêm danh mục
$router->add('POST', '/manga_shop/categories/store', 'CategoryController@store');  // Xử lý thêm danh mục
$router->add('GET', '/manga_shop/categories/edit/{id}', 'CategoryController@edit'); // Hiển thị form sửa danh mục
$router->add('POST', '/manga_shop/categories/update/{id}', 'CategoryController@update'); // Xử lý cập nhật danh mục
$router->add('GET', '/manga_shop/categories/delete/{id}', 'CategoryController@delete'); // Xử lý xóa danh mục
$router->add('GET', '/products', 'ProductController@index');
$router->add('GET', '/users', 'UserController@index');
$router->add('GET', '/payments', 'PaymentController@index');
$router->add('GET', '/orders', 'OrderController@index');
=======

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
$router->add('GET', '/users', 'UserController@index');                                  // Hiển thị danh sách người dùng

// Cấu hình route cho Payment (Thanh toán)
$router->add('GET', '/payments', 'PaymentController@index');                            // Hiển thị trang thanh toán

// Cấu hình route cho Order (Đơn hàng)
$router->add('GET', '/orders', 'OrderController@index');                                // Hiển thị danh sách đơn hàng
>>>>>>> b376628 (16/11)

// Lấy URL hiện tại và phương thức HTTP
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Dispatch route
$router->dispatch($url, $method);
<<<<<<< HEAD
=======
?>
>>>>>>> b376628 (16/11)
