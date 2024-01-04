<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Edit Instructor</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Instructor</h2>

        <?php
        // Perform database operations
        $conn = new mysqli("localhost", "root", "", "prado");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the instructor ID is provided in the URL
        if (isset($_GET['instructor_id'])) {
            $instructor_id = $_GET['instructor_id'];

            // Fetch the instructor details from the database
            $instructorQuery = "SELECT * FROM Instructor WHERE instructor_id = $instructor_id";
            $instructorResult = $conn->query($instructorQuery);

            if ($instructorResult->num_rows > 0) {
                $instructor = $instructorResult->fetch_assoc();

                // Fetch the courses handled by the instructor
                $handledCoursesQuery = "SELECT c.course_id, c.course_code, c.course_name
                                        FROM Instructor_Course ic
                                        JOIN Course c ON ic.course_id = c.course_id
                                        WHERE ic.instructor_id = $instructor_id";

                $handledCoursesResult = $conn->query($handledCoursesQuery);
                $handledCourseIds = [];

                if ($handledCoursesResult->num_rows > 0) {
                    while ($row = $handledCoursesResult->fetch_assoc()) {
                        $handledCourseIds[] = $row['course_id'];
                    }
                }
                ?>
                <form action="update_instructor.php" method="post">
                    <input type="hidden" name="instructor_id" value="<?php echo $instructor['instructor_id']; ?>">

                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" value="<?php echo $instructor['first_name']; ?>" required>

                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" value="<?php echo $instructor['last_name']; ?>" required>

                    <!-- Add other instructor fields as needed -->

                    <label>Handled Courses:</label><br>
                    <?php
                    $coursesQuery = "SELECT course_id, course_code, course_name FROM Course";
                    $coursesResult = $conn->query($coursesQuery);

                    if ($coursesResult->num_rows > 0) {
                        while ($course = $coursesResult->fetch_assoc()) {
                            $checked = in_array($course['course_id'], $handledCourseIds) ? "checked" : "";
                            echo "<input type='checkbox' name='handled_courses[]' value='{$course['course_id']}' $checked> {$course['course_code']} - {$course['course_name']}<br>";
                        }
                    }
                    ?>

                    <button type="submit" class="btn btn-primary mt-3">Update Instructor</button>
                </form>
                <?php
            } else {
                echo "Instructor not found.";
            }
        } else {
            echo "Instructor ID not provided.";
        }

        // Close the connection
        $conn->close();
        ?>
    </div>
</body>
</html>
