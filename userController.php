<?php
session_start();

function updateUserProfile($username)
{
    // validation on username
    $data = getAllUserData();
    foreach ($data as $key => $row) {
        if ($row['username'] === $_SESSION['username']) {
            $data[$key]['username'] = $username;
            $_SESSION['username'] = $username;
            break;
        }
    }
    putAllUserData($data);
    return true;
}
function deleteUserProfile()
{
    $data = getAllUserData();
    foreach ($data as $key => $row) {
        if ($row['username'] === $_SESSION['username']) {
            unset($data[$key]);
            break;
        }
    }
    putAllUserData($data);
    logoutUser();
    return true;
}
function getUserData($username, $password)
{
    $accounts = getAllUserData();
    foreach ( $accounts as $row) {
        if ($row['username'] === $username ) {
            return $row;
        }
    }
    
}


function getAllUserData()
{ $data = file_get_contents('storage/users.json');
    $data = json_decode($data, true);
    return $data;
}

function putAllUserData($data)
{
    $data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents('storage/users.json', $data);
}




// function userExists($username)
// {
//     $data = getAllUserData();
//     foreach ($data as $row) {
//         if ($row['username'] == $username) {
//             return true;
//         }
//     }
//     return false;
// }

// if (userExists($username)) {
//     header('Location: index.php');
//     exit(); 
// }
?>