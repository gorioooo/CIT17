<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform input validation as needed

    $course_name = $_POST["course_name"];
    $course_code = $_POST["course_code"];

    // Perform database insertion
    $conn = new mysqli("localhost", "root", "", "prado");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO Course (course_code, course_name) VALUES ('$course_code', '$course_name')";
    if ($conn->query($sql) === TRUE) {
        echo "Course added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
