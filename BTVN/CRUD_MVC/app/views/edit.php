<?php
// Lấy dữ liệu từ URL (GET request)
$index = $_GET['index'] ?? '';
$name = $_GET['name'] ?? '';
$description = $_GET['description'] ?? '';
$image = $_GET['image'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Form Example</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.5.2-web/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .bcontent {
            margin-top: 60px;
        }

        .flower-image {
        height: 60px;
        /* Hoặc chiều cao bạn muốn */
        width: auto;
        /* Để ảnh tự động điều chỉnh theo tỷ lệ */
        object-fit: cover;
    }
    </style>
</head>
<body>
    <div class="container-fluid bcontent">
        <h2 class="text-center mb-4">SỬA</h2>
        <hr />
        <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="editIndex" name="edit_index" value="<?= htmlspecialchars($index) ?>">
            <div class="form-group">
                <label for="txtTen">Tên</label>
                <input type="text" class="form-control" id="txtTen" name="name" value="<?= htmlspecialchars($name) ?>" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1" class="form-label">Mô tả</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" required><?= htmlspecialchars($description) ?></textarea>
            </div>
            <div class="form-group">
                <label for="formFile" class="form-label">Chọn ảnh mới (nếu cần)</label>
                <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <input type="text" name="old_image" value="<?= htmlspecialchars($image) ?>"> <!-- Lưu ảnh cũ để xử lý khi không thay đổi ảnh -->
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.3/jquery.validate.min.js"></script>

</body>
</html>