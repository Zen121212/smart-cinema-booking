<?php

require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../models/UserProfile.php";
require_once __DIR__ . "/../models/Wallet.php";

class AuthService {
    public static function checkPassword($user, string $password){
        if (!password_verify($password, $user->getPassword())) {
            throw new Exception("Wrong password.");
        }
        return $user;
    }
    public static function login(string $email, string $password){
        $user = User::find($email, 'email');
        if (!$user) {
            throw new Exception("Invalid credentials.");
        }
        self::checkPassword($user, $password);
        return $user;
    }
    public static function register($name, $lastName, $email, $password){
        $payload = [
            'name'      => $name,
            'last_name' => $lastName,
            'email'     => $email,
            'password'  => password_hash($password, PASSWORD_DEFAULT),
        ];
        $user = User::create($payload);
        $profilePayload = [
            'user_profile_id' => $user->getId(),
            'user_profile_name' => $user->getName(),
            'user_profile_last_name' => $user->getLastName(),
            'phone' => $profileData['phone'] ?? null,
            'address' => $profileData['address'] ?? null,
            'bio' => $profileData['bio'] ?? null,
            'avatar_image' => $profileData['avatar_image'] ?? null,
        ];
        UserProfile::create($profilePayload);
        Wallet::create([
            'user_id'  => $user->getId(),
            'balance'  => 0.00,
            'currency' => 'USD'
        ]);
        return $user;
    }
}
