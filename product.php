<?php

$products = file_get_contents('storage/product.json'); // get data from file convert it to array
$products = json_decode($products, true);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Products</h1>
        <!-- Button to create new product -->
        <a href="create_product.php" class="btn btn-primary mb-3">Create-NewProduct </a>
        <!-- Button to view-YourProfile -->
        <a href="profile.php" class="btn btn-primary mb-3">view-YourProfile </a>
        <!-- Button to log-out -->
        <form id="logoutForm" action="logout.php" method="post" style="display: inline;">
            <button type="submit" name="logout" class="btn btn-primary mb-3">Logout</button>
        </form>
        <!-- Table to display products -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td>$<?php echo $product['price']; ?></td>
                    <td><?php echo $product['quantity']; ?></td>
                    <td>
                        <!-- Button to edit product -->
                        <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <!-- Button to delete product -->
                        <button class="btn btn-danger btn-sm" data-toggle="modal"
                            data-target="#deleteModal<?php echo $product['id']; ?>">Delete</button>
                        <!-- Modal for delete confirmation -->
                        <div class="modal fade" id="deleteModal<?php echo $product['id']; ?>" tabindex="-1" role="dialog"
                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this product?
                                    </div>
                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <a href="delete_product.php?id=<?php echo $product['id']; ?>"
                                            class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
