<?php

require 'userController.php';
// Check if the username is set in the session
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
$password = $_SESSION['password'];

$account = getUserData($username, $password);

// Check if the username parameter is set in the URL
if (isset($_GET['username'])) {
    $usernameToDelete = $_GET['username'];

    // Get all user accounts
    $accounts = getAllUserData();
    // Find the user account to delete
    foreach ($accounts as $key => $user) {
        if ($user['username'] === $usernameToDelete) {
            unset($accounts[$key]); // Remove the user account from the array
            break;
        }
    }
    // Save the updated user accounts
    putAllUserData($accounts);
    // Logout the user after deletion
    logoutUser();
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-user-o"></span>
                        </div>
                        <h3 class="text-center mb-4">Your Profile</h3>
                    </div>
                </div>
            </div>
            <a href="edit_profile.php" class="btn btn-warning btn-sm">Edit your profile</a>


            <button class="btn btn-danger btn-sm" data-toggle="modal"
                data-target="#deleteModal<?php echo $account['username']; ?>">remove your account</button>
            <!-- Modal for delete confirmation -->
            <div class="modal fade" id="deleteModal<?php echo $account['username']; ?>" tabindex="-1" role="dialog"
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
                            Are you sure you want to delete this account?
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <a href="profile.php?username=<?php echo $account['username']; ?>" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
