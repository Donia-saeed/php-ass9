<?php
require 'userController.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['username']= $_POST['username'];
    $username =  $_SESSION['username'];
    $_SESSION['password']= $_POST['password'];
    $password =  $_SESSION['password'];
  
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $accounts= getAllUserData();
    $userexist = 0;
    foreach ($accounts as $account) {
        if ($account['username'] == $username && password_verify($password, $account['password'])) {
            $userexist = 1;
            break;
        }
    }
    if ($userexist) {
        header('Location: index.php');
        exit(); 
    } else {
         
     $error = 'Invalid username or password';
      include 'login.php';
       
    }
}
?>
