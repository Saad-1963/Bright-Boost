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

// Start the session to access the student's ID
session_start();

// Check if the student is logged in
if (isset($_SESSION['student_id'])) {
    // Retrieve the student's ID from the session
    $studentID = $_SESSION['student_id'];

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve data from the form
        $courseID = $_POST['courseID'];

        // Check if the student is already enrolled in the selected course
        $checkSql = "SELECT * FROM Enrollment WHERE StudentID = ? AND CourseID = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("ii", $studentID, $courseID);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows == 0) {
            // The student is not enrolled in the course, so proceed with enrollment
            $enrollSql = "INSERT INTO Enrollment (StudentID, CourseID) VALUES (?, ?)";
            $enrollStmt = $conn->prepare($enrollSql);
            $enrollStmt->bind_param("ii", $studentID, $courseID);

            if ($enrollStmt->execute()) {
                echo "Enrollment successful!";
                header("Location: enroll.php");
            } else {
                echo "Error enrolling in the course: " . $enrollStmt->error;
            }

            $enrollStmt->close();
        } else {
            echo "Enrollment failed. The student is already enrolled in the selected course.";
        }

        $checkStmt->close();
    }

    // Retrieve the list of courses already enrolled by the student
    $enrolledCoursesSql = "SELECT CourseName FROM Course 
                            JOIN Enrollment ON Course.CourseID = Enrollment.CourseID
                            WHERE Enrollment.StudentID = ?";
    $enrolledCoursesStmt = $conn->prepare($enrolledCoursesSql);
    $enrolledCoursesStmt->bind_param("i", $studentID);
    $enrolledCoursesStmt->execute();
    $enrolledCoursesResult = $enrolledCoursesStmt->get_result();
    
    if ($enrolledCoursesResult->num_rows > 0) {
        echo "<h3>Enrolled Courses:</h3>";
        while ($row = $enrolledCoursesResult->fetch_assoc()) {
            echo $row['CourseName'] . "<br>";
        }
    }

    $enrolledCoursesStmt->close();
} else {
    // Handle the case where the student is not logged in.
    echo "Student is not logged in. Redirect to the login page or display an error message.";
}

$conn->close();
?>
