<?php
global $pdo;
require_once 'config/database.php';
require_once 'controllers/ProductController.php';

$controller = new ProductController($pdo);

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = isset($_GET['id']) ? intval($_GET['id']) : null;

    switch ($action) {
        case 'show':
            $controller->show($id);
            break;
        case 'create':
            $controller->create();
            break;
        case 'update':
            if ($id) {
                $controller->update($id);
            } else {
                echo "ID sản phẩm không hợp lệ.";
            }
            break;
        case 'delete':
            if ($id) {
                $controller->delete($id);
            } else {
                echo "ID sản phẩm không hợp lệ.";
            }
            break;
        default:
            $controller->index();
            break;
    }
} else {
    $controller->index();
}
?>
