<?php
include 'flowers.php';

$id = $_GET['id'] ?? null;

if ($id === null || !isset($flowers[$id])) {
    die("Hoa không tồn tại!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flowers[$id]['name'] = $_POST['name'];
    $flowers[$id]['description'] = $_POST['description'];

    if (!empty($_FILES['image']['name'])) {
        $flowers[$id]['image'] = 'images/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $flowers[$id]['image']);
    }

    file_put_contents('flowers.php', "<?php\n\$flowers = " . var_export($flowers, true) . ";\n?>");

    header('Location: admin.php');
    exit;
}
?>
