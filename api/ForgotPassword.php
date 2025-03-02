<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$user = new User($db);
$data = json_decode(file_get_contents("php://input"));

if(!isset($data->email) || !isset($data->password)) {
    echo json_encode(
        array(
            'error' => true,
            'message' => 'Change Password Failed, Data is Empty',
            'status' => 404,
        )
    );
    http_response_code(404);
    return;
}

if(isEmptyPasswordAndEmail($data->email, $data->password)) {
    echo json_encode(
        array(
            'error' => true,
            'message' => 'Change Password Failed, Data is Empty',
            'status' => 404,
        )
    );
    http_response_code(404);
    return;
}

$user->setEmail($data->email);
$user->setPassword($data->password);


if($user->updatePasswordByEmail()) {
    $user_arr = array();
    $user_arr['data'] = array();
    $user_item = array(
        "error" => false,
        "message" => "Password Updated",
        "status" => 200,
    );
    array_push($user_arr['data'], $user_item);
    echo json_encode($user_arr);
    http_response_code(200);
} else {
    echo json_encode(
        array(
            'error' => true,
            'message' => 'Password Update Failed',
            'status' => 404,
        )
    );
    http_response_code(404);
}