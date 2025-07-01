<?php

require_once("../../connection/connection.php");
require_once("../../models/User.php");

Model::setConnection($mysqli);

header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Max-Age: 3600");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit();
}

header("Content-Type: application/json");

if (!isset($_POST['email'], $_POST['password'])) {
    http_response_code(400);
    echo json_encode(["message" => "Please provide both email and password."]);
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];
$user = UserModel::find($email,'email');

if (!$user) {
    echo json_encode(["message" => "Invalid credentials."]);
    exit();
}

if (password_verify($password, $user->getPassword())) {
    echo json_encode([
        "success"=> true,
        "message" => "Login successful.",
        "user" => $user->toArrayExcludePassword()
    ]);
    exit();
} else {
    echo json_encode(["message" => "Invalid credentials."]);
    exit();
}
