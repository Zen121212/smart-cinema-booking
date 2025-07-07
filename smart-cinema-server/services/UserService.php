<?php

require_once __DIR__ . "/../models/UserProfile.php";
require_once __DIR__ . "/../models/Wallet.php";

class UserService {
    public static function addGenresForUser($user_profile_id, array $genre_ids) {
        foreach ($genre_ids as $genre_id) {
            static::create([
                'user_profile_id' => $user_profile_id,
                'genre_id' => $genre_id
            ]);
    }
    }
    public static function updateUserProfile(int $id, array $input) {
        $fields = [
            'user_profile_username',
            'user_profile_name',
            'user_profile_last_name',
            'phone',
            'address',
            'bio',
            'avatar_image'
        ];
        $data = [];
        foreach ($fields as $field) {
            if (array_key_exists($field, $input)) {
                $value = $input[$field];
                if ($value === '') {
                    $data[$field] = null;
                } else {
                    $data[$field] = $value;
                }
            }
        }
        $userProfile = UserProfile::find($id);
        if (!$userProfile) {
            throw new Exception("User profile not found.");
        }
        $updatedProfile = UserProfile::update($id, $data);
        if (isset($_POST['genres']) && is_array($_POST['genres'])) {
            UserFavoriteGenre::addGenresForUser($id, $_POST['genres']);
        }

        return $updatedProfile->toArray();
    }
}
