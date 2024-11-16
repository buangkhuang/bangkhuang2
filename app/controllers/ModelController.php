<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ModelModel;
use App\Models\CategoryModel;

class ModelController extends Controller {

    // Hiển thị danh sách tất cả mô hình
    public function index() {
        $modelModel = new ModelModel();
        $models = $modelModel->getAllModels();

        $data = [
            'pageTitle' => 'Models',
            'models' => $models
        ];

        // Gọi view danh sách mô hình
        $this->view('admin/ModelView', $data);
    }

    // Hiển thị form thêm mô hình mới
    public function create() {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories(); // Lấy danh sách các danh mục

        $data = [
            'pageTitle' => 'Add Model',
            'categories' => $categories // Truyền danh sách các danh mục vào view
        ];

        // Gọi view thêm mô hình
        $this->view('admin/ModelAdd', $data);
    }

    // Xử lý thêm mô hình mới
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'category_id' => $_POST['category_id'],
                'model_name' => $_POST['model_name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'brand' => $_POST['brand'],
                'scale' => $_POST['scale'],
                'material' => $_POST['material'],
                'dimensions' => $_POST['dimensions'],
                'stock_quantity' => $_POST['stock_quantity'],
            ];

            // Xử lý upload ảnh
            $imagePath = null;
            if (isset($_FILES['images']) && $_FILES['images']['error'] === UPLOAD_ERR_OK) {
                $imagePath = $_FILES['images']['tmp_name'];
            }

            // Gọi model để thêm vào cơ sở dữ liệu
            $modelModel = new ModelModel();
            $modelModel->addModel($data, $imagePath);

            // Chuyển hướng về danh sách mô hình sau khi thêm
            header('Location: /manga_shop/models');
            exit();
        }
    }

    // Hiển thị form chỉnh sửa mô hình
    public function edit($id) {
        $modelModel = new ModelModel();
        $model = $modelModel->getModelById($id);

        // Lấy danh sách các danh mục
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories();

        if ($model) {
            $data = [
                'pageTitle' => 'Edit Model',
                'model' => $model,
                'categories' => $categories // Truyền danh sách danh mục vào view
            ];

            // Gọi view chỉnh sửa mô hình
            $this->view('admin/ModelEdit', $data);
        } else {
            // Nếu mô hình không tồn tại, chuyển hướng về danh sách mô hình
            header('Location: /manga_shop/models');
            exit();
        }
    }

    // Xử lý cập nhật mô hình
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'category_id' => $_POST['category_id'],
                'model_name' => $_POST['model_name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'brand' => $_POST['brand'],
                'scale' => $_POST['scale'],
                'material' => $_POST['material'],
                'dimensions' => $_POST['dimensions'],
                'stock_quantity' => $_POST['stock_quantity'],
                'existing_image' => $_POST['existing_image'] // URL của ảnh hiện tại nếu không tải ảnh mới
            ];

            // Xử lý upload ảnh mới
            $imagePath = null;
            if (isset($_FILES['images']) && $_FILES['images']['error'] === UPLOAD_ERR_OK) {
                $imagePath = $_FILES['images']['tmp_name'];
            }

            // Gọi model để cập nhật vào cơ sở dữ liệu
            $modelModel = new ModelModel();
            $modelModel->updateModel($id, $data, $imagePath);

            // Chuyển hướng về danh sách mô hình sau khi cập nhật
            header('Location: /manga_shop/models');
            exit();
        }
    }

    // Xóa mô hình
    public function delete($id) {
        $modelModel = new ModelModel();
        $modelModel->deleteModel($id);

        // Chuyển hướng về danh sách mô hình sau khi xóa
        header('Location: /manga_shop/models');
        exit();
    }

    // Tìm kiếm mô hình theo tên
    public function search() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['query'])) {
            $query = $_GET['query'];

            $modelModel = new ModelModel();
            $models = $modelModel->searchModelsByName($query);

            $data = [
                'pageTitle' => 'Search Results',
                'models' => $models
            ];

            // Gọi view hiển thị kết quả tìm kiếm
            $this->view('admin/ModelSearch', $data);
        } else {
            // Nếu không có từ khóa, chuyển hướng về danh sách mô hình
            header('Location: /manga_shop/models');
            exit();
        }
    }
}
?>
