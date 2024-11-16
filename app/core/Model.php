<?php

namespace App\Core;

use PDO;

class Model {
    
    protected $db;

    public function __construct() {
        // Khởi tạo kết nối cơ sở dữ liệu
        $this->db = Database::getInstance();
    }

    // Phương thức lấy tất cả bản ghi
    public function getAll($table) {
        $query = "SELECT * FROM " . $table;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Phương thức lấy bản ghi theo ID
    public function getById($table, $id) {
        $query = "SELECT * FROM " . $table . " WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Phương thức để thực thi câu lệnh SQL (INSERT, UPDATE, DELETE)
    public function query($query, $params = []) {
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }
}
