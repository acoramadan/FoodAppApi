<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$user = new User($db);
$data = json_decode(file_get_contents("php://input"));

if(!isset($data->email) || !isset($data->username) || !isset($data->password) || !isset($data->phoneNumber)) {
    echo json_encode(
        array(
            'error' => true,
            'message' => 'Register Failed, Data is Empty',
            'status' => 404
        )
    );
    return;
}

if(isEmptyRegister($data->email, $data->username, $data->password, $data->phoneNumber)) {
    echo json_encode(
        array(
            'error' => true,
            'message' => 'Register Failed, Data is Empty',
            'status' => 404
        )
    );
    return;
}
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
            'error' => true,
            'message' => 'Register Failed',
            'status' => 404
        )
    );
}