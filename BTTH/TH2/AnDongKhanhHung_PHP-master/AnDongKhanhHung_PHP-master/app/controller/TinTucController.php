<?php
require_once __DIR__ . '/../model/DataTinTuc.php';
require_once __DIR__ . '/../model/DataCaTegory.php';
class TinTucController
{

    // lấy dữ liệu từ DataNews đổ ra view admin QuanLyTintuc
    // lấy dữ liệu từ form addtintucForm thêm vào csdl
    // lấy dữ liệu từ form edittintucForm sửa trong csdl
    // lấy dữ liệu từ form removetintucForm xóa trong csdl

    // Khánh
    // lấy dữ liệu từ Datatintuc đổ ra view user danhSachtintuc
    private $dataNews;
    private $dataCategory;
    public function __construct(DataNews $dataNews, DataCaTefory $dataCaTefory)
    {
        $this->dataNews = $dataNews;
        $this->dataCategory = $dataCaTefory;
    }
    //lay danh sach tin tucs cho view quan ly tin tuc
    public function getQuanlyTinTuc()
    {
        $newList = $this->dataNews->getAllNews();
        require __DIR__ . '/../view/admin/QuanLyTinTuc/quanLyTinTuc.php';
    }
    
    //them tin tuc tu form theem tin tuc
    public function addTinTuc()
    {
        require_once __DIR__ . '/../view/admin/QuanLyTinTuc/addTinTucForm.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['news_name'] ?? '');
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');


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
            $this->dataCategory->addCategory($name);
            $this->dataNews->addNews($name, $title, $content, $fileDestination);
            header("Location: index.php?action=getAllTinTuc");
            exit();
        }
    }

    public function editTinTuc()
    {
        require_once __DIR__ . '/../view/admin/QuanLyTinTuc/editTinTucForm.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $editIndex = $_POST['edit_index'] ?? null; // Lấy chỉ số cần sửa nếu có
            $category_id = $_POST['category_id'] ?? null; // Lấy chỉ số cần sửa nếu có
            $name = trim($_POST['news_name'] ?? '');
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');

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
                $this->dataCategory->editCategory($category_id, $name);
                $this->dataNews->editNews($editIndex, $title, $content, $image);
                header('Location: index.php?action=getAllTinTuc');
                exit();
            }
        }
    }



    // Xóa tin tức
    public function deleteTinTuc()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idNews = $_POST['idNews'] ?? null; // Lấy chỉ số cần xóa nếu có
            $idCategory = $_POST['idCategory'] ?? null;
            if ($idNews !== null && is_numeric($idNews)) {
                // Xóa phần tử khỏi danh sách
                $this->dataNews->deleteNews($idNews);
                $this->dataCategory->deleteCategory($idCategory);
            }
            header('Location: index.php?action=getAllTinTuc');
            exit();
        }
    }

    // Tìm kiếm tin tức
    public function searchTinTuc()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $keyword = $_POST['keyword'];
            $newsList = $this->dataNews->searchNews($keyword);
            require '../view/admin/QuanLyTinTuc/quanLyTinTuc.php';
        } else {
            header("Location: index.php?controller=tintuc&action=quanly");
        }
    }
    // Lấy danh sách tin tức cho người dùng
    public function getDanhSachTinTuc()
    {
        $newList = $this->dataNews->getAllNews();
        require_once __DIR__ . '/../view/user/danhSachTinTuc.php';
    }

    public function getChiTietTinTuc()
    {
        require_once __DIR__ . '/../view/user/chiTietTinTuc.php';
    }
}
