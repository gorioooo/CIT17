<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform input validation as needed

    $instructor_id = $_POST["instructor_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $handled_courses = isset($_POST["handled_courses"]) ? $_POST["handled_courses"] : [];

    // Perform database updates
    $conn = new mysqli("localhost", "root", "", "prado");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update instructor details
    $updateInstructorQuery = "UPDATE Instructor SET first_name='$first_name', last_name='$last_name' WHERE instructor_id=$instructor_id";

    if ($conn->query($updateInstructorQuery) === TRUE) {
        echo '<script>window.location.href="instructor.php"; alert("Instructor updated successfully");</script>';
    } else {
        echo "Error updating instructor details: " . $conn->error;
    }    

    // Update handled courses
    $deleteHandledCoursesQuery = "DELETE FROM Instructor_Course WHERE instructor_id=$instructor_id";
    $conn->query($deleteHandledCoursesQuery);

    if (!empty($handled_courses)) {
        foreach ($handled_courses as $course_id) {
            $insertHandledCourseQuery = "INSERT INTO Instructor_Course (instructor_id, course_id) VALUES ($instructor_id, $course_id)";
            $conn->query($insertHandledCourseQuery);
        }
    }

    $conn->close();
}
?>
