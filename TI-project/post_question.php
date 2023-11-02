<?php
session_start();
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted data
    $studentID = $_SESSION['student_id']; // Retrieve the student's ID from the session
    $courseID = $_POST['courseID'];
    $questionText = $_POST['question'];

    // Database connection setup
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'mysql';

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the question into the Question table
    $insertSql = "INSERT INTO Question (StudentID, CourseID, QuestionText) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertSql);

    if ($stmt) {
        $stmt->bind_param("iis", $studentID, $courseID, $questionText);
        $stmt->execute();
        $stmt->close();

        // Redirect to the page where students can ask questions
        header("Location: ask_question.php");
        exit;
    } else {
        echo "Error preparing the SQL statement: " . $conn->error;
    }

    $conn->close();
}
?>
