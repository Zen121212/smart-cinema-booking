<?php
require("../connection/connection.php");

$movies = [
    ['title' => 'The Matrix', 'description' => 'A computer programmer fights an underground war...', 'release_date' => '1999-03-31', 'duration' => 136, 'status' => 'coming_soon'],
    ['title' => 'Inception', 'description' => 'A thief who steals corporate secrets...', 'release_date' => '2010-07-16', 'duration' => 148, 'status' => 'coming_soon'],
    ['title' => 'Interstellar', 'description' => 'A team of explorers travel through a wormhole...', 'release_date' => '2014-11-07', 'duration' => 169, 'status' => 'coming_soon'],
    ['title' => 'Avengers: Endgame', 'description' => 'After the devastating events of Avengers: Infinity War...', 'release_date' => '2019-04-26', 'duration' => 181, 'status' => 'coming_soon'],
    ['title' => 'The Dark Knight', 'description' => 'When the menace known as the Joker wreaks havoc...', 'release_date' => '2008-07-18', 'duration' => 152, 'status' => 'coming_soon'],
    ['title' => 'Titanic', 'description' => 'A seventeen-year-old aristocrat falls in love...', 'release_date' => '1997-12-19', 'duration' => 195, 'status' => 'on_showtime'],
    ['title' => 'Jurassic Park', 'description' => 'During a preview tour, a theme park suffers a major power breakdown...', 'release_date' => '1993-06-11', 'duration' => 127, 'status' => 'on_showtime'],
    ['title' => 'Frozen', 'description' => 'When the newly crowned Queen Elsa accidentally uses her power...', 'release_date' => '2013-11-27', 'duration' => 102, 'status' => 'on_showtime'],
    ['title' => 'The Lion King', 'description' => 'Lion prince Simba and his father are targeted...', 'release_date' => '1994-06-24', 'duration' => 88, 'status' => 'on_showtime'],
    ['title' => 'Star Wars: A New Hope', 'description' => 'Luke Skywalker joins forces with a Jedi Knight...', 'release_date' => '1977-05-25', 'duration' => 121, 'status' => 'on_showtime'],
];

foreach ($movies as $movie) {
    $stmt = $conn->prepare("INSERT INTO movies (title, description, release_date, duration, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssds", $movie['title'], $movie['description'], $movie['release_date'], $movie['duration'], $movie['status']);
    $stmt->execute();
}

$genres = [
    "Action", "Comedy", "Drama", "Horror", "Science Fiction", "Romance",
    "Documentary", "Thriller", "Animation", "Adventure", "Fantasy"
];

foreach ($genres as $index => $genre) {
    $stmt = $conn->prepare("INSERT INTO genres (genre_id, name) VALUES (?, ?)");
    $genre_id = $index + 1;
    $stmt->bind_param("is", $genre_id, $genre);
    $stmt->execute();
}

$payment_methods = [
    "Visa", "MasterCard", "American Express", "Discover", "PayPal", "Apple Pay", "Google Pay"
];

foreach ($payment_methods as $index => $method) {
    $stmt = $conn->prepare("INSERT INTO payments_methods (payment_method_id, method_name) VALUES (?, ?)");
    $method_id = $index + 1;
    $stmt->bind_param("is", $method_id, $method);
    $stmt->execute();
}

$roles = ["admin", "customer"];

// Insert roles
foreach ($roles as $index => $role) {
    $stmt = $conn->prepare("INSERT INTO roles (id, name) VALUES (?, ?)");
    $role_id = $index + 1;
    $stmt->bind_param("is", $role_id, $role);
    $stmt->execute();
}

echo "Seeding complete!";

$conn->close();
