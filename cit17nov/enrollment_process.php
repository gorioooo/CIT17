<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform input validation as needed
    $student_name = $_POST["student_name"];
    $course_ids = $_POST["course_ids"];

    // Perform database operations
    $conn = new mysqli("localhost", "root", "", "prado");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Find the student ID based on the provided student name
    $studentQuery = "SELECT student_id FROM Student WHERE CONCAT(first_name, ' ', last_name) = '$student_name'";
    $studentResult = $conn->query($studentQuery);

    if ($studentResult->num_rows > 0) {
        $studentRow = $studentResult->fetch_assoc();
        $student_id = $studentRow["student_id"];

        // Now $student_id contains the ID of the student

        // Proceed with the enrollment process, insert records into the Enrollment table
        foreach ($course_ids as $course_id) {
            $enrollmentQuery = "INSERT INTO Enrollment (student_id, course_id) VALUES ('$student_id', '$course_id')";
            // Execute the query and handle errors as needed
            $conn->query($enrollmentQuery);
        }

        echo "Enrollment successful";
    } else {
        echo "Error: Student not found.";
    }

    $conn->close();
}
?>
