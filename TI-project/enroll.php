<!DOCTYPE html>
<html>
<head>
    <title>Student Enrollment</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

    <link rel="stylesheet" href="./css/style.css" />
    
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./css/dialog_box.css" />
</head>
<body>
<!-- Navigation bar -->
<header class="header d-flex items-center justify-spc-btw">
        <h2 class="logo text-white">Bright Boost</h2>
        <ul class="menu d-flex">
        <li><a href="enroll.php">Enrollment</a></li>
        <li><a href="ask_question.php">Ask Question</a></li>
        <li><a href="session_schedule.html">Sessions</a></li>
        <li><a href="logout.php">Log Out</a></li>

        </ul>
      </header>
</br>

    <h2>Student Enrollment</h2>
    <form action="course_enrollment.php" method="post">

    <label for="courseID">Select Course:</label>
    <select name="courseID" required onchange="updateTutorName(this)">
        <option value="">Select a course</option>
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

        // Retrieve course names and IDs along with the tutor's name
        $sql = "SELECT Course.CourseID, CourseName, CONCAT(Tutors.FirstName, ' ', Tutors.LastName) AS TutorName
                FROM Course
                JOIN Tutors ON Course.TutorID = Tutors.TutorID";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['CourseID'] . '" data-tutor="' . $row['TutorName'] . '">' . $row['CourseName'] . '</option>';
            }
        }

        $conn->close();
        ?>
    </select><br>

    <p id="tutorName">Tutor: </p>
    </br>
    <input type="submit" value="Enroll">
</form>

<script>
function updateTutorName(courseSelect) {
    const tutorNameElement = document.getElementById('tutorName');
    const selectedOption = courseSelect.options[courseSelect.selectedIndex];
    const tutorName = selectedOption.getAttribute('data-tutor');
    tutorNameElement.textContent = "Tutor: " + tutorName;
}
</script>
</br>


    <h3>Already Enrolled Courses</h3>
    <table>
        <thead>
            <tr>
                <th>Course ID</th>
                <th>Course Name</th>
                <th>Tutor Name</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Include your database connection code here
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

            // Retrieve already enrolled courses for the student
            $enrolledCoursesSql = "SELECT Course.CourseID, CourseName, CONCAT(Tutors.FirstName, ' ', Tutors.LastName) AS TutorName
            FROM Course
            JOIN Enrollment ON Course.CourseID = Enrollment.CourseID
            JOIN Tutors ON Course.TutorID = Tutors.TutorID
            WHERE Enrollment.StudentID = $studentID";
            
            $enrolledCoursesStmt = $conn->prepare($enrolledCoursesSql);
            // $enrolledCoursesStmt->bind_param("i", $studentID);
            $enrolledCoursesStmt->execute();
            $enrolledCoursesResult = $enrolledCoursesStmt->get_result();

            if ($enrolledCoursesResult->num_rows > 0) {
                while ($row = $enrolledCoursesResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['CourseID'] . "</td>";
                    echo "<td>" . $row['CourseName'] . "</td>";
                    echo "<td>" . $row['TutorName'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No courses enrolled yet.</td></tr>";
            }

            $enrolledCoursesStmt->close();
        } else {
            // Handle the case where the student is not logged in.
            echo "Student is not logged in. Redirect to the login page or display an error message.";
        }

        $conn->close();
        ?>
        </tbody>
    </table>



</body>
</html>
