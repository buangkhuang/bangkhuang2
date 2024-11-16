<?php
ob_start();
// Đặt đường dẫn gốc để dùng cho các tệp include
define('BASE_PATH', dirname(__DIR__) . '/app/views/');
// Tự động load các class sử dụng autoload của Composer
require_once dirname(__DIR__) . '/vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Manga Shop</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/manga_shop/public/img/favicon.png" rel="icon">
  <link href="/manga_shop/public/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/manga_shop/public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/manga_shop/public/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/manga_shop/public/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/manga_shop/public/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="/manga_shop/public/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="/manga_shop/public/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/manga_shop/public/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/manga_shop/public/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- Header -->
  <?php include BASE_PATH . 'common/header.php'; ?>

  <!-- Sidebar -->
  <?php include BASE_PATH . 'common/sidebar.php'; ?>

  <!-- Main Content -->
  <main id="main" class="main">
    <?php include BASE_PATH . 'common/pagetitle.php'; ?>
    <?php include BASE_PATH . 'common/route.php'; ?>
  </main>

  <!-- Footer -->
  <?php include BASE_PATH . 'common/footer.php'; ?>

  <!-- Vendor JS Files -->
  <script src="/manga_shop/public/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="/manga_shop/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/manga_shop/public/vendor/chart.js/chart.umd.js"></script>
  <script src="/manga_shop/public/vendor/echarts/echarts.min.js"></script>
  <script src="/manga_shop/public/vendor/quill/quill.js"></script>
  <script src="/manga_shop/public/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="/manga_shop/public/vendor/tinymce/tinymce.min.js"></script>
  <script src="/manga_shop/public/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/manga_shop/public/js/main.js"></script>
  <script src="/manga_shop/public/js/re_load.js"></script>
</body>

</html>
