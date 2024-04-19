<?php
require 'userController.php';

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmedPassword = $_POST['comPassword'];

    if ($password !== $confirmedPassword) {
        header('Location: edit_profile.php');
        exit();
    }

    updateUserProfile($username, $password);

    header('Location: profile.php');
    exit();
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Update-Profile</title>
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
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Update Your Profile</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-user-o"></span>
                        </div>
                        <h3 class="text-center mb-4">Update Your Profile</h3>
                        <form action="edit_profile.php" class="login-form" method="post">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control rounded-left" placeholder="Username"
                                    name="username" value="<?php echo $username; ?>" required>
                            </div>

                            <div class="form-group ">
                                <label for="password">password:</label>
                                <input type="password" class="form-control rounded-left" placeholder="Password"
                                    name="password" value="<?php echo $password; ?>"required>
                            </div>
                            <div class="form-group ">
                                <label for="comPassword">confirmed Password:</label>
                                <input type="password" class="form-control rounded-left"
                                    placeholder=" confirmed Password" name="comPassword"
                                    value="<?php echo $comPassword; ?>"required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary rounded submit p-3 px-5">Get
                                    Started</button>
                            </div>
                        </form>
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
