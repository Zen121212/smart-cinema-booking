<?php
require(__DIR__ . "/../connection/connection.php");
require(__DIR__ . "/../services/ResponseService.php");
require(__DIR__ . "/../models/User.php"); 

Model::setConnection($mysqli);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

class AuthController {
    public function login() {
        try{
            if(empty($_POST['email']) || empty($_POST['password'])){
                echo ResponseService::response("Email and password are required!",400);
                return;
            }
        }
        catch (Exception $e){
            echo"yes";
        }

    }
}