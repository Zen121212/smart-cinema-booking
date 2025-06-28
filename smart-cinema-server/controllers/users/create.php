<?php
require_once("../../connection/connection.php");
require_once("../../models/User.php");
require_once("../../models/UserRole.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


Model::setConnection($mysqli);

header("Content-Type: application/json");


if (!isset($_POST['name'], $_POST['email'], $_POST['password'])) {
    http_response_code(400);
    echo json_encode([
        "status" => 400,
        "error" => "Invalid or missing POST data."
    ]);
    return;
}

$data = [
    'name' => $_POST['name'],
    'email' => $_POST['email'],
    'password' => $_POST['password'],
];

$user = UserModel::create($data);

if($user){    
    $user_role = UserRole::create([
        'user_id' => $user->getId(),
        'role_id' => 2
    ]);

    echo json_encode([
        "message" => "User created successfully.",
        "user" => $user->toArray()
    ]);
    return;
}else{
        echo json_encode(["message" => "Email already exists."]);
    return;
}


