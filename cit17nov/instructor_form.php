<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add Instructor</h2>
        <form action="instructor_process.php" method="post">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" required>

            <!-- Add other instructor fields as needed -->

            <label for="handled_courses">Handled Courses:</label><br>
            <?php
            // Fetch courses from the Course table
            $conn = new mysqli("localhost", "root", "", "prado");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $coursesQuery = "SELECT course_id, course_code, course_name FROM Course";
            $coursesResult = $conn->query($coursesQuery);

            if ($coursesResult->num_rows > 0) {
                while ($course = $coursesResult->fetch_assoc()) {
                    echo "<input type='checkbox' name='handled_courses[]' value='{$course['course_id']}'> {$course['course_code']} - {$course['course_name']}<br>";
                }
            }

            $conn->close();
            ?>

            <button type="submit">Add Instructor</button>
        </form>
    </div>
</body>
</html>
