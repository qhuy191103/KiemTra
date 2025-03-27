<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhân sự</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <nav class="pastel-nav">
        <div class="pastel-nav-container">
            <div class="flex items-center">
                <a href="index.php?controller=nhanvien&action=index" class="pastel-nav-brand">
                    <i class="fas fa-users mr-2"></i>
                    Quản lý nhân sự
                </a>
                <div class="hidden md:flex ml-8">
                    <a href="index.php?controller=nhanvien&action=index" 
                       class="pastel-btn pastel-btn-primary">
                        Danh sách nhân viên
                    </a>
                </div>
            </div>

            <?php if (isset($_SESSION['username'])): ?>
            <div class="pastel-nav-menu">
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-700 hidden md:inline-flex items-center">
                        <i class="fas fa-user mr-2"></i>
                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                        <span class="pastel-badge <?php echo $_SESSION['role'] === 'admin' ? 'pastel-badge-purple' : 'pastel-badge-blue'; ?> ml-2">
                            <?php echo $_SESSION['role'] === 'admin' ? 'Admin' : 'User'; ?>
                        </span>
                    </span>
                    <a href="index.php?controller=user&action=logout" 
                       class="pastel-btn pastel-btn-danger">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="hidden md:inline">Đăng xuất</span>
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </nav>

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