<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm nhân viên mới</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <style>
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: #4a5568;
            font-weight: 500;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid var(--pastel-gray);
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            outline: none;
        }
        .form-input:focus {
            border-color: var(--pastel-primary);
            box-shadow: 0 0 0 3px rgba(168, 213, 229, 0.3);
        }
        .form-select {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid var(--pastel-gray);
            border-radius: 0.5rem;
            background-color: white;
            cursor: pointer;
        }
        .form-select:focus {
            border-color: var(--pastel-primary);
            box-shadow: 0 0 0 3px rgba(168, 213, 229, 0.3);
        }
        .radio-group {
            display: flex;
            gap: 1.5rem;
            padding: 0.5rem 0;
        }
        .radio-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-gray-50">
    <?php require_once 'app/views/shares/header.php'; ?>
    
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="pastel-card p-8">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800">
                        <i class="fas fa-user-plus text-green-600 mr-2"></i>
                        Thêm nhân viên mới
                    </h2>
                    <a href="index.php?controller=nhanvien&action=index" 
                       class="pastel-btn pastel-btn-primary">
                        <i class="fas fa-arrow-left"></i>
                        <span>Quay lại</span>
                    </a>
                </div>

                <?php if (isset($error)): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p class="font-medium">Lỗi!</p>
                    <p><?php echo $error; ?></p>
                </div>
                <?php endif; ?>

                <form method="POST" action="index.php?controller=nhanvien&action=add" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label class="form-label" for="ma_nv">
                                <i class="fas fa-id-card text-blue-600 mr-2"></i>
                                Mã nhân viên
                            </label>
                            <input type="text" id="ma_nv" name="ma_nv" required
                                   class="form-input" placeholder="Ví dụ: NV001">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="ten_nv">
                                <i class="fas fa-user text-green-600 mr-2"></i>
                                Tên nhân viên
                            </label>
                            <input type="text" id="ten_nv" name="ten_nv" required
                                   class="form-input" placeholder="Nhập họ và tên">
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-venus-mars text-purple-600 mr-2"></i>
                                Giới tính
                            </label>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="gioi_tinh" value="Nam" required>
                                    <i class="fas fa-mars text-blue-500"></i>
                                    Nam
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="gioi_tinh" value="Nữ" required>
                                    <i class="fas fa-venus text-pink-500"></i>
                                    Nữ
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="noi_sinh">
                                <i class="fas fa-map-marker-alt text-red-600 mr-2"></i>
                                Nơi sinh
                            </label>
                            <input type="text" id="noi_sinh" name="noi_sinh" required
                                   class="form-input" placeholder="Nhập nơi sinh">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="ma_phong">
                                <i class="fas fa-building text-yellow-600 mr-2"></i>
                                Phòng ban
                            </label>
                            <select id="ma_phong" name="ma_phong" required class="form-select">
                                <option value="">Chọn phòng ban</option>
                                <?php foreach ($phongban as $pb): ?>
                                <option value="<?php echo htmlspecialchars($pb['ma_phong']); ?>">
                                    <?php echo htmlspecialchars($pb['ten_phong']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="luong">
                                <i class="fas fa-money-bill-wave text-green-600 mr-2"></i>
                                Lương
                            </label>
                            <input type="text" id="luong" name="luong" required
                                   class="form-input" placeholder="Nhập mức lương">
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 mt-8">
                        <button type="reset" class="pastel-btn pastel-btn-danger">
                            <i class="fas fa-undo"></i>
                            <span>Làm lại</span>
                        </button>
                        <button type="submit" class="pastel-btn pastel-btn-success">
                            <i class="fas fa-save"></i>
                            <span>Lưu nhân viên</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Thêm định dạng số tiền khi nhập lương
        document.getElementById('luong').addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, '');
            if (value === '') return;
            this.value = new Intl.NumberFormat('vi-VN').format(value);
        });

        // Validate mã nhân viên
        document.getElementById('ma_nv').addEventListener('input', function(e) {
            this.value = this.value.toUpperCase();
        });
    </script>
</body>
</html> 