<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

$user = new User($db);
$data = json_decode(file_get_contents("php://input"));

if (!isset($data->email) || !isset($data->password)) {
    echo json_encode(
        array(
            'error' => true,
            'message' => 'Login Failed, Data is Empty',
            'status' => 404
        )
    );
    http_response_code(404);
    return;
}

if (isEmptyLogin($data->email, $data->password)) {
    echo json_encode(
        array(
            'error' => true,
            'message' => 'Login Failed, Data is Empty',
            'status' => 404
        )
    );
    http_response_code(404);
    return;
}
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
    http_response_code(200);
} else {
    http_response_code(404);
    echo json_encode(
        array(
            'error' => true,
            'message' => 'No User Found',
            'status' => 404
            )
    );
}