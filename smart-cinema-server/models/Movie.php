<?php
require_once("Model.php");

class Movie extends Model {
    protected int $id;
    private string $title;
    private string $description;
    private int $duration;
    private string $status;
    private string $release_date;
    protected static string $table = "movies";

    public function __construct(array $data) {
        $this->id = $data["id"];
        $this->title = $data["title"];
        $this->description = $data["description"];
        $this->duration = $data["duration"];
        $this->status = $data["status"];
        $this->release_date = $data["release_date"];
    }

    public function getId(): int {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getDuration(): int {
        return $this->duration;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getReleaseDate(): string {
        return $this->release_date;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setDuration(int $duration): void {
        $this->duration = $duration;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }

    public function setReleaseDate(string $release_date): void {
        $this->release_date = $release_date;
    }

    public function toArray(): array {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "duration" => $this->duration,
            "status" => $this->status,
            "release_date" => $this->release_date
        ];
    }
}