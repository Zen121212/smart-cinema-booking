<?php
require_once("../../connection/connection.php");
require_once("../../models/Wallet.php");


Model::setConnection($mysqli);
header("Content-Type: application/json");

if (!isset($_POST['user_id'], $_POST['amount'], $_POST['type'])) {
    echo json_encode([
        "error" => "User ID, amount, and transaction type are required.",
    ]);
    exit;
}

$user_id = filter_var($_POST['user_id'], FILTER_VALIDATE_INT);
$amount = filter_var($_POST['amount'], FILTER_VALIDATE_FLOAT);
$type = trim($_POST['type']);

if ($amount === false || $amount <= 0) {
    http_response_code(400);
    echo json_encode([
        "error" => "Invalid amount. Must be a positive number greater than 0."
    ]);
    exit;
}

$wallet = Wallet::find($user_id);
// echo"YES";
if($wallet){ 
    
    $balanceBefore = $wallet->getBalance();

    $success = $wallet->updateBalance($amount, $type);

    if (!$success) {
        http_response_code(400);
        echo json_encode([
            "error" => "Transaction failed. Possibly insufficient balance for debit."
        ]);
        exit;
    }else{
        echo json_encode([
        "message" => "Transaction successful.",
        "wallet" => $wallet->toArray()
    ]);
    }
}else{
    echo json_encode([
        "error" => "Wallet not found",
        "message" => $e->getMessage()
    ]);
}

