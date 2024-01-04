<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Welcome to the Student Information System</h1>
        <p>Choose an action to perform:</p>

        <ul>
            <li><a href="students.php">View Students</a></li>
            <li><a href="instructor.php">View Instructors</a></li>
            <li><a href="user_form.php">Add User</a></li>
            <li><a href="course_form.php">Add Course</a></li>
            <li><a href="enrollment_form.php">Enroll Student in Course</a></li>
        </ul>

        <hr>

        <!-- Add button to navigate to the setup page -->
        <form action="setup.php" method="get">
            <button type="submit">Setup Database</button>
        </form>
    </div>
</body>
</html>
