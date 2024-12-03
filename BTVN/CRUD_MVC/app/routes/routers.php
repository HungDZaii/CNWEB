<?php

require_once __DIR__ . '/../controllers/homeController.php';

class Router {
    public static function route($uri) {
        // Loại bỏ dấu '/' ở đầu và cuối URI
        $uri = trim($uri, '/');

        $controller = new HomeController();

        // Điều hướng khi URL là '/' hoặc '/home'
        if ($uri === '' || $uri === 'home') {
            $controller->index();
        } elseif ($uri === 'add') {
            // Điều hướng đến trang add
            $controller->add();
        } elseif (preg_match('/^edit/', $uri)) {
            // Điều hướng đến trang sửa với ID
            $controller->edit();
        } elseif ($uri === 'remove' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            // Điều hướng đến trang xóa
            $controller->delete();
        } else {
            // Nếu không khớp, hiển thị lỗi
            echo 'Page not found';
        }
    }
}
