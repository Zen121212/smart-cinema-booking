<?php 

require_once("../../connection/connection.php");
require_once("../../models/User.php");

Model::setConnection($mysqli);

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Allows requests from any origin
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Specify allowed methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Specify allowed headers
header("Access-Control-Max-Age: 3600"); 

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
    }
    foreach($users as $u){
        $response["users"][] = $u->toArray(); 
    }
}

echo json_encode($response);