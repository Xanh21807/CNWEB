<?php
require_once 'models/Product.php';
class ProductController{
    private $model;
    public function __construct(){
        $this->model = new Product();
    }

    public function index(){
        $products = $this->model->getAllProducts();
        require 'views/products/index.php';
    }
    public function show($id){
        $products = $this->model->getProductById($id);
        require 'views/products/show.php';
    }
    public function create(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->model->addProduct($_POST["name"],$_POST["price"]);
            header('Location: index.php');
            exit;
        }else{
            require 'views/products/create.php';
        }
    }
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $this->model->updateProduct($id, $name, $price);
            header('Location: index.php');
        } else {
            $product = $this->model->getProductById($id);
            include 'views/products/update.php';
        }
    }
    public function delete($id){
        $this->model->deleteProduct($id);
        header('Location: index.php');
    }

}
?>