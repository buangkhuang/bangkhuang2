<?php

namespace App\Models;

use App\Core\Model;

class CategoryModel extends Model {

    // Lấy tất cả danh mục
    public function getAllCategories() {
        return $this->getAll('categories');
    }

    // Thêm danh mục mới
    public function addCategory($category_name, $description) {
        $query = "INSERT INTO categories (category_name, description) VALUES (:category_name, :description)";
        return $this->query($query, ['category_name' => $category_name, 'description' => $description]);
    }

    // Cập nhật danh mục
    public function updateCategory($id, $category_name, $description) {
        $query = "UPDATE categories SET category_name = :category_name, description = :description WHERE id = :id";
        return $this->query($query, ['id' => $id, 'category_name' => $category_name, 'description' => $description]);
    }

    // Xóa danh mục
    public function deleteCategory($id) {
        $query = "DELETE FROM categories WHERE id = :id";
        return $this->query($query, ['id' => $id]);
    }

    // Lấy thông tin danh mục theo ID
    public function getCategoryById($id) {
        return $this->getById('categories', $id);
    }
}
?>
