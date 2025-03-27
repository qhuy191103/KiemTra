<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Sửa Thông Tin Nhân Viên</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="POST" class="card p-4 shadow-sm">
                <div class="mb-3">
                    <label class="form-label">Mã nhân viên</label>
                    <input type="text" class="form-control" value="<?php echo $nhanvien['ma_nv']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tên nhân viên</label>
                    <input type="text" class="form-control" name="ten_nv" 
                           value="<?php echo $nhanvien['ten_nv']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Giới tính</label>
                    <select class="form-select" name="gioi_tinh" required>
                        <option value="Nam" <?php if($nhanvien['gioi_tinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
                        <option value="Nữ" <?php if($nhanvien['gioi_tinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nơi sinh</label>
                    <input type="text" class="form-control" name="noi_sinh" 
                           value="<?php echo $nhanvien['noi_sinh']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phòng ban</label>
                    <select class="form-select" name="ma_phong" required>
                        <option value="">Chọn phòng ban</option>
                        <?php while ($pb = $phongban->fetch_assoc()) { ?>
                            <option value="<?php echo $pb['ma_phong']; ?>" 
                                    <?php if($pb['ma_phong'] == $nhanvien['ma_phong']) echo 'selected'; ?>>
                                <?php echo $pb['ten_phong']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Lương</label>
                    <input type="number" class="form-control" name="luong" 
                           value="<?php echo $nhanvien['luong']; ?>" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Cập nhật
                    </button>
                    <a href="index.php?controller=nhanvien&action=list" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?> 