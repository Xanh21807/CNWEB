<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
        <style>
        /* Reset mặc định của trình duyệt */
        body, h1, ul, li, form, label, input, button {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            font-size: 2em;
            color: #333;
            margin-bottom: 20px;
        }

        /* Form thêm sản phẩm */
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin-bottom: 30px;
        }

        form label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }

        form button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            max-width: 600px;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        thead {
            background-color: #007bff;
            color: white;
        }

        thead th {
            padding: 10px;
            text-align: left;
        }

        tbody tr {
            border-bottom: 1px solid #ddd;
        }

        tbody td {
            padding: 10px;
        }

        tbody tr:hover {
            background-color: #f9f9f9;
        }
        tbody td a {
            text-decoration: none;
            color: #007bff;
            margin: 0 5px;
        }

        tbody td a:hover {
            text-decoration: underline;
        }
        p {
            font-size: 1.2em;
            color: #555;
            text-align: center;
        }


    </style>

</head>
<body>

<?php
echo "<h1>Product List</h1>";

echo "<form method='POST' action='?action=create'>
        <label for='name'>Product Name:</label>
        <input type='text' id='name' name='name' required>
        <label for='price'>Price:</label>
        <input type='number' id='price' name='price' required>
        <button type='submit'>Add Product</button>
      </form>";

if (isset($products) && !empty($products)) {
    echo "<table>";
    echo "<thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
          </thead>";
    echo "<tbody>";
    foreach ($products as $product) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($product['name']) . "</td>";
        echo "<td>$" . htmlspecialchars(number_format($product['price'], 2)) . "</td>";
        echo "<td>
                <a href='?action=show&id=" . $product['id'] . "'>View</a> | 
                <a href='?action=update&id=" . $product['id'] . "'>Edit</a> | 
                <a href='?action=delete&id=" . $product['id'] . "' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</a>
              </td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>No products found.</p>";
}
?>


</body>
</html>
