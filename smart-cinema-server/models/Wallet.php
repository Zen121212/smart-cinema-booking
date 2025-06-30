<?php

require_once("Model.php");
class Wallet extends Model
{
    public int $id;
    public int $user_id;
    public float $balance;
    public string $currency;

    protected static string $table = 'wallets';
    protected static string $primary_key = "user_id";

    public function __construct(array $data) {
        $this->user_id = $data['user_id'];
        $this->balance = $data['balance'];
        $this->currency = $data['currency'];

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
