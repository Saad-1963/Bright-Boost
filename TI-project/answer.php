<!DOCTYPE html>
<html>
<head>
    <title>Answer Questions</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

    <link rel="stylesheet" href="./css/style.css" />
    
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./css/dialog_box.css" />
</head>
<body>

    <header class="header d-flex items-center justify-spc-btw">
        <h2 class="logo text-white">Bright Boost</h2>
        <ul class="menu d-flex">
        <li><a href="Answer.php">Questions</a></li>
        <li><a href="session_tutor.html">Sessions</a></li>
        <li><a href="logout.php">Log Out</a></li>

        </ul>
      </header>


    <!-- Display already asked questions and their answers -->
    <h2>Student Questions</h2>

    <form action="answer.php" method="post">
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

            // Start the session to access the tutor's ID
            session_start();

            // Check if the tutor is logged in
            if (isset($_SESSION['tutor_id'])) {
                $tutorID = $_SESSION['tutor_id'];

                // Retrieve a list of courses the student has enrolled in and populate the options
                $coursesSql = "SELECT CourseName, CourseID FROM Course WHERE TutorID = $tutorID";

                $result = $conn->query($coursesSql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['CourseID'] . '">' . $row['CourseName'] . '</option>';
                    }
                }
            }

            $conn->close();
            ?>
        </select>
        <input type="submit" value="Filter">
    </form>

    <form action="post_answer.php" method="post">

        <table>
            <tr>
                <th>Course</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Write And Submit Answer</th>
            </tr>
            <?php
            // Retrieve and display questions and answers for the selected course
            if (isset($_SESSION['tutor_id'])) {
                $tutorID = $_SESSION['tutor_id'];

                // Database connection setup
                $host = 'localhost';
                $username = 'root';
                $password = '';
                $database = 'mysql';

                $conn = new mysqli($host, $username, $password, $database);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch the course IDs associated with the tutor
                $tutorCourseIDs = array();
                $query = "SELECT CourseID FROM Course WHERE TutorID = $tutorID";

                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $tutorCourseIDs[] = $row['CourseID'];
                    }
                }

                // Check if a course filter is selected
                $courseFilter = isset($_POST['courseFilter']) ? $_POST['courseFilter'] : '';

                // Modify your query based on the course filter and the tutor's course IDs
                $questionsSql = "SELECT Course.CourseName, Question.QuestionID, Question.QuestionText, Answer.AnswerText
                    FROM Question
                    LEFT JOIN Answer ON Question.QuestionID = Answer.QuestionID
                    LEFT JOIN Course ON Question.CourseID = Course.CourseID
                    WHERE Course.CourseID IN (" . implode(',', $tutorCourseIDs) . ")";

                if (!empty($courseFilter)) {
                    // If a course filter is selected, add it to the query
                    $questionsSql .= " AND Course.CourseID = $courseFilter";
                }

                // Execute the query and display the results
                $result = $conn->query($questionsSql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['CourseName'] . '</td>';
                        echo '<td>' . $row['QuestionText'] . '</td>';
                        echo '<input type="hidden" name="questionID" value="' . $row['QuestionID'] . '">';
                        echo '<td>' . ($row['AnswerText'] ? $row['AnswerText'] : 'Not answered yet') . '</td>';
                        // Add an input field for tutors to submit answers
                        echo '<td>';
                        echo '<textarea name="answer" placeholder="Your answer..."></textarea>';
                        echo '<input type="submit" name="submit[' . $row['QuestionID'] . ']" value="Submit Answer">';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">No questions found.</td></tr>';
                }

                $conn->close();
            }
            ?>
        </table>
    </form>
</body>
</html>
