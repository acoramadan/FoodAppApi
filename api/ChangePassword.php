<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../conf/Initialized.php';

$user = new User($db);
$data = json_decode(file_get_contents("php://input"));
$user->setEmail($data->email);
$user->setPassword($data->password);

if($user->updatePasswordById()) {
    $user_arr = array();
    $user_arr['data'] = array();
    $user_item = array(
        "error" => false,
        "message" => "Password Updated",
        "status" => 200,
    );
    array_push($user_arr['data'], $user_item);
    echo json_encode($user_arr);
} else {
    echo json_encode(
        array(
            'message' => 'Password Update Failed',
            'status' => 404,
            'error' => true,
        )
    );
}