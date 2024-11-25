<?php 
// Đọc dữ liệu sản phẩm từ tệp sản phẩm
$filename = 'products.php'; // Hoặc 'products.json' nếu bạn dùng JSON

// Kiểm tra và lấy dữ liệu sản phẩm từ file
if (file_exists($filename)) {
    include $filename; // Sử dụng mảng PHP nếu file là PHP
    // Hoặc đọc JSON nếu file là JSON
    // $products = json_decode(file_get_contents($filename), true);
}

// Kiểm tra tham số action và id
$action = $_GET['action'] ?? 'add';
$id = $_GET['id'] ?? null;

// Giá trị mặc định cho form
$name = '';
$price = '';

if ($action === 'edit' && isset($id)) {
    // Lấy thông tin sản phẩm từ mảng nếu đang sửa
    $name = $products[$id]['name'] ?? '';
    $price = $products[$id]['price'] ?? '';
}

// Biến để lưu thông báo thành công
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';

    if ($action === 'edit' && isset($id)) {
        // Cập nhật sản phẩm trong mảng
        $products[$id] = ['name' => $name, 'price' => (int)$price];
        $successMessage = 'Cập nhật sản phẩm thành công!';
    } else {
        // Thêm sản phẩm mới vào mảng
        $products[] = ['name' => $name, 'price' => (int)$price];
        $successMessage = 'Thêm sản phẩm mới thành công!';
    }

    // Ghi lại mảng sản phẩm vào tệp (PHP hoặc JSON)
    if ($filename === 'products.php') {
        // Lưu lại vào tệp PHP
        $content = '<?php' . PHP_EOL . '$products = ' . var_export($products, true) . ';';
        file_put_contents($filename, $content);
    } else {
        // Lưu lại vào tệp JSON
        file_put_contents($filename, json_encode($products, JSON_PRETTY_PRINT));
    }
}

// Kiểm tra yêu cầu xóa sản phẩm từ URL
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Kiểm tra xem sản phẩm có tồn tại trong mảng không
    if (isset($products[$id])) {
        // Xóa sản phẩm
        unset($products[$id]);
        // Lưu lại sau khi xóa
        if ($filename === 'products.php') {
            // Lưu lại vào tệp PHP
            $content = '<?php' . PHP_EOL . '$products = ' . var_export($products, true) . ';';
            file_put_contents($filename, $content);
        } else {
            // Lưu lại vào tệp JSON
            file_put_contents($filename, json_encode($products, JSON_PRETTY_PRINT));
        }
        // Sau khi xóa, chuyển hướng về trang danh sách sản phẩm
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
?>

<?php include 'header.php'; ?>

<div class="container-fluid">
    <h1 class="text-center"><?= $action === 'edit'?></h1>

    <!-- Hiển thị thông báo thành công -->
    <?php if ($successMessage): ?>
        <div class="alert alert-success"><?= $successMessage ?></div>
    <?php endif; ?>
</div>

<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-xs-6">
                    <h2>Danh sách sản phẩm</h2>
                </div>
                <div class="col-xs-6">
                    <!-- Nút để mở modal Thêm sản phẩm -->
                    <button class="btn btn-success" data-toggle="modal" data-target="#addProductModal">
                        <i class="material-icons">&#xE147;</i> <span>Thêm sản phẩm</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Thêm sản phẩm -->
        <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Thêm sản phẩm mới</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="index.php?action=add" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên sản phẩm:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Giá thành:</label>
                                <input type="text" name="price" id="price" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Sửa sản phẩm -->
        <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductModalLabel">Sửa sản phẩm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="index.php?action=edit&id=<?= htmlspecialchars($id) ?>" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên sản phẩm:</label>
                                <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($name) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Giá thành:</label>
                                <input type="text" name="price" id="price" class="form-control" value="<?= htmlspecialchars($price) ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $id => $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= number_format($product['price'], 0, ',', '.') ?> VNĐ</td>
                    <td>
                        <!-- Nút sửa sản phẩm -->
                        <button class="btn btn-warning" data-toggle="modal" data-target="#editProductModal" 
                                onclick="setEditProduct(<?= $id ?>, '<?= htmlspecialchars($product['name']) ?>', <?= $product['price'] ?>)">
                            Sửa
                        </button>
                        <!-- Nút xóa sản phẩm -->
                        <a href="index.php?action=delete&id=<?= $id ?>" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>

<script>
    function setEditProduct(id, name, price) {
        document.getElementById('name').value = name;
        document.getElementById('price').value = price;
        var form = document.querySelector('#editProductModal form');
        form.action = 'index.php?action=edit&id=' + id;
    }
</script>
