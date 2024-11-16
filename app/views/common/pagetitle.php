<?php
// Định nghĩa tiêu đề trang và breadcrumbs dựa trên URL hiện tại
$pageTitles = [
    '/manga_shop/' => 'Dashboard',  // Thêm ánh xạ cho trang mặc định
    '/manga_shop/index.html' => 'Dashboard',
    '/manga_shop/categories' => 'Quản Lý Danh Mục',
<<<<<<< HEAD
    '/manga_shop/products' => 'Quản Lý Sản Phẩm',
=======
    '/manga_shop/models' => 'Quản Lý Sản Phẩm',
>>>>>>> b376628 (16/11)
    '/manga_shop/users' => 'Quản Lý Người Dùng',
    '/manga_shop/payments' => 'Quản Lý Thanh Toán',
    '/manga_shop/orders' => 'Quản Lý Đơn Hàng',
    '/manga_shop/login' => 'Login',
    '/manga_shop/register' => 'Register',
];

// Lấy URL hiện tại
$currentUrl = $_SERVER['REQUEST_URI'];

// Xác định tiêu đề trang dựa trên URL hiện tại
$pageTitle = $pageTitles[$currentUrl] ?? 'Page Not Found';

?>

<!-- Phần tiêu đề trang (pagetitle) -->
<div class="pagetitle">
    <h1><?php echo $pageTitle; ?></h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/manga_shop/index.html">Home</a></li>
            <?php if ($currentUrl != '/manga_shop/index.html' && $currentUrl != '/manga_shop/') : ?>
                <li class="breadcrumb-item active"><?php echo $pageTitle; ?></li>
            <?php endif; ?>
        </ol>
    </nav>
</div>
<!-- Kết thúc tiêu đề trang -->
