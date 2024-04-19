<?php

if (isset($_GET['id'])) {
    // Get the product ID from the URL
    $id = $_GET['id'];
    $products = file_get_contents('storage/product.json');
    $products = json_decode($products, true);
    foreach ($products as $key => $product) {
        if ($product['id'] == $id) {
            unset($products[$key]); // Remove the product from the array
            break;
        }
    }
    $jsonData = json_encode($products, JSON_PRETTY_PRINT);
    file_put_contents('storage/product.json', $jsonData);
    header('Location: product.php');
    exit();
}
?>
