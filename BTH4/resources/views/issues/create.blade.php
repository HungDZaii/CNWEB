<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Tin Tức</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
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

        .form-group label {
            font-weight: bold;
            color: #495057;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
<div class="container mt-5">
        <h2 class="text-center mb-4">Thêm Vấn đề mới</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('issues.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="computer_id">Máy Tính</label>
                <select name="computer_id" id="computer_id" class="form-control" required>
                    <option value="">-- Chọn máy tính --</option>
                    @foreach ($computers as $computer)
                        <option value="{{ $computer->id }}">{{ $computer->computer_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="reported_by">Người Báo Cáo</label>
                <input type="text" name="reported_by" id="reported_by" class="form-control" placeholder="Nhập tên người báo cáo (nếu có)" value="{{ old('reported_by') }}">
            </div>

            <div class="form-group mb-3">
                <label for="reported_date">Ngày Báo Cáo</label>
                <input type="datetime-local" name="reported_date" id="reported_date" class="form-control" value="{{ old('reported_date') }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="description">Mô Tả Vấn Đề</label>
                <textarea name="description" id="description" class="form-control" placeholder="Nhập mô tả vấn đề" rows="5" required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="urgency">Mức Độ Khẩn Cấp</label>
                <select name="urgency" id="urgency" class="form-control" required>
                    <option value="">-- Chọn mức độ khẩn cấp --</option>
                    <option value="Low" {{ old('urgency') == 'Low' ? 'selected' : '' }}>Thấp</option>
                    <option value="Medium" {{ old('urgency') == 'Medium' ? 'selected' : '' }}>Trung Bình</option>
                    <option value="High" {{ old('urgency') == 'High' ? 'selected' : '' }}>Cao</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="status">Trạng Thái</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Open" {{ old('status') == 'Open' ? 'selected' : '' }}>Mở</option>
                    <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>Đang Xử Lý</option>
                    <option value="Resolved" {{ old('status') == 'Resolved' ? 'selected' : '' }}>Đã Giải Quyết</option>
                </select>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success">Lưu</button>
                <a href="{{ route('issues.index') }}" class="btn btn-secondary ms-2">Quay lại</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>