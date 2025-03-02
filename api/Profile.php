<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$user = new User($db);

$user->setId($_GET['id']);
$result = $user->getUserById();

if(!empty($result)) {
    $user_arr = [];
    $user_arr['data'] = array();
    $user_item = array (
        "error" => false,
        "message" => "Profile retrieved successfully",   
        "status" => 200,
        "user" => (object) [
            "username" => $result['user_name'],
            "email" => $result['email'],
            "phone_number" => $result['phone_number'],
        ]
    );
    array_push($user_arr['data'], $user_item);
    echo json_encode($user_arr);
} else {
    echo json_encode(
        [
            'error' => true,
            'message' => 'No User Found',
            'status' => 404
        ]
    );
}
