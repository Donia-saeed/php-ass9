<?php
require 'userController.php';

$products = file_get_contents('storage/product.json');
$products = json_decode($products, true);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    foreach ($products as &$product) {
        if ($product['id'] == $id) {
            // Update product data
            $product['name'] = $name;
            $product['price'] = $price;
            $product['quantity'] = $quantity;
            break;
        }
    }
    $products = json_encode($products, JSON_PRETTY_PRINT);
    file_put_contents('storage/product.json', $products);
    header('Location: product.php');
    exit();
}

// Check if product ID is provided in the URL for editing
$id = $_GET['id'] ?? null;
$productToEdit = null;
foreach ($products as $product) {
    if ($product['id'] == $id) {
        $productToEdit = $product;
        break;
    }
}

// Set variables for pre-filling the form fields
$name = $productToEdit['name'];
$price = $productToEdit['price'];
$quantity = $productToEdit['quantity'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <style>
        /* Optional: Add some custom styling */
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 500px;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-4">Edit Product</h1>
        <form action="edit_product.php" method="post">
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" class="form-control" id="id" name="id" value="<?php echo $id; ?>"
                    readonly>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="price">Price ($):</label>
                <input type="number" class="form-control" id="price" name="price" min="1" step="1"
                    value="<?php echo $price; ?>" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" min="0" step="1"
                    value="<?php echo $quantity; ?>" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-edit mr-1"></i>Update
                    Product</button>
                <a href="product.php" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i>Back to Product
                    List</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
