<?php
require_once __DIR__ . '/../app/controller/LoginController.php';

//Tin tức
require_once __DIR__ . '/../app/model/dbConnect.php';
require_once __DIR__ . '/../app/model/DataTinTuc.php';
require_once __DIR__ . '/../app/model/DataCaTegory.php';
require_once __DIR__ . '/../app/controller/TinTucController.php';

//User
require_once __DIR__ . '/../app/model/dbConnect.php';
require_once __DIR__ . '/../app/model/DataUser.php';
require_once __DIR__ . '/../app/controller/UserController.php';
require_once __DIR__ . '/../app/controller/adminController.php';

//Chung
$data = new Database();

$dataNews = new DataNews($data);
$dataCategory = new DataCaTefory($data);
$tintucController = new TinTucController($dataNews, $dataCategory);

//User
$DataUserModel = new DataUser($data);
$login = new LoginController($DataUserModel);
$UserController = new UserController($DataUserModel);
$AdminController = new AdminController();

//Chung
$action = $_GET['action'] ?? 'login';


switch ($action) {
    case 'getDangNhap':
        //Trang dang nhap
        $login->DangNhap();
        break;
    case 'getDangXuat':
        $login->DangXuat();
        break;
    case 'getDangKy':
        $login->DangKy();
        break;
    case 'getAllTinTuc':
        $tintucController->getQuanlyTinTuc();
        break;
    case 'AddTinTuc':
        $tintucController->addTinTuc();
        break;
    case 'editTinTuc':
        $tintucController->editTinTuc();
        break;
    case 'removeTinTuc':
        $tintucController->deleteTinTuc();
        break;
    case 'getAllUser':
        $UserController->getAllUserController();
        break;
    case 'addUser':
        $UserController->addUserController();
        break;
    case 'editUser':
        $UserController->editUserController();
        break;
    case 'removeUser':
        $UserController->removeUserController();
        break;

    case 'getAdminHome':
        $AdminController->getAdminHome();
        break;

    case 'getDanhSachTinTuc':
        $tintucController->getDanhSachTinTuc();
        break;
    case 'getChiTietTinTuc':
        $tintucController->getChiTietTinTuc();
        break;
    default:
        //Trang dang nhap
        $login->DangNhap();
        break;
}
