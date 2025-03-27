<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin nhân viên</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f3f4f6;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }
        .form-control {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            background-color: #fff;
        }
        .form-control:focus {
            outline: none;
            border-color: #93c5fd;
            box-shadow: 0 0 0 3px rgba(147, 197, 253, 0.25);
        }
        .form-select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            background-color: #fff;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-primary {
            background-color: #2563eb;
            color: white;
            border: none;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
        }
        .btn-secondary {
            background-color: #6b7280;
            color: white;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #4b5563;
        }
    </style>
</head>
<body>
    <?php require_once 'app/views/shares/header.php'; ?>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-800">
                    <i class="fas fa-user-edit mr-2"></i>
                    Sửa thông tin nhân viên
                </h2>
                <a href="index.php?controller=nhanvien&action=index" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Quay lại
                </a>
            </div>

            <?php if (isset($error)): ?>
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700"><?php echo $error; ?></p>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <form method="POST" action="index.php?controller=nhanvien&action=edit&ma_nv=<?php echo htmlspecialchars($nhanvien['ma_nv']); ?>">
                <div class="form-group">
                    <label class="form-label">Mã nhân viên</label>
                    <input type="text" class="form-control bg-gray-100" value="<?php echo htmlspecialchars($nhanvien['ma_nv']); ?>" readonly>
                </div>

                <div class="form-group">
                    <label class="form-label">Tên nhân viên</label>
                    <input type="text" name="ten_nv" class="form-control" value="<?php echo htmlspecialchars($nhanvien['ten_nv']); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Giới tính</label>
                    <select name="gioi_tinh" class="form-select" required>
                        <option value="Nam" <?php echo $nhanvien['gioi_tinh'] === 'Nam' ? 'selected' : ''; ?>>Nam</option>
                        <option value="Nữ" <?php echo $nhanvien['gioi_tinh'] === 'Nữ' ? 'selected' : ''; ?>>Nữ</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Nơi sinh</label>
                    <input type="text" name="noi_sinh" class="form-control" value="<?php echo htmlspecialchars($nhanvien['noi_sinh']); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Phòng ban</label>
                    <select name="ma_phong" class="form-select" required>
                        <?php foreach ($phongban as $pb): ?>
                        <option value="<?php echo htmlspecialchars($pb['ma_phong']); ?>" 
                                <?php echo $pb['ma_phong'] === $nhanvien['ma_phong'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($pb['ten_phong']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Lương</label>
                    <input type="text" name="luong" class="form-control" value="<?php echo htmlspecialchars($nhanvien['luong']); ?>" required>
                </div>

                <div class="flex justify-end gap-4 mt-6">
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-undo"></i>
                        Làm lại
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Format số tiền khi nhập
        document.querySelector('input[name="luong"]').addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, '');
            if (value === '') return;
            this.value = new Intl.NumberFormat('vi-VN').format(value);
        });
    </script>
</body>
</html> 