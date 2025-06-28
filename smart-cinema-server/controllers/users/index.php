<?php 

require_once("../../connection/connection.php");
require_once("../../models/User.php");

Model::setConnection($mysqli);

header("Content-Type: application/json");

$response = [];
$roleFilter = $_GET['role'] ?? null;
$id = $_GET['id'] ?? null;

if ($id) {

    $user = UserModel::find($id);

    if (!$user) {
        echo json_encode(["error" => "User not found."]);
        return;
    }
    $response["user"] = $user->toArray();
} 
else 
{
    if ($roleFilter) {
            $users = UserModel::getUsersByRoleName($roleFilter);
    } 
    else {
        $users = UserModel::all();
        print_r($user);
    }
    foreach($users as $u){
        $response["users"][] = $u->toArray(); 
    }
}

echo json_encode($response);