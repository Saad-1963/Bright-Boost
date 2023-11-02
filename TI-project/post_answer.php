<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['questionID']) && isset($_POST['answer'])) {
        
        $tutorID = $_SESSION['tutor_id'];
        $questionID = $_POST['questionID'];
        $answer = $_POST['answer'];

        // Database connection setup
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'mysql';

        $conn = new mysqli($host, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Validate the input as needed

        // Insert the answer into the database
        $insertAnswerSql = "INSERT INTO Answer (TutorID, QuestionID, AnswerText) VALUES ($tutorID, $questionID, '$answer')";
        $conn->query($insertAnswerSql);

        // Close the database connection
        $conn->close();
    }

    // Redirect back to the previous page or any other appropriate action
    header("Location: answer.php");
}
?>
