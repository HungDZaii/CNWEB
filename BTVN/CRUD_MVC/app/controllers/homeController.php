<?php

require_once __DIR__ . '/../services/imageService.php';

class HomeController{
    private ImageService $imgService;

    public function __construct()
    {
        $this->imgService = new ImageService();
    }

    // Hiển thị tất cả ảnh
    public function index() {
        $images = $this->imgService->getAllImg();
        require_once __DIR__ . '/../views/home.php';
    }

    // Thêm ảnh
    public function add() {

        require_once __DIR__ . '/../views/add.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
        
            // var_dump($file);
        
                $fileName = $_FILES['fileToUpload']['name'];
                $fileType = $_FILES['fileToUpload']['type'];
                $fileTmpName = $_FILES['fileToUpload']['tmp_name'];
                $fileError = $_FILES['fileToUpload']['error'];
                $fileSize = $_FILES['fileToUpload']['size'];
        
                // cắt đuôi file
                $fileExt = explode('.', $fileName);
                $fileActuaExt = strtolower(end($fileExt));
        
                //echo $fileActuaExt;
        
                $listImgExt = array('jpg', 'jpeg', 'png', 'pdf', 'gif');
        
                if (in_array($fileActuaExt, $listImgExt)) {
                    if ($fileError === 0) {
                        if ($fileSize < 5000000) {
                            $fileNameNew = uniqid('', true) . "." . $fileActuaExt;
                            $fileDestination = './assets/images/' . $fileNameNew;
                            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                                echo "File đã được tải lên: $fileDestination";
                            } else {
                                echo "Lỗi khi lưu file.";
                            }
                        } else {
                            echo "loi";
                        }
                    } else {
                        echo "loi";
                    }
                } else {
                    echo "loi";
                }
                $this->imgService->addImg(new ImageModel($name , $description , $fileDestination));
                header('Location: /BTVN/CRUD_MVC/public/');
                exit();
            }
    }

    // Sửa ảnh
    public function edit() {
        require_once __DIR__ . '/../views/edit.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $editIndex = $_POST['edit_index'] ?? null; // Lấy chỉ số cần sửa nếu có
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
        
            if ($editIndex !== null) {
                $editIndex = (int) $editIndex;
                $old_image = $_POST['old_image']; // Đường dẫn ảnh cũ
        
                $image = $old_image; // Mặc định giữ lại ảnh cũ nếu không tải ảnh mới

                $fileName = $_FILES['fileToUpload']['name'];
                $fileType = $_FILES['fileToUpload']['type'];
                $fileTmpName = $_FILES['fileToUpload']['tmp_name'];
                $fileError = $_FILES['fileToUpload']['error'];
                $fileSize = $_FILES['fileToUpload']['size'];
        
                // cắt đuôi file
                $fileExt = explode('.', $fileName);
                $fileActuaExt = strtolower(end($fileExt));
        
                //echo $fileActuaExt;
        
                $listImgExt = array('jpg', 'jpeg', 'png', 'pdf', 'gif');
        
                if (in_array($fileActuaExt, $listImgExt)) {
                    if ($fileError === 0) {
                        if ($fileSize < 5000000) {
                            $fileNameNew = uniqid('', true) . "." . $fileActuaExt;
                            $fileDestination = './assets/images/' . $fileNameNew;
                            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                                echo "File đã được tải lên: $fileDestination";
                                $image = $fileDestination;

                                // Xóa ảnh cũ nếu ảnh mới tải lên thành công
                            if (file_exists($old_image)) {
                                unlink($old_image);
                            }
                            } else {
                                echo "Lỗi khi lưu file.";
                            }
                        } else {
                            echo "loi";
                        }
                    } else {
                        echo "loi";
                    }
                } else {
                    echo "loi";
                }
                $this->imgService->EditImg(new ImageModel($name , $description , $image) ,$editIndex);
                header('Location:/BTVN/CRUD_MVC/public/');
                exit();
            }
        }
    }

    // Xoá ảnh
    public function delete() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $deleteIndex = $_POST['delete_index'] ?? null; // Lấy chỉ số cần xóa nếu có
        
            if ($deleteIndex !== null && is_numeric($deleteIndex)) {
                // Xóa phần tử khỏi danh sách
                $this->imgService->RemoveImg($deleteIndex);
                }
                header('Location: /BTVN/CRUD_MVC/public/');
            exit();
        }
    }
}
