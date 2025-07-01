<?php
require_once("Model.php");

class UserRole extends Model
{
    protected int $user_id;
    protected int $role_id;

    protected static string $table = 'users_roles';

    public function __construct(array $data) {
        $this->user_id = $data['user_id'];
        $this->role_id = $data['role_id'];
    }

    public function getUserId(): int {
        return $this->user_id;
    }

    public function getRoleId(): int {
        return $this->role_id;
    }
    public function toArray(): array {
        return [
            'user_id' => $this->user_id,
            'role_id' => $this->role_id,
        ];
    }
}
