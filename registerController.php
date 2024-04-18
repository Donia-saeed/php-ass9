<?php
require 'userController.php';
// check if user is already logged in
if (isset($_SESSION['username'])) {
    header('location: index.php');//after login
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $comPassword = $_POST['comPassword'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $comHashedPassword = password_hash($comPassword, PASSWORD_DEFAULT);

    $_POST['password'] = $hashedPassword;//replace
    $_POST['comPassword'] = $comHashedPassword;//replace

    $data= getAllUserData();
    $data[] = $_POST; // push new $_POST into old $data[] array
    putAllUserData($data);
}

header('Location: login.php');
exit(); // Always exit after a header redirect
?>
