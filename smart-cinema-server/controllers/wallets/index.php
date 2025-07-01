<?php
require_once("../../connection/connection.php");
require_once("../../models/Wallet.php");


Model::setConnection($mysqli);
header("Content-Type: application/json");

if (!isset($_POST['user_id'])) {
    echo json_encode([
        "error" => "User ID wallet",
    ]);
    exit;
}

$user_id = $_POST['user_id'];

$wallet = Wallet::find($user_id);
if($wallet){ 
        echo json_encode([
        "message" => "Wallet found.",
        "wallet" => $wallet->toArray()
    ]);
}else{
    echo json_encode([
        "error" => "Wallet not found",
        "message" => $e->getMessage()
    ]);
}

