<?php
// Check if product ID is provided in the URL
if (isset($_GET['id'])) {
    // Get the product ID from the URL
    $id = $_GET['id'];
    $products = file_get_contents('storage/product.json');
    $products = json_decode($products, true);
    foreach ($products as $key => $product) {
        if ($product['id'] == $id) {
            unset($products[$key]); // Remove the product from the array
            break; // Exit the loop once the product is found and removed
        }
    }
    // Encode the modified array back to JSON and rewrite the file
    $jsonData = json_encode($products, JSON_PRETTY_PRINT);
    file_put_contents('storage/product.json', $jsonData);


    header('Location: product.php');
    exit();
}
?>
