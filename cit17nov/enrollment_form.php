<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Enroll in Courses</h2>

        <?php
        // Fetch available course codes
        $conn = new mysqli("localhost", "root", "", "prado");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $courseCodeQuery = "SELECT course_id, course_code, course_name FROM Course";
        $courseCodeResult = $conn->query($courseCodeQuery);
        ?>

        <form action="enrollment_process.php" method="post">
            <label for="student_name">Student Name:</label>
            <input type="text" name="student_name" required>

            <label>Select Courses:</label><br>
            <?php
            while ($row = $courseCodeResult->fetch_assoc()) {
                echo "<input type='checkbox' name='course_ids[]' value='" . $row['course_id'] . "'> " . $row['course_code'] . " - " . $row['course_name'] . "<br>";
            }
            ?>
            
            <!-- Add other enrollment fields as needed -->

            <button type="submit">Enroll</button>
        </form>

        <?php
        $conn->close();
        ?>
    </div>
</body>
</html>
