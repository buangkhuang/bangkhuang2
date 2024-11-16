<?php

namespace App\Utils;

use Cloudinary\Cloudinary;

class CloudinaryUploader {

    private $cloudinary;

    public function __construct() {
        $config = include __DIR__ . '/../config/cloudinary.php';
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => $config['cloud_name'],
                'api_key' => $config['api_key'],
                'api_secret' => $config['api_secret']
            ],
            'url' => [
                'secure' => $config['secure']
            ]
        ]);
    }

    public function uploadImage($localFilePath, $fileName) {
        $response = $this->cloudinary->uploadApi()->upload($localFilePath, [
            'public_id' => $fileName,
            'folder' => 'manga shop' // Tên thư mục trong Cloudinary
        ]);

        return $response['secure_url']; // Trả về URL HTTPS của hình ảnh
    }
}
?>
