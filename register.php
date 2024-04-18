<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $comPassword = $_POST['comPassword'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $comHashedPassword = password_hash($comPassword, PASSWORD_DEFAULT);

    $_POST['password'] = $hashedPassword;//replace
    $_POST['comPassword'] = $comHashedPassword;//replace

    $data = file_get_contents('storage/data.json'); // get data from file convert it to array
    $data = json_decode($data, true);
    $data[] = $_POST; // push new $_POST into old $data[] array
    $data = json_encode($data, JSON_PRETTY_PRINT); //store data in encoding
    file_put_contents('storage/data.json', $data);
}

header('Location: login.html');
exit(); // Always exit after a header redirect
?>
