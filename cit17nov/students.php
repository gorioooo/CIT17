<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Students Information</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Student Information</h2>

        <?php
        // Fetch student data including enrolled courses
        $conn = new mysqli("localhost", "root", "", "prado");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $studentQuery = "SELECT student_id, first_name, last_name, birthdate, major FROM Student";
        $studentResult = $conn->query($studentQuery);

        if ($studentResult->num_rows > 0) {
            echo "<table class='table table-bordered text-center'>
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Birthdate</th>
                            <th>Major</th>
                            <th>Enrolled Courses</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            while ($studentRow = $studentResult->fetch_assoc()) {
                echo "<tr>
                        <td>{$studentRow['first_name']}</td>
                        <td>{$studentRow['last_name']}</td>
                        <td>{$studentRow['birthdate']}</td>
                        <td>{$studentRow['major']}</td>
                        <td>" . getEnrolledCourses($studentRow['student_id'], $conn) . "</td>
                        <td>
                            <a href='edit_student.php?student_id={$studentRow['student_id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='delete_student.php?student_id={$studentRow['student_id']}' class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                    </tr>";
            }
            
            echo "</tbody></table>";
            
        } else {
            echo "No students found.";
        }
        echo "<a href='student_form.php' class='btn btn-primary mt-3'>Add New Student</a>"; 

        function getEnrolledCourses($student_id, $conn) {
            $enrollmentQuery = "SELECT c.course_code, c.course_name
                                FROM Enrollment e
                                JOIN Course c ON e.course_id = c.course_id
                                WHERE e.student_id = $student_id";

            $enrollmentResult = $conn->query($enrollmentQuery);

            if ($enrollmentResult->num_rows > 0) {
                $courses = "";
                while ($row = $enrollmentResult->fetch_assoc()) {
                    $courses .= $row['course_code'] . " - " . $row['course_name'] . "<br>";
                }
                return $courses;
            } else {
                return "No enrolled courses";
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
