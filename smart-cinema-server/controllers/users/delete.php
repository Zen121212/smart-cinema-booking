<?php

require_once("../../connection/connection.php");
require_once("../../models/User.php");

Model::setConnection($mysqli);

header("Content-Type: application/json");

if (!isset($_GET['id'])) {
    echo json_encode(["error" => "Missing id"]);
    return;
}

$id = $_GET['id'];

$user = UserModel::find($id);
if ($user) {
    UserModel::delete($id);

    echo json_encode([
        "message" => "User deleted successfully.",
        "user_deleted" => $user->toArray()
    ]);
    return;
} else {
    echo json_encode(["error" => "User does not exist."]);
return;
}
