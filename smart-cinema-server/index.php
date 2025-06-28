<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../smart-cinema-server/controllers/UserController.php';


header("Content-Type: application/json");

$route = $_GET['route'] ?? '';

if ($route === 'api/user') {
    require_once 'controllers/UserController.php';

    $method = $_SERVER['REQUEST_METHOD'];
    $userController = new UserController();

    if ($method === 'POST') {
        $userController->createUser();
    } else {
        http_response_code(405);
        echo json_encode(['message' => 'Method Not Allowed']);
    }
} else {
    http_response_code(404);
    echo json_encode(['message' => 'Route not found']);
}