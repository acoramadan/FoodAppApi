<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
include_once '../conf/Initialized.php';
include_once '../utils/Token.php';
include_once '../utils/Encrypt.php';

$user = new User($db);
$data = json_decode(file_get_contents("php://input"));
$user->setEmail($data->email);
$user->setPassword($data->password);

if($user->userLogin() != null) {
    $user_arr = array();
    $user_arr['data'] = array();
    $id = generateIdEncrpyt($user->userLogin()['id']);
    $user_item = array (
        "error" => false,
        "message" => "Login Success",   
        "status" => 200,
        "user" => (object) [
            "id" => $id,
            "username" => $user->userLogin()['user_name'],
            "token" => generateToken(),
        ]
    );
    array_push($user_arr['data'], $user_item);

    echo json_encode($user_arr);
} else {
    echo json_encode(
        array(
            'message' => 'No User Found',
            'status' => 404,
            'error' => true,
            )
    );
}