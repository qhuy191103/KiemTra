<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhân sự</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #fff;
        }
        .header {
            padding: 0.5rem 1rem;
            border-bottom: 1px solid #e5e7eb;
            background: white;
        }
        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            color: #111827;
        }
        .brand i {
            font-size: 1.25rem;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .user-name {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            color: #374151;
            font-size: 0.875rem;
        }
        .badge-admin {
            background-color: #e0e7ff;
            color: #4338ca;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
        }
        .badge-user {
            background-color: #f3f4f6;
            color: #374151;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
        }
        .btn-logout {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            background-color: #fee2e2;
            color: #b91c1c;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            text-decoration: none;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <a href="index.php?controller=nhanvien&action=index" class="brand">
                <i class="fas fa-users"></i>
                Quản lý nhân sự
            </a>

            <?php if (isset($_SESSION['username'])): ?>
            <div class="user-info">
                <div class="user-name">
                    <i class="fas fa-user"></i>
                    <?php echo htmlspecialchars($_SESSION['username']); ?>
                </div>
                <div class="<?php echo $_SESSION['role'] === 'admin' ? 'badge-admin' : 'badge-user'; ?>">
                    <?php echo ucfirst($_SESSION['role']); ?>
                </div>
                <a href="index.php?controller=user&action=logout" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i>
                    Đăng xuất
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Mobile Menu -->
    <?php if (isset($_SESSION['username'])): ?>
    <div class="md:hidden bg-white border-t border-gray-200 p-4">
        <div class="flex flex-col items-center gap-2">
            <span class="text-sm text-gray-700 flex items-center">
                <i class="fas fa-user mr-2"></i>
                <?php echo htmlspecialchars($_SESSION['username']); ?>
                <span class="pastel-badge <?php echo $_SESSION['role'] === 'admin' ? 'pastel-badge-purple' : 'pastel-badge-blue'; ?> ml-2">
                    <?php echo $_SESSION['role'] === 'admin' ? 'Admin' : 'User'; ?>
                </span>
            </span>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>