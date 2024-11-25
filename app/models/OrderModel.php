<?php

namespace App\Models;

use App\Core\Model;

class OrderModel extends Model
{
    // Lấy tất cả đơn hàng từ cơ sở dữ liệu
    public function getAllOrders()
    {
        $sql = "SELECT * FROM orders ORDER BY created_at DESC";
        return $this->db->query($sql)->fetchAll();
    }

    // Lấy đơn hàng theo ID
    public function getOrderById($id)
    {
        $sql = "SELECT * FROM orders WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Lấy các mặt hàng trong đơn hàng theo ID đơn hàng
    public function getOrderItems($orderId)
    {
        $sql = "SELECT oi.*, p.name AS product_name, p.price AS product_price 
                FROM order_items oi 
                JOIN products p ON oi.product_id = p.id 
                WHERE oi.order_id = :order_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':order_id' => $orderId]);
        return $stmt->fetchAll();
    }

    // Thêm đơn hàng mới vào cơ sở dữ liệu
    public function createOrder($user_id, $customer_name, $customer_email, $customer_phone, $total_amount, $payment_method, $shipping_address)
    {
        $sql = "INSERT INTO orders (user_id, customer_name, customer_email, customer_phone, total_amount, payment_method, shipping_address, created_at)
                VALUES (:user_id, :customer_name, :customer_email, :customer_phone, :total_amount, :payment_method, :shipping_address, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':user_id' => $user_id,
            ':customer_name' => $customer_name,
            ':customer_email' => $customer_email,
            ':customer_phone' => $customer_phone,
            ':total_amount' => $total_amount,
            ':payment_method' => $payment_method,
            ':shipping_address' => $shipping_address
        ]);
    }

    // Cập nhật trạng thái thanh toán của đơn hàng
    public function updatePaymentStatus($id, $payment_status)
    {
        $sql = "UPDATE orders SET payment_status = :payment_status WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':payment_status' => $payment_status,
            ':id' => $id
        ]);
    }

    // Cập nhật trạng thái vận chuyển của đơn hàng
    public function updateShippingStatus($id, $shipping_status)
    {
        $sql = "UPDATE orders SET shipping_status = :shipping_status WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':shipping_status' => $shipping_status,
            ':id' => $id
        ]);
    }

    // Xóa đơn hàng khỏi cơ sở dữ liệu
    public function deleteOrder($id)
    {
        // Xóa các mặt hàng trong đơn hàng
        $sql = "DELETE FROM order_items WHERE order_id = :order_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':order_id' => $id]);

        // Xóa đơn hàng
        $sql = "DELETE FROM orders WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    // Tìm kiếm đơn hàng theo từ khóa
    public function searchOrders($keyword)
    {
        $sql = "SELECT * FROM orders 
                WHERE customer_name LIKE :keyword 
                OR customer_email LIKE :keyword 
                OR customer_phone LIKE :keyword 
                ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':keyword' => '%' . $keyword . '%']);
        return $stmt->fetchAll();
    }
}
