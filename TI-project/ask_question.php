<!DOCTYPE html>
<html>
<head>

    <title>Ask Question</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

    <link rel="stylesheet" href="./css/style.css" />
    
    <link rel="stylesheet" href="./css/header.css" />

    <link rel="stylesheet" href="./css/dialog_box.css" />
</head>
<body>

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
    <h2>Ask Question</h2>
    </br>
    <form action="post_question.php" method="post">
        <label for="courseID">Select Course:</label>
        <select name="courseID" required>
        </br>
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

            // Start the session to access the student's ID
            session_start();

            // Check if the student is logged in
            if (isset($_SESSION['student_id'])) {
                $studentID = $_SESSION['student_id'];

                // Retrieve enrolled courses for the student
                $enrolledCoursesSql = "SELECT Course.CourseID, CourseName
                    FROM Course
                    JOIN Enrollment ON Course.CourseID = Enrollment.CourseID
                    WHERE Enrollment.StudentID = $studentID";

                $result = $conn->query($enrolledCoursesSql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['CourseID'] . '">' . $row['CourseName'] . '</option>';
                    }
                }
            }

            $conn->close();
            ?>
        </select><br>

        <label for="question">Ask a Question:</label>
        <textarea name="question" required></textarea><br>
        </br>
        <input type="submit" value="Submit Question">
    </form>
    </br>
    <!-- Display already asked questions and their answers -->
    <h2>Previous Asked Questions</h2>
    </br>
<form action="ask_question.php" method="post">
    <label for="courseFilter">Filter by Course:</label>
    <select name="courseFilter">
        <option value="">All Courses</option>
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
            $studentID = $_SESSION['student_id'];

            // Retrieve a list of courses the student has enrolled in and populate the options
            $coursesSql = "SELECT DISTINCT Course.CourseName
                FROM Course
                JOIN Enrollment ON Course.CourseID = Enrollment.CourseID
                WHERE Enrollment.StudentID = $studentID";

            $result = $conn->query($coursesSql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['CourseName'] . '">' . $row['CourseName'] . '</option>';
                }
            }
        }

        $conn->close();
        ?>
    </select>
    <input type="submit" value="Filter">
</form>

<table>
    <tr>
        <th>Course</th>
        <th>Question</th>
        <th>Answer</th>
    </tr>
    <?php
    // Retrieve and display questions and answers for the selected course
    if (isset($_SESSION['student_id'])) {
        $studentID = $_SESSION['student_id'];

        // Database connection setup
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'mysql';

        $conn = new mysqli($host, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if a course filter is selected
        $courseFilter = isset($_POST['courseFilter']) ? $_POST['courseFilter'] : '';

        // Modify your query based on the course filter
        $questionsSql = "SELECT Course.CourseName, Question.QuestionText, Answer.AnswerText
            FROM Question
            LEFT JOIN Answer ON Question.QuestionID = Answer.QuestionID
            LEFT JOIN Course ON Question.CourseID = Course.CourseID
            WHERE Question.StudentID = $studentID";

        if (!empty($courseFilter)) {
            // If a course filter is selected, add it to the query
            $questionsSql .= " AND Course.CourseName = '$courseFilter'";
        }

        $result = $conn->query($questionsSql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['CourseName'] . '</td>';
                echo '<td>' . $row['QuestionText'] . '</td>';
                echo '<td>' . ($row['AnswerText'] ? $row['AnswerText'] : 'Not answered yet') . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="3">No questions found.</td></tr>';
        }

        $conn->close();
    }
    ?>
</table>
</body>
</html>
