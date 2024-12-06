<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Quản lý</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 50px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2.5rem;
            color: #495057;
            margin-bottom: 30px;
            text-align: center;
        }

        .btn-container {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
        }

        .btn-container .btn {
            width: 200px;
            font-size: 1.2rem;
        }

        .table {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .btn-edit {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-edit:hover {
            background-color: #218838;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Admin</h1>

        <!-- Các nút chức năng -->
        <div class="btn-container">
            <a href="index.php?action=getAllTinTuc" class="btn btn-primary" onclick="showNewsList()">Xem danh sách tin tức</a>
            <a href="index.php?action=getAllUser" class="btn btn-warning" onclick="showUserList()">Xem danh sách người dùng</a>
            <a href="index.php?action=getDangXuat" class="btn btn-danger">Đăng xuất</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>