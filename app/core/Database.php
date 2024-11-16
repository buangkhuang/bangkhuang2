<?php

namespace App\Core;

use PDO;
use PDOException;

class Database {

    private static $instance = null;
    private $pdo;

    private function __construct() {
        // Cấu hình kết nối cơ sở dữ liệu
        $dsn = 'mysql:host=localhost;dbname=project_v1_n10;charset=utf8';
        $username = 'root';
        $password = '';

        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }

    // Phương thức lấy instance (Singleton)
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->pdo;
    }
}
