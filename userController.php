<?php
session_start();

function updateUserProfile($username, $password)
{
    $username = trim($username);
    $password = trim($password);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $data = getAllUserData();

    // Loop through user data to find the user's record by username
    foreach ($data as $key => $row) {
        if ($row['username'] === $_SESSION['username']) {
            $data[$key]['username'] = $username;
            $data[$key]['password'] = $hashedPassword;
            $_SESSION['username'] = $username;
            if (putAllUserData($data)) {
                // Data saved successfully
                return true;
            } else {
                // Failed to save data
                return false;
            }
        }
    }
    return false;
}

function getUserData($username, $password)
{
    $accounts = getAllUserData();
    foreach ($accounts as $row) {
        if ($row['username'] === $username) {
            return $row;
        }
    }
}

function logoutUser()
{
    // logout current user
    session_destroy();
    header('location: login.php');
    exit();
}

function getAllUserData()
{
    $data = file_get_contents('storage/users.json');
    $data = json_decode($data, true);
    return $data;
}

function putAllUserData($data)
{
    $data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents('storage/users.json', $data);
}
?>
