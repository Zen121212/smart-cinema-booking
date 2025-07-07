<?php
require(__DIR__ . "/../connection/connection.php");
require(__DIR__ . "/../services/ResponseService.php");
require(__DIR__ . "/../models/User.php");
require(__DIR__ . "/../services/AuthService.php");

Model::setConnection($mysqli);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");

class AuthController
{
    public function login(){
        try {
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;
            $user = AuthService::login($email, $password);
            echo ResponseService::response([
                "user" => $user->toArrayExcludePassword()
            ], 200, true);
        } catch (Exception $e) {
            echo ResponseService::response("Error: " . $e->getMessage(), 400);
        }
    }
    public function register(){
        try {
            $name = $_POST['name'] ?? null;
            $lastName = $_POST['last_name'] ?? null;
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;
            $newUser = AuthService::register($name, $lastName, $email, $password);
            echo ResponseService::response([
                "user" => $newUser->toArrayExcludePassword()
            ], 201);
        } catch (Exception $e) {
            echo ResponseService::response("Error: " . $e->getMessage(), 400);
        }
    }
}