<?php
require_once("../../connection/connection.php");
require_once("../../models/User.php");
require_once("../../models/UserRole.php");
require_once("../../models/UserProfile.php");


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


Model::setConnection($mysqli);

header("Content-Type: application/json");


if (!isset($_POST['name'], $_POST['last_name'], $_POST['email'], $_POST['password'])) {
    echo json_encode([
        "error" => "Invalid or missing POST data."
    ]);
    return;
}

$data = [
    'name' => $_POST['name'],
    'last_name' => $_POST['last_name'],
    'email' => $_POST['email'],
    'password' => $_POST['password'],
];

$user = UserModel::register($data);

if($user){    
    $user_role = UserRole::create([
        'user_id' => $user->getId(),
        'role_id' => 2
    ]);

    $profileData = [
        'user_profile_id' => $user->getId(),
        'user_profile_name'=> $user->getName(),
        'user_profile_last_name'=> $user->getLastName(),
        'phone'           => $_POST['phone'] ?? null,
        'address'         => $_POST['address'] ?? null,
        'bio'             => $_POST['bio'] ?? null,
        'avatar_image'    => $_POST['avatar_image'] ?? null,
    ];

    $profile = UserProfile::create($profileData);

    echo json_encode([
        "message" => "User created successfully.",
        "user" => $user->toArray()
    ]);

    return;
}else{
        echo json_encode(["message" => "Email already exists."]);
    return;
}


