<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Edit Student</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Student</h2>

        <?php
        // Connect to the database
        $conn = new mysqli("localhost", "root", "", "prado");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the student ID is provided in the URL
        if (isset($_GET['student_id'])) {
            $student_id = $_GET['student_id'];

            // Fetch the student details from the database
            $studentQuery = "SELECT * FROM Student WHERE student_id = $student_id";
            $studentResult = $conn->query($studentQuery);

            if ($studentResult->num_rows > 0) {
                $student = $studentResult->fetch_assoc();
                ?>
                <form action="update_student.php" method="post">
                    <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">

                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" value="<?php echo $student['first_name']; ?>" required>

                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" value="<?php echo $student['last_name']; ?>" required>

                    <label for="birthdate">Birthdate:</label>
                    <input type="date" name="birthdate" value="<?php echo $student['birthdate']; ?>" required>

                    <label for="major">Major:</label>
                    <select name="major" required>
                        <option value="Web Development" <?php echo ($student['major'] == 'Web Development') ? 'selected' : ''; ?>>Web Development</option>
                        <option value="Network and Security" <?php echo ($student['major'] == 'Network and Security') ? 'selected' : ''; ?>>Network and Security</option>
                        <option value="Enterprise" <?php echo ($student['major'] == 'Enterprise') ? 'selected' : ''; ?>>Enterprise</option>
                        <option value="Multimedia" <?php echo ($student['major'] == 'Multimedia') ? 'selected' : ''; ?>>Multimedia</option>
                    </select>

                    <hr>

                    <h4>Enrolled Courses:</h4>

                    <?php
                    // Fetch all available courses
                    $courseQuery = "SELECT course_id, course_code, course_name FROM Course";
                    $courseResult = $conn->query($courseQuery);

                    if ($courseResult->num_rows > 0) {
                        while ($course = $courseResult->fetch_assoc()) {
                            $isChecked = isCourseEnrolled($student_id, $course['course_id'], $conn) ? 'checked' : '';
                            echo "<div class='form-check'>
                                    <input class='form-check-input' type='checkbox' name='courses[]' value='{$course['course_id']}' $isChecked>
                                    <label class='form-check-label'>{$course['course_code']} - {$course['course_name']}</label>
                                  </div>";
                        }
                    } else {
                        echo "No courses found.";
                    }
                    ?>

                    <button type="submit" class="btn btn-primary mt-3">Update Student</button>
                </form>
                <?php
            } else {
                echo "Student not found.";
            }
        } else {
            echo "Student ID not provided.";
        }

        // Close the database connection
        $conn->close();

        function isCourseEnrolled($student_id, $course_id, $conn) {
            // Check if the student is enrolled in the given course
            $enrollmentQuery = "SELECT * FROM Enrollment WHERE student_id = $student_id AND course_id = $course_id";
            $enrollmentResult = $conn->query($enrollmentQuery);

            return $enrollmentResult->num_rows > 0;
        }
        ?>
    </div>
</body>
</html>
