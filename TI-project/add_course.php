<?php
// Database connection setup
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'mysql';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $courseName = $_POST['courseName'];
    $tutorID = $_POST['tutorID'];

    // Insert the new course into the database
    $sql = "INSERT INTO Course (CourseName, TutorID) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $courseName, $tutorID);

    if ($stmt->execute()) {
        echo "Course added successfully!";
    } else {
        echo "Error adding the course: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
