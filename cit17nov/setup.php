<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prado"; 

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db($dbname);

// Create Users table
$sql = "CREATE TABLE IF NOT EXISTS Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL
)";
$conn->query($sql);

// Create Course table
$sql = "CREATE TABLE IF NOT EXISTS Course (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_code VARCHAR(255) NOT NULL,
    course_name VARCHAR(255) NOT NULL
)";
$conn->query($sql);

// Create Student table
$sql = "CREATE TABLE IF NOT EXISTS Student (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    birthdate DATE NOT NULL,
    major VARCHAR(255)
)";
$conn->query($sql);

// Create Instructor table
$sql = "CREATE TABLE IF NOT EXISTS Instructor (
    instructor_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL
    -- Add other fields as needed
)";
$conn->query($sql);

// Create Enrollment table
$sql = "CREATE TABLE IF NOT EXISTS Enrollment (
    enrollment_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    course_id INT,
    FOREIGN KEY (student_id) REFERENCES Student(student_id),
    FOREIGN KEY (course_id) REFERENCES Course(course_id)
)";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS Instructor_Course (
    instructor_id INT,
    course_id INT,
    FOREIGN KEY (instructor_id) REFERENCES Instructor(instructor_id),
    FOREIGN KEY (course_id) REFERENCES Course(course_id)
)";
$conn->query($sql);


$conn->close();
?>
