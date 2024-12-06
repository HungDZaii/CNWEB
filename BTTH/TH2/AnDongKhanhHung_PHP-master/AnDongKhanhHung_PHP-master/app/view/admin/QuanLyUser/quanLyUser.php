<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Người Dùng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
            padding: 30px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
            color: #212529;
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        .form-footer a {
            text-decoration: none;
            color: #007bff;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .table td,
        .table th {
            text-align: center;
            vertical-align: middle;
        }

        .btn-edit {
            background-color: #28a745;
            color: white;
            border: none;
        }

        .btn-edit:hover {
            background-color: #218838;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .btn-add {
            margin-bottom: 20px;
        }

        /* <> */

        /* Nút Sửa */
        .btn-edit {
            background-color: #28a745;
            /* Màu xanh lá */
            color: white;
            /* Chữ màu trắng */
            border: none;
            /* Không viền */
            padding: 5px 10px;
            /* Khoảng cách bên trong */
            border-radius: 5px;
            /* Bo góc */
            cursor: pointer;
            /* Con trỏ chuột khi hover */
            transition: background-color 0.3s ease;
            /* Hiệu ứng chuyển đổi màu */
        }

        .btn-edit:hover {
            background-color: #218838;
            /* Màu xanh đậm hơn khi hover */
        }

        /* Nút Xóa */
        .btn-delete {
            background-color: #dc3545;
            /* Màu đỏ */
            color: white;
            /* Chữ màu trắng */
            border: none;
            /* Không viền */
            padding: 5px 10px;
            /* Khoảng cách bên trong */
            border-radius: 5px;
            /* Bo góc */
            cursor: pointer;
            /* Con trỏ chuột khi hover */
            transition: background-color 0.3s ease;
            /* Hiệu ứng chuyển đổi màu */
        }

        .btn-delete:hover {
            background-color: #c82333;
            /* Màu đỏ đậm hơn khi hover */
        }

        /* Hiển thị biểu tượng sửa và xóa */
        .fa-pen-to-square,
        .fa-trash {
            margin-right: 5px;
            /* Khoảng cách giữa biểu tượng và chữ */
        }

        /* Căn chỉnh nút */
        .table td .btn-edit,
        .table td .btn-delete {
            margin: 0 5px;
            /* Khoảng cách giữa các nút */
        }
    

    </style>
</head>

<body>

    <div class="container">
        <h2 class="form-title">Quản Lý Người Dùng</h2>

        <!-- Nút thêm người dùng -->
        <a href="index.php?action=addUser" class="btn btn-success btn-add">Thêm Người Dùng</a>

        <!-- Danh sách người dùng -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php

            foreach ($listUser as $index => $value):
            ?>
                <tr data-index="<?= $value['id'] ?>">
                    <td><?= htmlspecialchars($value['username']) ?></td>
                    <td><?= htmlspecialchars($value['password']) ?></td>
                    <td>
                        <!-- Nút Sửa -->
                        <a href="index.php?action=editUser&id=<?= $value['id'] ?>&name=<?= urlencode($value['username']) ?>&password=<?= urlencode($value['password']) ?>" class="btn btn-edit">
                            <i class="fa-solid fa-pen-to-square"></i> Sửa
                        </a>

                        <!-- Nút Xóa -->
                        <form action="index.php?action=removeUser" method="POST" style="display: inline-block;">
                            <input type="hidden" name="id" value="<?= $value['id'] ?>">
                            <button type="submit" class="btn btn-delete">
                                <i class="fa-solid fa-trash"></i> Xóa
                            </button>
                        </form>
                    </td>

                </tr>
            <?php endforeach; ?>
        </table>
        <a href="index.php?action=getAdminHome" class="btn btn-danger">Quay Lại</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>