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

// Retrieve data from the form
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$expertise_area = " ";
$email = $_POST['email'];
$password = $_POST['password'];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// SQL query to insert data into the Tutors table, including the hashed password
$sql = "INSERT INTO Tutors (FirstName, LastName, ExpertiseArea, Email, Password)
        VALUES ('$first_name', '$last_name', '$expertise_area', '$email', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
    header("Location: tutor_login.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
