<?php
include 'list.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deleteIndex = $_POST['delete_index'] ?? null; // Lấy chỉ số cần xóa nếu có
    $editIndex = $_POST['edit_index'] ?? null; // Lấy chỉ số cần sửa nếu có
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');


    // $file = $_FILES['fileToUpload'];

    // var_dump($file);


    if ($deleteIndex !== null && is_numeric($deleteIndex)) {
        // Xóa phần tử khỏi danh sách
        $deleteIndex = (int) $deleteIndex;
        if (isset($_SESSION['flowers'][$deleteIndex])) {
            unset($_SESSION['flowers'][$deleteIndex]);
            // Đặt lại chỉ số mảng để tránh lỗi key không liên tục
            $_SESSION['flowers'] = array_values($_SESSION['flowers']);
        }
    } elseif ($editIndex !== null) {
        // Thực hiện sửa thông tin
        $editIndex = (int) $editIndex;
        $old_image = $_POST['old_image']; // Ảnh cũ
        if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === 0) {

            $fileName = $_FILES['fileToUpload']['name'];
            $fileType = $_FILES['fileToUpload']['type'];
            $fileTmpName = $_FILES['fileToUpload']['tmp_name'];
            $fileError = $_FILES['fileToUpload']['error'];
            $fileSize = $_FILES['fileToUpload']['size'];

            // cắt đuôi file
            $fileExt = explode('.', $fileName);
            $fileActuaExt = strtolower(end($fileExt));

            $listImgExt = array('jpg', 'jpeg', 'png', 'pdf', 'gif');

            if (in_array($fileActuaExt, $listImgExt)) {
                if ($fileError === 0) {
                    if ($fileSize < 5000000) {
                        $fileNameNew = uniqid('', true) . "." . $fileActuaExt;
                        $fileDestination = 'image/' . $fileNameNew;
                        if (move_uploaded_file($fileTmpName, $fileDestination)) {
                            $image = $fileDestination;
                        } else {
                            $image = $old_image; // Nếu không tải được ảnh mới thì giữ ảnh cũ
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
        } else {
            $image = $old_image; // Không có ảnh mới, giữ ảnh cũ
        }

        // Cập nhật dữ liệu vào $_SESSION
        $_SESSION['flowers'][$editIndex] = [
            'name' => $name,
            'description' => $description,
            'image' => $image
        ];
    } else {
        // file img
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
                    $fileDestination = 'image/' . $fileNameNew;
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
        $_SESSION['flowers'][] = [
            'name' => $name,
            'description' => $description,
            'image' => $fileDestination
        ];
    }

    // Hủy toàn bộ session
    //session_unset(); // Xóa tất cả các biến trong session
    //session_destroy(); // Hủy session
    header('Location: view_admin.php');

    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.5.2-web/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="./assets/css/bai_5_2.css">
    <title>Form_Jquery_Validate</title>

</head>

<style>
    .table td:nth-child(2) {
        white-space: normal;
        word-wrap: break-word;
        max-width: 300px;
    }

    .flower-image {
        height: 60px;
        /* Hoặc chiều cao bạn muốn */
        width: auto;
        /* Để ảnh tự động điều chỉnh theo tỷ lệ */
        object-fit: cover;
    }
    /* Reset mặc định */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
    color: #343a40;
}

.container {
    margin-top: 20px;
    padding: 20px;
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

h1, h2, h3, h4, h5, h6 {
    font-weight: 600;
    color: #212529;
}

/* Bảng */
.table {
    width: 100%;
    margin-bottom: 20px;
    border-collapse: collapse;
    background: #ffffff;
    border: 1px solid #dee2e6; /* Thêm viền cho bảng */
    border-radius: 8px; /* Bo góc bảng */
    overflow: hidden;
}

.table thead th {
    background-color: #007bff;
    color: white;
    text-align: center;
    padding: 10px;
    border: 1px solid #dee2e6;
}

.table tbody td {
    padding: 15px;
    border: 1px solid #dee2e6;
    vertical-align: middle;
}

.table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

.table tbody tr:hover {
    background-color: #e9ecef;
    cursor: pointer;
}

/* Ảnh */
.flower-image {
    height: 80px;
    width: 80px;
    object-fit: cover;
    border-radius: 5px;
    border: 1px solid #ced4da;
}

/* Nút */
.btn {
    padding: 10px 15px;
    border-radius: 5px;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: #007bff;
    color: #ffffff;
    border: none;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.btn-danger {
    background-color: #dc3545;
    color: #ffffff;
    border: none;
}

.btn-danger:hover {
    background-color: #c82333;
}

.btn-edit {
    background-color: #ffc107; /* Màu nút sửa */
    color: #ffffff;
    border: none;
}

.btn-edit:hover {
    background-color: #e0a800;
}

/* Nút thêm */
.btn-add {
    float: right; /* Canh phải nút thêm */
    background-color: #28a745;
    color: #ffffff;
    border: none;
    margin-bottom: 15px;
}


/* Tiêu đề */
header {
    padding: 15px;
    text-align: center;
    color: white;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Footer */
footer {
    text-align: center;
    padding: 15px;
    background: #343a40;
    color: white;
    margin-top: 20px;
    border-radius: 8px;
}

footer a {
    color: #007bff;
    text-decoration: none;
}


/* Responsive */
@media (max-width: 768px) {
    .table thead th {
        font-size: 12px;
    }

    .table tbody td {
        font-size: 12px;
    }

    .btn {
        padding: 8px 10px;
        font-size: 12px;
    }
}
</style>

<body>
    <div class="container">

        <?php require 'header.php'; ?>
        <?php require 'section-one.php'; ?>


        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <?php foreach ($_SESSION['flowers'] as $index => $flower): ?>
                <tr data-index="<?= $index ?>">
                    <td><?= htmlspecialchars($flower['name']) ?></td>
                    <td><?= htmlspecialchars($flower['description']) ?></td>
                    <td><img src="<?= htmlspecialchars($flower['image']) ?>" alt="<?= htmlspecialchars($flower['name']) ?>" class="flower-image">
                    <td>
                        <a href="edit_img.php?index=<?= $index ?>&name=<?= urlencode($flower['name']) ?>&description=<?= urlencode($flower['description']) ?>&image=<?= urlencode($flower['image']) ?>" class="btn-edit">
                            <button class="btn btn-primary">Sửa</button>
                        </a>

                        <form action="" method="POST" style="display: inline-block;">
                            <input type="hidden" name="delete_index" value="<?= $index ?>">
                            <button type="submit" class="btn btn-danger btn-delete">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tbody>

            </tbody>
        </table>

    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.3/jquery.validate.min.js"></script>
</body>

</html>