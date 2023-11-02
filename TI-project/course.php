<!DOCTYPE html>
<html>
<head>
    <title>Add New Course</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

    <link rel="stylesheet" href="./css/style.css" />
    
    <link rel="stylesheet" href="./css/header.css" />
    <link rel="stylesheet" href="./css/dialog_box.css" />
</head>
<body>
        <header class="header d-flex items-center justify-spc-btw">
        <h2 class="logo text-white">Bright Boost</h2>
        <ul class="menu d-flex">
        <li><a href="course.php">Add New Course</a></li>
        <li><a href="session_management.html">Session Management</a></li>
        <li><a href="logout.php">Log Out</a></li>
        

        </ul>
      </header>
</br>
    <h2>Add New Course</h2>
    <form action="add_course.php" method="post">
        <label for="courseName">Course Name:</label>
        <input type="text" name="courseName" required><br>

        <label for="tutorID">Select Tutor:</label>
        <select name="tutorID" required>
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

            // Retrieve tutor names and IDs
            $sql = "SELECT TutorID, CONCAT(FirstName, ' ', LastName) AS TutorName FROM Tutors";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['TutorID'] . '">' . $row['TutorName'] . '</option>';
                }
            }

            $conn->close();
            ?>
        </select><br>

        <input type="submit" value="Add Course">
    </form>
</body>
</html>
