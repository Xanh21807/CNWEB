<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách hoa</title>
    <style>
        .flower { text-align: center; margin: 20px; }
        .flower img { max-width: 200px; height: auto; }
    </style>
</head>
<body>
    <h1>Danh sách các loài hoa</h1>
    <?php include 'flowers.php'; ?>

    <div style="display: flex; flex-wrap: wrap;">
        <?php foreach ($flowers as $flower): ?>
            <div class="flower">
                <img src="<?= $flower['image']; ?>" alt="<?= $flower['name']; ?>">
                <h2><?= $flower['name']; ?></h2>
                <p><?= $flower['description']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
