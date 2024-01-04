<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform input validation as needed

    $student_id = $_POST["student_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $birthdate = $_POST["birthdate"];
    $major = $_POST["major"];

    // Perform database update for student details
    $conn = new mysqli("localhost", "root", "", "prado");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE Student
            SET first_name = '$first_name', last_name = '$last_name', birthdate = '$birthdate', major = '$major'
            WHERE student_id = $student_id";

    if ($conn->query($sql) !== TRUE) {
        echo "Error updating student details: " . $conn->error;
        $conn->close();
        exit;
    }

    // Perform database update for enrolled courses
    if (isset($_POST["courses"])) {
        $enrolledCourses = $_POST["courses"];
        // Delete existing enrollments for the student
        $deleteEnrollmentQuery = "DELETE FROM Enrollment WHERE student_id = $student_id";
        $conn->query($deleteEnrollmentQuery);

        // Insert new enrollments
        foreach ($enrolledCourses as $course_id) {
            $insertEnrollmentQuery = "INSERT INTO Enrollment (student_id, course_id) VALUES ($student_id, $course_id)";
            $conn->query($insertEnrollmentQuery);
        }
    }

    echo '<script>window.location.href="students.php"; alert("Student updated successfully");</script>';

    $conn->close();
}
?>
