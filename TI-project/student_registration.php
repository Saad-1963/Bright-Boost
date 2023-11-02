<!-- $host = 'localhost';
$username = 'root';
$password = '';
$database = 'mysql'; -->





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
$school = " ";
$email = $_POST['email'];
$password = $_POST['password'];
$enrollment_status = " ";
$enrollment_year = 0;
$term = " ";

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// SQL query to insert data into the Students table, including the hashed password
$sql = "INSERT INTO Students (FirstName, LastName, School, Email, Password, EnrollmentStatus, EnrollmentYear, Term)
        VALUES ('$first_name', '$last_name', '$school', '$email', '$hashed_password', '$enrollment_status', $enrollment_year, '$term')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
    header("Location: student_login.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
