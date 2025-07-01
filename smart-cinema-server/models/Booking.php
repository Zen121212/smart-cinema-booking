<?php
require_once("Model.php");

class Booking extends Model
{
    public int $id;
    public  int $user_id;
    public int $movie_id;
    public int $showtime_id;
    public int $seat_id;
    public float $total_price;
    public string $purchase_date;
    public string $booking_status;

    protected static string $table = "tickets";
    protected static string $primary_key = "id";

    public function __construct(array $data) {
        $this->id = $data["id"];
        $this->user_id = $data["user_id"];
        $this->movie_id = $data["movie_id"];
        $this->showtime_id = $data["showtime_id"];
        $this->seat_id = $data["seat_id"];
        $this->total_price = $data["total_price"];
        $this->purchase_date = $data["purchase_date"];
        $this->booking_status = $data["booking_status"];
    }
    public function toArray()
    {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "movie_id" => $this->movie_id,
            "showtime_id" => $this->showtime_id,
            "seat_id" => $this->seat_id,
            "total_price" => $this->total_price,
            "purchase_date" => $this->purchase_date,
            "booking_status" => $this->booking_status,
        ];
    }

    public static function checkReservation($showtimeId,$seatId)
    {
        $sql = "SELECT COUNT(*) as cnt FROM tickets WHERE showtime_id = ? AND seat_id = ?";
        $stmt = static::$mysqli->prepare($sql);
        $stmt->bind_param("ii", $showtimeId, $seatId);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();

        if ($result['cnt'] > 0) {
            echo json_encode([
                "error" => "This seat is already booked for that showtime."
            ]);
            exit;
        }
    }
    public function updateStatus($newStatus)
    {
        $sql = "UPDATE " . static::$table . " SET booking_status = ? WHERE id = ?";
        $stmt = static::$mysqli->prepare($sql);
        $stmt->bind_param("si", $newStatus, $this->id);
        $success = $stmt->execute();

        if ($success) {
            $this->booking_status = $newStatus;
            return $this;
        } else {
            return false;
        }
    }
        public static function getAllReservedSeats()
    {
        $sql = "SELECT showtime_id, seat_id FROM tickets";
        $stmt = static::$mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = [
                "showtime_id" => (int)$row['showtime_id'],
                "seat_id" => (int)$row['seat_id']
            ];
        }

        return $data;
    }
}
