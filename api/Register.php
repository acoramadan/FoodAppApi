<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../conf/Initialized.php';
include_once '../utils/Token.php';

$user = new User($db);
$data = json_decode(file_get_contents("php://input"));
$user->setEmail($data->email);
$user->setPassword($data->password);
$user->setUserName($data->username);
$user->setNoTelp($data->phoneNumber);

if ($user->createUser()) {
    $user_arr = array();
    $user_arr['data'] = array();
    $user_item = array(
        "error" => false,
        "message" => "Register Success",
        "status" => 200,
    );
    array_push($user_arr['data'], $user_item);
    echo json_encode($user_arr);
} else {
    echo json_encode(
        array(
            'message' => 'Register Failed',
            'status' => 404,
            'error' => true,
        )
    );
}