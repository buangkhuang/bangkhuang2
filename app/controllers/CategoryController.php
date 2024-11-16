<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\CategoryModel;

class CategoryController extends Controller {

    // Hiển thị tất cả danh mục
    public function index() {
        // Kiểm tra và lấy tất cả danh mục
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories();
        
        // Dữ liệu truyền vào view
        $data = [
            'pageTitle' => 'Category',
            'categories' => $categories
        ];
        
        // Gọi view với dữ liệu
        $this->view('admin/CategoryView', $data);
    }

    // Hiển thị form thêm danh mục mới
    public function create() {
        $data = [
            'pageTitle' => 'Add Category'
        ];
        
        // Gọi view thêm danh mục
        $this->view('admin/CategoryAdd', $data);
    }

    // Xử lý thêm danh mục mới
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $category_name = $_POST['category_name'];
            $description = $_POST['description'];

            // Thêm danh mục mới vào cơ sở dữ liệu
            $categoryModel = new CategoryModel();
            $categoryModel->addCategory($category_name, $description);

            // Chuyển hướng sau khi thêm
            header('Location: /manga_shop/categories');
            exit(); // Dừng thực thi sau khi chuyển hướng
        }
    }

    // Hiển thị form sửa danh mục
    public function edit($id) {
        $categoryModel = new CategoryModel();
        $category = $categoryModel->getCategoryById($id);

        if ($category) {
            $data = [
                'pageTitle' => 'Edit Category',
                'category' => $category
            ];
            // Gọi view sửa danh mục
            $this->view('admin/CategoryEdit', $data);
        } else {
            // Nếu danh mục không tồn tại, chuyển hướng về trang danh sách
            header('Location: /manga_shop/categories');
            exit(); // Dừng thực thi sau khi chuyển hướng
        }
    }

    // Xử lý cập nhật danh mục
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $category_name = $_POST['category_name'];
            $description = $_POST['description'];

            // Cập nhật thông tin danh mục
            $categoryModel = new CategoryModel();
            $categoryModel->updateCategory($id, $category_name, $description);

            // Chuyển hướng về danh sách sau khi cập nhật
            header('Location: /manga_shop/categories');
            exit(); // Dừng thực thi sau khi chuyển hướng
        }
    }

    // Xử lý xóa danh mục
    public function delete($id) {
        $categoryModel = new CategoryModel();
        $categoryModel->deleteCategory($id);

        // Chuyển hướng về danh sách danh mục sau khi xóa
        header('Location: /manga_shop/categories');
        exit(); // Dừng thực thi sau khi chuyển hướng
    }
}
?>
