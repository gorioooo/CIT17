<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if the student ID is provided in the URL
    if (isset($_GET['student_id'])) {
        $student_id = $_GET['student_id'];

        // Perform database deletion of corresponding enrollments
        $conn = new mysqli("localhost", "root", "", "prado");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Delete enrollments first
        $enrollmentDeleteQuery = "DELETE FROM enrollment WHERE student_id = $student_id";
        $conn->query($enrollmentDeleteQuery);

        // Delete the student
        $studentDeleteQuery = "DELETE FROM Student WHERE student_id = $student_id";
        if ($conn->query($studentDeleteQuery) === TRUE) {
            echo '<script>window.location.href="students.php"; alert("Student Deleted successfully");</script>';
        } else {
            echo "Error deleting student: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Student ID not provided.";
    }
}
?>
