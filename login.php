<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $accounts = file_get_contents('storage/data.json'); // get data from file convert it to array
    $accounts = json_decode($accounts, true);
    $flag = 0;
    foreach ($accounts as $account) {
        if ($account['username'] == $username && password_verify($password, $account['password'])) {
            $flag = 1;
            break;
        }
    }
    if ($flag) {
        include 'index.php';
    } else {
        echo 'wrong username or password';
    }
}
?>
