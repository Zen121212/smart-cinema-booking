<?php
require_once("Model.php");

class UserPaymentMethod extends Model
{
    protected static string $primary_key = 'user_profile_id';
    private int $user_profile_id;
    private int $payment_method_id;
    protected static string $table = 'user_payment_methods';

    public function __construct(array $data)
    {
        $this->user_profile_id = $data['user_profile_id'] ?? null;
        $this->payment_method_id = $data['payment_method_id'] ?? null;
    }

    public function toArray()
    {
        return [
            'user_profile_id' => $this->user_profile_id,
            'payment_method_id' => $this->payment_method_id
        ];
    }

    public static function addPaymentMethodForUser($user_profile_id, array $payment_method_id)
    {
        foreach ($payment_method_id as $payment_id) {
            static::create([
                'user_profile_id' => $user_profile_id,
                'payment_method_id' => $payment_id
            ]);
        }
    }
}