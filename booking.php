<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'movie_booking';

// Connect to database
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Functions
function getMovies() {
    $sql = "SELECT * FROM movies";
    $result = $conn->query($sql);
    $movies = array();
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }
    return $movies;
}

function getShowtimes($movie_id) {
    $sql = "SELECT * FROM showtimes WHERE movie_id = $movie_id";
    $result = $conn->query($sql);
    $showtimes = array();
    while ($row = $result->fetch_assoc()) {
        $showtimes[] = $row;
    }
    return $showtimes;
}

function bookSeat($showtime_id, $customer_name, $customer_email, $seats_booked) {
    $sql = "INSERT INTO bookings (showtime_id, customer_name, customer_email, seats_booked) VALUES ($showtime_id, '$customer_name', '$customer_email', $seats_booked)";
    $conn->query($sql);
}

// Actions
if (isset($_POST['book_seat'])) {
    bookSeat($_POST['showtime_id'], $_POST['customer_name'], $_POST['customer_email'], $_POST['seats_booked']);
    header('Location: index.html');
    exit;
}
?>