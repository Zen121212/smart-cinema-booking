<?php
require_once("Model.php");
require_once("UserRole.php");

class UserModel extends Model{
    protected int $id;
    private string $name;
    private string $last_name;
    private string $email;
    private string $password;
    protected static string $table = "users";
    public function __construct(array $data){
        $this->id = (int)$data['id'];
       $this->name = $data['name'] ?? '';
        $this->last_name = $data['last_name'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->created_at = $data['created_at'] ?? '';
    }
    public function getId(): int {
        return $this->id;
    }
    public function getName(): string {
        return $this->name;
    }
    public function getLastName(): string {
        return $this->last_name;
    }
    public function toArray(){
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "last_name"=>$this->last_name,
            "email"=>$this->email
        ];
    }
    public static function register(array $data) {
        $findUser = static::find($data['email'], 'email');
        if ($findUser !== null) {
            return null;
        }

        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return parent::create($data);
    }
    public static function getUsersByRoleName(string $roleName) {
        $sql = "
        SELECT users.* 
        FROM users
        JOIN users_roles ON users.id = users_roles.user_id
        JOIN roles ON users_roles.role_id = roles.id
        WHERE roles.name = ?
        ";
        $query = static::$mysqli->prepare($sql);
        
        $query->bind_param("s", $roleName);
        $query->execute();
        
        $result = $query->get_result();
        
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = new static($row);
        }
        return $users;
    }

}