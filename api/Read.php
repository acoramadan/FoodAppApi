<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../conf/Initialized.php';

$user = new User($db);
$result = $user->read();

if($result->rowCount() > 0) {
    $user_arr = array();
    $user_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $user_item = array (
            'id' => $id,
            'user_name' => $user_name,
            'email' => $email,
            'phone_number' => $phone_number,
            'created_at' => $created_at,
            'modified' => $modified
        );
        array_push($user_arr['data'], $user_item);

        echo json_encode($user_arr);
    }
} else {
    echo json_encode(
        array(
            'message' => 'No User Found',
            'status' => 404,
            'error' => true
            )
    );
}