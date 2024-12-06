<?php
require_once __DIR__ . '/../model/DataUser.php';

class UserController
{
    private $DataUserModel;

    public function __construct(DataUser $dataUser)
    {
        $this->DataUserModel = $dataUser;
    }

    // lấy dữ liệu từ DataUser đổ ra view admin QuanLyUser
    public function getAllUserController()
    {
        $listUser = $this->DataUserModel->getAllUsers();
        require_once __DIR__ . '/../view/admin/QuanLyUser/quanLyUser.php';
    }


    // lấy dữ liệu từ form addUserForm thêm vào csdl
    public function addUserController()
    {
        require_once __DIR__ . '/../view/admin/QuanLyUser/addUserForm.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $password = $_POST['password'];
            echo $name;
            // Kiểm tra xem user có tồn tại chưa (optional)
            $existingUser = $this->DataUserModel->getUserByName($name);
            if ($existingUser) {
                $error = "Người dùng đã tồn tại!";
                echo $error;
                require_once __DIR__ . '/../view/admin/QuanLyUser/addUserForm.php';
                return;
            }

            // Thêm người dùng vào cơ sở dữ liệu
            $this->DataUserModel->addUser(new User($name, $password, 0));
            $success = "Thêm người dùng thành công!";
            echo $success;
            header("Location: index.php?action=getAllUser");
            exit();
        }
    }


    // lấy dữ liệu từ form editUserForm sửa trong csdl
    public function editUserController()
    {
        require_once __DIR__ . '/../view/admin/QuanLyUser/editUserForm.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $password = $_POST['password'];
            // Kiểm tra xem user có tồn tại chưa (optional)
            $existingUser = $this->DataUserModel->getUserByName($name);
            if ($existingUser) {
                $error = "Người dùng đã tồn tại!";
                echo $error;
                require_once __DIR__ . '/../view/admin/QuanLyUser/addUserForm.php';
                return;
            }
            // Thêm người dùng vào cơ sở dữ liệu
            $this->DataUserModel->updateUser(new User($name, $password, 0) , $id);
            $success = "Thêm người dùng thành công!";
            echo $success;
            header("Location: index.php?action=getAllUser");
            exit();
        }
    }

    // lấy dữ liệu từ form removeUserForm xóa trong csdl
    public function removeUserController()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null; // Lấy chỉ số cần xóa nếu có
            if ($id !== null && is_numeric($id)) {
                // Xóa phần tử khỏi danh sách
                $this->DataUserModel->deleteUser($id);
                }
                header('Location: index.php?action=getAllUser');
            exit();
        }
    }
}
