<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add Course</h2>
        <form action="course_process.php" method="post">
            <label for="course_code">Course Code:</label>
            <input type="text" name="course_code" required>

            <label for="course_name">Course Name:</label>
            <input type="text" name="course_name" required>

            <button type="submit">Add Course</button>
        </form>
    </div>
</body>
</html>
