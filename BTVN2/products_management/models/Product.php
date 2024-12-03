<?php
    require_once "config/database.php";

    class Product{
       private $pdo;
       public function __construct(){
           global $pdo;
           $this->pdo = $pdo;
       }
       public function getAllProducts(){
           $stmt = $this->pdo->prepare("SELECT * FROM products");
           $stmt->execute();
           return $stmt->fetchAll(PDO::FETCH_ASSOC);
       }
       public function getProductById($id){
           $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = :id");
           $stmt->execute([$id]);
           return $stmt->fetch(PDO::FETCH_ASSOC);
       }
       public function addProduct($name,$price){
           $stmt = $this->pdo->prepare("INSERT INTO products(name,price) VALUES(:name,:price)");
           $stmt->execute([$name,$price]);
       }
        public function updateProduct($id, $name, $price) {
            $stmt = $this->pdo->prepare('UPDATE products SET name = :name, price = :price WHERE id = :id');
            return $stmt->execute(['id' => $id, 'name' => $name, 'price' => $price]);
        }
       public function deleteProduct($id){
           $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = :id");
           $stmt->execute([$id]);
       }
    }
?>
