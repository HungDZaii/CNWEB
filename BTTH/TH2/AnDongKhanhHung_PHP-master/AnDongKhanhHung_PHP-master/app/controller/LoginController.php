<?php
require_once __DIR__ . '/../model/DataUser.php';
class LoginController
{
    private $DataUserModel;

    public function __construct(DataUser $dataUser)
    {
        $this->DataUserModel = $dataUser;
    }

    public function DangNhap()
    {

        session_start();

        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['role'] === 1) {
                header("Location: index.php?action=getAdminHome");
                exit();
            }
            elseif ($_SESSION['user']['role'] === 0) {
                header("Location: index.php?action=getDanhSachTinTuc");
                exit();
            }
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $password = $_POST['password'];

            $user = $this->DataUserModel->getUserNamePass($name, $password);

            if ($user) {
                // Kiểm tra vai trò của người dùng
                $_SESSION['user'] = [
                    'username' => $user['username'],
                    'role' => $user['role']
                ];

                if ($user['role'] == 1) {
                    echo "<div class='alert alert-success'>Đăng nhập thành công! Bạn là Admin.</div>";
                    // Chuyển hướng đến trang admin
                    header("Location: index.php?action=getAdminHome");
                    exit();
                } else if ($user['role'] == 0) {
                    echo "<div class='alert alert-success'>Đăng nhập thành công! Bạn là User.</div>";
                    // Chuyển hướng đến trang user
                    header("Location: index.php?action=getDanhSachTinTuc");
                    exit();
                }
            } else {
                // Thông báo lỗi nếu thông tin không chính xác
                $error = "Tên đăng nhập hoặc mật khẩu không chính xác!";
                echo "<div class='alert alert-danger'>$error</div>";
            }
        }

        require_once __DIR__ . '/../view/auth/dangNhapForm.php';
    }



    public function DangKy()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($password !== $confirmPassword) {
                $error = "Mật khẩu và xác nhận mật khẩu không khớp!";
            } else {
                // Thêm người dùng vào cơ sở dữ liệu
                $this->DataUserModel->addUser(new User($name, $password, 0));
                header("Location: index.php?action=getDangNhap");
                exit();
            }
        }

        require_once __DIR__ . '/../view/auth/dangKyForm.php';
    }

    public function DangXuat()
    {
        require_once __DIR__ . '/../view/auth/dangXuat.php';
    }
}
