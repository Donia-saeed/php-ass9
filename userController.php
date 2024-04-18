<?php
session_start();

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

?>