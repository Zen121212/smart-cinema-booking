<?php

require_once("Model.php");
class Wallet extends Model
{
    protected int $id;
    private int $user_id;
    private float $balance;
    private string $currency;

    protected static string $table = 'wallets';
    protected static string $primary_key = "user_id";

    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->user_id = $data['user_id'];
        $this->balance = $data['balance'];
        $this->currency = $data['currency'];

    }

    public function getId(): int {
        return $this->id;
    }
    public function getUserId(): string {
        return $this->user_id;
    }
    public function getBalance(): string {
        return $this->balance;
    }
    public function setBalance(float $amount): void {
        $this->balance = $amount;
    }
    public function getCurrency(): string {
        return $this->currency;
    }
    public function toArray()
    {
        return [
            'user_id' => $this->user_id,
            'balance' => number_format(floatval($this->balance), 2, '.', ''),
            'currency' => $this->currency
        ];
    }
    public function updateBalance($amount, $type) {

    $amount = floatval($amount);
    $currentBalance = floatval($this->balance);

    if ($type === 'credit') {
        $newBalance = $currentBalance + $amount;
    } elseif ($type === 'paid') {
        if ($currentBalance < $amount) {
            return false;
        }
        $newBalance = $currentBalance - $amount;
    } else {
        return false;
    }
    $sql = sprintf(
        "UPDATE %s SET balance = ? WHERE %s = ?",
        static::$table,
        static::$primary_key
    );

    $stmt = static::$mysqli->prepare($sql);
    $stmt->bind_param("di", $newBalance, $this->{static::$primary_key});
    $success = $stmt->execute();

    if ($success) {
        $this->balance = $newBalance;
        return $this;
    } else {
        return false;
    }
}


}
