<?php
// Bao gồm file chứa dữ liệu hoa
include 'flowers.php';

// Lấy id từ tham số URL
$id = $_GET['id'] ?? null;

// Kiểm tra xem id có hợp lệ hay không
if ($id === null || !isset($flowers[$id])) {
    die("ID hoa không hợp lệ.");
}

// Xóa hoa
unset($flowers[$id]);

// Tái sắp xếp lại chỉ số mảng (re-index)
$flowers = array_values($flowers);

// Cập nhật lại file flowers.php với danh sách hoa mới
file_put_contents('flowers.php', "<?php\n\$flowers = " . var_export($flowers, true) . ";\n?>");

// Điều hướng về trang quản lý danh sách hoa
header('Location: admin.php');
exit;
?>
