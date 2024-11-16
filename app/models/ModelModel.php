<?php

namespace App\Models;

use App\Core\Model;
use App\Utils\CloudinaryUploader;

class ModelModel extends Model {

    private $cloudinaryUploader;

    public function __construct() {
        parent::__construct();
        $this->cloudinaryUploader = new CloudinaryUploader();
    }

    // Lấy tất cả mô hình kèm thông tin tên danh mục
    public function getAllModels() {
        $query = "SELECT models.*, categories.category_name FROM models 
                  LEFT JOIN categories ON models.category_id = categories.id";
        return $this->query($query);
    }

    // Lấy thông tin mô hình theo ID kèm thông tin tên danh mục
    public function getModelById($id) {
        $query = "SELECT models.*, categories.category_name FROM models
                  LEFT JOIN categories ON models.category_id = categories.id
                  WHERE models.id = :id";
        return $this->query($query, ['id' => $id]);
    }

    // Lấy mô hình theo danh mục kèm tên danh mục
    public function getModelsByCategory($categoryId) {
        $query = "SELECT models.*, categories.category_name FROM models
                  LEFT JOIN categories ON models.category_id = categories.id
                  WHERE models.category_id = :category_id";
        return $this->query($query, ['category_id' => $categoryId]);
    }

    // Thêm mô hình mới (hỗ trợ upload ảnh)
    public function addModel($data, $imagePath = null) {
        $imageUrl = null;

        if ($imagePath) {
            // Upload ảnh lên Cloudinary
            $fileName = uniqid() . '_' . pathinfo($imagePath, PATHINFO_FILENAME);
            $imageUrl = $this->cloudinaryUploader->uploadImage($imagePath, $fileName);
        }

        $query = "INSERT INTO models (category_id, model_name, description, price, brand, scale, material, dimensions, images, stock_quantity) 
                  VALUES (:category_id, :model_name, :description, :price, :brand, :scale, :material, :dimensions, :images, :stock_quantity)";
        return $this->query($query, [
            'category_id' => $data['category_id'],
            'model_name' => $data['model_name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'brand' => $data['brand'],
            'scale' => $data['scale'],
            'material' => $data['material'],
            'dimensions' => $data['dimensions'],
            'images' => $imageUrl, // Lưu URL ảnh
            'stock_quantity' => $data['stock_quantity'],
        ]);
    }

    // Cập nhật mô hình (hỗ trợ upload ảnh)
    public function updateModel($id, $data, $imagePath = null) {
        $imageUrl = $data['images'];

        if ($imagePath) {
            // Upload ảnh mới lên Cloudinary
            $fileName = uniqid() . '_' . pathinfo($imagePath, PATHINFO_FILENAME);
            $imageUrl = $this->cloudinaryUploader->uploadImage($imagePath, $fileName);
        }

        $query = "UPDATE models 
                  SET category_id = :category_id, 
                      model_name = :model_name, 
                      description = :description, 
                      price = :price, 
                      brand = :brand, 
                      scale = :scale, 
                      material = :material, 
                      dimensions = :dimensions, 
                      images = :images, 
                      stock_quantity = :stock_quantity
                  WHERE id = :id";
        return $this->query($query, [
            'id' => $id,
            'category_id' => $data['category_id'],
            'model_name' => $data['model_name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'brand' => $data['brand'],
            'scale' => $data['scale'],
            'material' => $data['material'],
            'dimensions' => $data['dimensions'],
            'images' => $imageUrl, // Lưu URL ảnh mới hoặc giữ nguyên URL cũ
            'stock_quantity' => $data['stock_quantity'],
        ]);
    }

    // Xóa mô hình
    public function deleteModel($id) {
        $query = "DELETE FROM models WHERE id = :id";
        return $this->query($query, ['id' => $id]);
    }

    // Cập nhật số lượng tồn kho
    public function updateStockQuantity($id, $quantity) {
        $query = "UPDATE models SET stock_quantity = :stock_quantity WHERE id = :id";
        return $this->query($query, [
            'id' => $id,
            'stock_quantity' => $quantity,
        ]);
    }

    // Tìm kiếm mô hình theo tên
    public function searchModelsByName($name) {
        $query = "SELECT models.*, categories.category_name FROM models
                  LEFT JOIN categories ON models.category_id = categories.id
                  WHERE models.model_name LIKE :name";
        return $this->query($query, ['name' => '%' . $name . '%']);
    }
}
?>
