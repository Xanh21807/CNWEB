<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
<h1>Cập nhật sản phẩm</h1>
<?php
if (isset($product)) : ?>
    <form method="POST" action="">
        <label for="name">Tên:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required><br>

        <label for="price">Giá:</label>
        <input type="number" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" required><br>

        <button type="submit">Cập nhật</button>
    </form>
<?php else: ?>
    <p>Không có sản phẩm để cập nhật.</p>
<?php endif; ?>


</body>
</html>