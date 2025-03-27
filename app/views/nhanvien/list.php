<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #fff;
        }
        .header {
            border-bottom: 1px solid #e5e7eb;
            background: white;
            padding: 1rem;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .header-container {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.25rem;
            color: #1f2937;
            text-decoration: none;
        }
        .nav-link {
            background-color: #e5e7eb;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            color: #1f2937;
            text-decoration: none;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
        }
        .badge-admin {
            background-color: #e0e7ff;
            color: #4338ca;
        }
        .badge-user {
            background-color: #f3f4f6;
            color: #374151;
        }
        .btn-logout {
            background-color: #fee2e2;
            color: #b91c1c;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            text-decoration: none;
        }
        .content {
            max-width: 1280px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            position: sticky;
            top: 4rem;
            background: white;
            z-index: 9;
            padding: 1rem 0;
        }
        .content-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #1f2937;
        }
        .btn-add {
            background-color: #d1fae5;
            color: #065f46;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
        }
        .table-container {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: auto;
            max-width: 100%;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1000px; /* Đảm bảo bảng có chiều rộng tối thiểu */
        }
        .table th {
            background-color: #f3f4f6;
            padding: 0.75rem 1rem;
            text-align: left;
            font-weight: 500;
            color: #4b5563;
            border-bottom: 1px solid #e5e7eb;
            white-space: nowrap;
            position: sticky;
            top: 0;
            z-index: 8;
        }
        .table td {
            padding: 0.75rem 1rem;
            color: #1f2937;
            border-bottom: 1px solid #e5e7eb;
            white-space: nowrap;
        }
        .table tr:hover {
            background-color: #f9fafb;
        }
        .badge-id {
            background-color: #e0e7ff;
            color: #4338ca;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            white-space: nowrap;
        }
        .badge-department {
            background-color: #f3e8ff;
            color: #6b21a8;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            white-space: nowrap;
        }
        .btn-action {
            padding: 0.375rem;
            border-radius: 0.375rem;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
        }
        .btn-edit {
            background-color: #93c5fd;
        }
        .btn-delete {
            background-color: #fca5a5;
        }
        .gender-icon {
            margin-right: 0.5rem;
        }
        .gender-icon.male {
            color: #3b82f6;
        }
        .gender-icon.female {
            color: #ec4899;
        }

        /* Tùy chỉnh thanh cuộn */
        .table-container::-webkit-scrollbar {
            height: 8px;
        }
        .table-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        .table-container::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }
        .table-container::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }

        /* Đảm bảo các cột có chiều rộng phù hợp */
        .table th:nth-child(1), 
        .table td:nth-child(1) { min-width: 100px; }
        .table th:nth-child(2), 
        .table td:nth-child(2) { min-width: 200px; }
        .table th:nth-child(3), 
        .table td:nth-child(3) { min-width: 100px; }
        .table th:nth-child(4), 
        .table td:nth-child(4) { min-width: 150px; }
        .table th:nth-child(5), 
        .table td:nth-child(5) { min-width: 150px; }
        .table th:nth-child(6), 
        .table td:nth-child(6) { min-width: 120px; }
        .table th:nth-child(7), 
        .table td:nth-child(7) { min-width: 100px; }
    </style>
</head>
<body>
    <?php require_once 'app/views/shares/header.php'; ?>
    
    <div class="content">
        <div class="content-header">
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a href="index.php?controller=nhanvien&action=add" class="btn-add">
                <i class="fas fa-user-plus"></i>
                Thêm nhân viên
            </a>
            <?php endif; ?>
        </div>

        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>MÃ NV</th>
                        <th>TÊN NHÂN VIÊN</th>
                        <th>GIỚI TÍNH</th>
                        <th>NƠI SINH</th>
                        <th>PHÒNG BAN</th>
                        <th>LƯƠNG</th>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <th>THAO TÁC</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($nhanviens as $nv): ?>
                    <tr>
                        <td>
                            <span class="badge-id"><?php echo htmlspecialchars($nv['ma_nv']); ?></span>
                        </td>
                        <td>
                            <div style="display: flex; align-items: center;">
                                <?php if ($nv['gioi_tinh'] === 'Nam'): ?>
                                    <i class="fas fa-mars gender-icon male"></i>
                                <?php else: ?>
                                    <i class="fas fa-venus gender-icon female"></i>
                                <?php endif; ?>
                                <?php echo htmlspecialchars($nv['ten_nv']); ?>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($nv['gioi_tinh']); ?></td>
                        <td><?php echo htmlspecialchars($nv['noi_sinh']); ?></td>
                        <td>
                            <span class="badge-department"><?php echo htmlspecialchars($nv['ten_phong']); ?></span>
                        </td>
                        <td><?php echo number_format($nv['luong'], 0, ',', '.'); ?></td>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <td>
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="index.php?controller=nhanvien&action=edit&ma_nv=<?php echo $nv['ma_nv']; ?>" 
                                   class="btn-action btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="index.php?controller=nhanvien&action=delete&ma_nv=<?php echo $nv['ma_nv']; ?>" 
                                   class="btn-action btn-delete"
                                   onclick="return confirm('Bạn có chắc chắn muốn xóa nhân viên này?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Phân trang -->
            <?php if ($totalPages > 1): ?>
            <div class="mt-4 flex justify-center">
                <nav class="flex items-center gap-1">
                    <?php if ($page > 1): ?>
                        <a href="?controller=nhanvien&action=index&page=<?php echo ($page - 1); ?>" 
                           class="px-3 py-1 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?controller=nhanvien&action=index&page=<?php echo $i; ?>" 
                           class="px-3 py-1 <?php echo $i === $page ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-700'; ?> rounded-md hover:bg-blue-600 hover:text-white">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <a href="?controller=nhanvien&action=index&page=<?php echo ($page + 1); ?>" 
                           class="px-3 py-1 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    <?php endif; ?>
                </nav>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html> 