<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product</title>
    <style>
        h1 {
            font-size: 2em;
            color: #333;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>
<?php
if(isset($products)){
    echo "<h1>Product </h1>";
    echo "<p>Name:".$products["name"]."</p>";
    echo "<p>Price:".$products["price"]."</p>";
    echo "<a href='index.php'>Back</a>";
}
?>
</body>
</html>
