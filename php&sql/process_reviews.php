<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'ReviewSystem';

try {
    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        throw new Exception('Connection failed: ' . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $review = $conn->real_escape_string($_POST['review']);

        $sql = "INSERT INTO Reviews (name, email, review) VALUES ('$name', '$email', '$review')";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Thank you, $name! Your review has been submitted successfully.</p>";
        } else {
            throw new Exception('Error inserting data: ' . $conn->error);
        }
    }
} catch (Exception $e) {
    echo '<p>Error: ' . $e->getMessage() . '</p>';
} finally {
    $conn->close();
}
?>
