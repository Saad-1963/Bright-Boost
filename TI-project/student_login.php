<?php
// Database connection setup
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'mysql';
session_start();
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the form
$email = $_POST['email'];
$password = $_POST['password'];

// Retrieve the hashed password for the given email
$sql = "SELECT * FROM Students WHERE Email = '$email'";
$result = $conn->query($sql);
// $sql1 = "SELECT StudentID FROM Students WHERE Email = '$email'";
// $id = $conn->query($sql1);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['Password'];

    // Verify the password
    if (password_verify($password, $hashed_password)) {
        $_SESSION['student_id'] = $row['StudentID'];
        echo "Login successful!", $_SESSION['student_id'] ;
        header("Location: enroll.php");

        // Redirect to a student dashboard or another page
    } else {
        echo "Login failed. Incorrect email or password.";
        
    }
} else {
    echo "Login failed. Incorrect email or password.";
    
}

$conn->close();
?>
