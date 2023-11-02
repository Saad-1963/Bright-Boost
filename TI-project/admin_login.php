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
$email = $_POST['email'];
$password = $_POST['password'];

// Retrieve the hashed password for the given email
$sql = "SELECT Password FROM Admins  WHERE Email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['Password'];

    // Verify the password
    if ($password === $hashed_password) {
        echo "Login successful!";
        header("Location: course.php");
        // Redirect to a student dashboard or another page
    } else {
        echo "Login failed. Incorrect email or password.";
    }
} else {
    echo "Login failed. Incorrect email or password.";
}

$conn->close();
?>
