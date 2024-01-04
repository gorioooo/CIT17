<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform input validation as needed

    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Perform database insertion
    $conn = new mysqli("localhost", "root", "", "prado");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO Users (username, password, role) VALUES ('$username', '$hashedPassword', '$role')";
    if ($conn->query($sql) === TRUE) {
        echo "User created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
