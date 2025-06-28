<?php
require_once("Model.php");

class UserProfile extends Model
{
    protected int $user_profile_id;
    private string $user_profile_username;

    private ?string $user_profile_name;
    private ?string $user_profile_last_name;
    protected ?string $phone;
    protected ?string $address;
    protected ?string $bio;
    protected ?string $avatar_image;

    protected static string $table = 'users_profile';

    protected static string $primary_key = "user_profile_id";


    public function __construct(array $data) {
        $this->user_profile_id = $data['user_profile_id'] ?? 0;
        $this->user_profile_username = $data['user_profile_username'] ?? '';
        $this->user_profile_name = $data['user_profile_name'] ?? '';
        $this->user_profile_last_name = $data['user_profile_last_name'] ?? '';
        $this->phone = $data['phone'] ?? '';
        $this->address = $data['address'] ?? '';
        $this->bio = $data['bio'] ?? '';
        $this->avatar_image = $data['avatar_image'] ?? '';
    }

    public function getUserProfileId(): int {
        return $this->user_profile_id;
    }
    public function getUserProfileUserName(): string {
        return $this->user_profile_username;
    }
    public function getUserProfileName(): string {
        return $this->user_profile_name;
    }
    public function getUserProfileLastName(): string {
        return $this->user_profile_last_name;
    }
    public function getPhone(): ?string {
        return $this->phone;
    }

    public function getAddress(): ?string {
        return $this->address;
    }

    public function getBio(): ?string {
        return $this->bio;
    }

    public function getAvatarImage(): ?string {
        return $this->avatar_image;
    }

    public function toArray(): array {
        return [
            'user_profile_id' => $this->user_profile_id,
            'user_profile_username'=> $this->user_profile_username,
            'user_profile_name' => $this->user_profile_name,
            'user_profile_last_name' => $this->user_profile_last_name,
            'phone' => $this->phone,
            'address' => $this->address,
            'bio' => $this->bio,
            'avatar_image' => $this->avatar_image,
        ];
    }
}
