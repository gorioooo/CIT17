<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform input validation as needed

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $birthdate = $_POST["birthdate"];
    $major = $_POST["major"];

    // Perform database insertion
    $conn = new mysqli("localhost", "root", "", "prado");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO Student (first_name, last_name, birthdate, major) VALUES ('$first_name', '$last_name', '$birthdate', '$major')";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Student added successfully")</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
