<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e66465, #9198e5);
        }

        .bg-gradient {
            background: linear-gradient(to bottom right, #d16ba5, #86a8e7, #5ffbf1);
        }

        .card {
            border: none;
            border-radius: 15px;
        }

        .rounded-circle {
            width: 80px;
            height: 80px;
        }

        a.text-decoration-none {
            color: #007bff;
        }

        a.text-decoration-none:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .alert-danger {
            font-weight: bold;
            font-size: 14px;
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100 bg-gradient">
        <div class="card shadow p-4" style="width: 350px;">
            <h4 class="text-center mb-3">Đăng Ký</h4>

            <!-- Hiển thị thông báo lỗi -->
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger text-center" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="index.php?action=getDangKy" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="email" name="name" placeholder="Name">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="text" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Xác nhận mật khẩu</label>
                    <input type="text" class="form-control" id="confirm-password" name="confirm_password" placeholder="Confirm password">
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng Ký</button>
            </form>
            <p class="text-center mt-4">Đã có tài khoản? <a href="index.php?action=getDangNhap" class="text-decoration-none">Đăng Nhập</a></p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>