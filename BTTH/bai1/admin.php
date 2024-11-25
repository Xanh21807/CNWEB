<?php
    include 'flowers.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Xử lý upload ảnh
    $image = 'images/' . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $image);

    // Thêm hoa mới
    $flowers[] = ['name' => $name, 'description' => $description, 'image' => $image];

    // Ghi lại dữ liệu
    file_put_contents('flowers.php', "<?php\n\$flowers = " . var_export($flowers, true) . ";\n?>");

// Chuyển về trang quản trị
header('Location: admin.php');
exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh sách hoa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .flower-card {
            margin-bottom: 20px;
        }
        .flower-card img {
            max-width: 100%;
            height: auto;
        }
        .container {
            max-width: 1200px;
        }
    </style>
</head>

<body>
    
<div class="container">
        <h1 class="text-center mb-5">Quản lý danh sách hoa</h1>

        <h2>Thêm hoa mới</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Tên hoa:</label>
                <input type="text" class="form-control form-control-lg" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea class="form-control form-control-lg" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Hình ảnh:</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-success btn-lg">Thêm hoa mới</button>
        </form>

        <h2 class="mt-5">Danh sách hoa</h2>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên hoa</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flowers as $index => $flower): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= $flower['name']; ?></td>
                    <td><?= $flower['description']; ?></td>
                    <td><img src="<?= $flower['image']; ?>" alt="<?= $flower['name']; ?>" width="100"></td>
                    <td>
                        <button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#editModal<?= $index; ?>">Sửa</button>
                        <a href="delete.php?id=<?= $index; ?>" class="btn btn-danger btn-lg" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
                    </td>
                </tr>
                <!-- Modal Sửa -->
                <div class="modal fade" id="editModal<?= $index; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $index; ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel<?= $index; ?>">Sửa loài hoa: <?= $flower['name']; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="edit.php?id=<?= $index; ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="name">Tên hoa:</label>
                                        <input type="text" class="form-control form-control-lg" id="name" name="name" value="<?= $flower['name']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Mô tả:</label>
                                        <textarea class="form-control form-control-lg" id="description" name="description" required><?= $flower['description']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Hình ảnh:</label>
                                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                                        <img src="<?= $flower['image']; ?>" alt="<?= $flower['name']; ?>" width="100" class="mt-2">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg">Cập nhật</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>