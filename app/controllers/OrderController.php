<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\OrderModel;

class OrderController extends Controller
{
    private $OrderModel;

    public function __construct()
    {
        // Khởi tạo model PaymentModel
        $this->OrderModel = new OrderModel();
    }

    // Hiển thị tất cả đơn hàng
    public function index()
    {
        // Lấy danh sách tất cả đơn hàng từ model
        $orders = $this->OrderModel->getAllOrders();

        // Dữ liệu gửi đến view
        $data = [
            'pageTitle' => 'Orders Management',
            'orders' => $orders
        ];

        // Gọi view hiển thị danh sách đơn hàng
        $this->view('admin/OrderView', $data);
    }

    // Hiển thị form thêm mới đơn hàng
    public function create()
    {
        // Dữ liệu gửi đến view
        $data = [
            'pageTitle' => 'Add New Order'
        ];

        // Gọi view thêm đơn hàng
        $this->view('admin/OrderAdd', $data);
    }

    // Xử lý thêm mới đơn hàng
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_id = $_POST['user_id'] ?? null;
            $customer_name = $_POST['customer_name'];
            $customer_email = $_POST['customer_email'];
            $customer_phone = $_POST['customer_phone'];
            $total_amount = $_POST['total_amount'];
            $payment_method = $_POST['payment_method'];
            $shipping_address = $_POST['shipping_address'];

            // Thêm đơn hàng mới vào cơ sở dữ liệu
            $this->OrderModel->createOrder($user_id, $customer_name, $customer_email, $customer_phone, $total_amount, $payment_method, $shipping_address);

            // Chuyển hướng sau khi thêm thành công
            header('Location: /manga_shop/orders');
            exit();
        }
    }

    // Hiển thị form chỉnh sửa đơn hàng
    public function edit($id)
    {
        $order = $this->OrderModel->getOrderById($id);

        if ($order) {
            $data = [
                'pageTitle' => 'Edit Order',
                'order' => $order
            ];

            // Gọi view chỉnh sửa đơn hàng
            $this->view('admin/OrderEdit', $data);
        } else {
            // Nếu không tìm thấy đơn hàng, chuyển hướng về danh sách
            header('Location: /manga_shop/orders');
            exit();
        }
    }

    // Xử lý cập nhật thông tin đơn hàng
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $payment_status = $_POST['payment_status'] ?? null;
            $shipping_status = $_POST['shipping_status'] ?? null;

            // Cập nhật thông tin thanh toán và vận chuyển
            if ($payment_status) {
                $this->OrderModel->updatePaymentStatus($id, $payment_status);
            }

            if ($shipping_status) {
                $this->OrderModel->updateShippingStatus($id, $shipping_status);
            }

            // Chuyển hướng sau khi cập nhật thành công
            header('Location: /manga_shop/orders');
            exit();
        }
    }

    // Hiển thị chi tiết đơn hàng
    public function show($id)
    {
        $order = $this->OrderModel->getOrderById($id);
        $orderItems = $this->OrderModel->getOrderItems($id);

        if ($order) {
            $data = [
                'pageTitle' => 'Order Details',
                'order' => $order,
                'orderItems' => $orderItems
            ];

            // Gọi view hiển thị chi tiết đơn hàng
            $this->view('admin/OrderDetails', $data);
        } else {
            // Nếu không tìm thấy đơn hàng, chuyển hướng về danh sách
            header('Location: /manga_shop/orders');
            exit();
        }
    }

    // Xử lý xóa đơn hàng
    public function delete($id)
    {
        $this->OrderModel->deleteOrder($id);

        // Chuyển hướng sau khi xóa thành công
        header('Location: /manga_shop/orders');
        exit();
    }

    // Tìm kiếm đơn hàng
    public function search()
    {
        $keyword = $_GET['keyword'] ?? '';
        $orders = $this->OrderModel->searchOrders($keyword);

        $data = [
            'pageTitle' => 'Search Orders',
            'orders' => $orders
        ];

        // Gọi view hiển thị kết quả tìm kiếm
        $this->view('admin/OrderSearch', $data);
    }
}
