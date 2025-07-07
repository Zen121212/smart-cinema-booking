<?php
require(__DIR__ . "/../connection/connection.php");
require(__DIR__ . "/../services/ResponseService.php");
require(__DIR__ . "/../models/User.php"); 
require(__DIR__ . "/../models/UserProfile.php"); 
require(__DIR__ . "/../services/UserService.php");

Model::setConnection($mysqli);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

class UserController {
    public function getAllUsers(){
        try{
            $response = [];
            $users = User::all();
            foreach ($users as $u) {
                $response[] = $u->toArrayExcludePassword();
            }
            echo ResponseService::response($response, 200);
        }
        catch (Exception $e) {
            echo ResponseService::response("Error: " . $e->getMessage(), 500);
        }
    }
    public function getUserById(int $id){
        try {
            $user = User::find($id);
            if (!$user) {
                echo ResponseService::response("No user", 400);
                return;
            }
            echo ResponseService::response($user->toArrayExcludePassword(), 200);
        } catch (Exception $e) {
            echo ResponseService::response("Error: " . $e->getMessage(), 500);
        }
    }
    public function updateUserById(int $id){
        try {
            $updatedProfile = UserService::updateUserProfile($id, $_POST);
            echo ResponseService::response($updatedProfile, 200);
        } catch (Exception $e) {
            echo ResponseService::response("Error: " . $e->getMessage(), 500);
        }
    }
    public function getUserProfile(int $id){
        try {
            $profile = UserProfile::find($id);
            echo ResponseService::response($profile->toArray(), 200);
        } catch (Exception $e) {
            echo ResponseService::response("Error: " . $e->getMessage(), 500);
        }
    }
}
