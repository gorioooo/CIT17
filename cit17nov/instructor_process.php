<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform input validation as needed
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $handled_courses = isset($_POST["handled_courses"]) ? $_POST["handled_courses"] : [];

    // Perform database operations
    $conn = new mysqli("localhost", "root", "", "prado");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert instructor data into Instructor table
    $instructorQuery = "INSERT INTO Instructor (first_name, last_name) VALUES ('$first_name', '$last_name')";
    $conn->query($instructorQuery);

    // Get the instructor ID
    $instructor_id = $conn->insert_id;

    // Insert instructor-course relationship into Instructor_Course table
    foreach ($handled_courses as $course_id) {
        $relationshipQuery = "INSERT INTO Instructor_Course (instructor_id, course_id) VALUES ('$instructor_id', '$course_id')";
        $conn->query($relationshipQuery);
    }

    echo '<script>window.location.href="instructor.php"; alert("Instructor and courses added successfully.");</script>';
    $conn->close();
}
?>
