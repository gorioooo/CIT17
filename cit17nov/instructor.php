<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Instructors</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>View Instructors</h2>

        <?php
        // Perform database operations
        $conn = new mysqli("localhost", "root", "", "prado");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get all instructors
        $instructorQuery = "SELECT * FROM Instructor";
        $instructorResult = $conn->query($instructorQuery);

        if ($instructorResult->num_rows > 0) {
            echo "<table class='table table-bordered text-center'>";
            echo "<thead>
                     <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Handled Courses</th>
                        <th>Action</th>
                     </tr>
                    </thead>";
            echo "<tbody>";

            while ($instructor = $instructorResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$instructor['first_name']}</td>";
                echo "<td>{$instructor['last_name']}</td>";

                // Get handled courses
                $handledCoursesQuery = "SELECT c.course_code, c.course_name
                                        FROM Instructor_Course ic
                                        JOIN Course c ON ic.course_id = c.course_id
                                        WHERE ic.instructor_id = {$instructor['instructor_id']}";

                $handledCoursesResult = $conn->query($handledCoursesQuery);

                echo "<td>";
                if ($handledCoursesResult->num_rows > 0) {
                    echo "<ul class='list-unstyled'>";
                    while ($row = $handledCoursesResult->fetch_assoc()) {
                        echo "<li>{$row['course_code']} - {$row['course_name']}</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "No handled courses";
                }
                echo "</td>";

                // Add Edit and Delete buttons
                echo "<td>
                        <a href='edit_instructor.php?instructor_id={$instructor['instructor_id']}' class='btn btn-warning'>Edit</a>
                        <a href='delete_instructor.php?instructor_id={$instructor['instructor_id']}' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this instructor?\");'>Delete</a>
                      </td>";

                echo "</tr>";
            }

            echo "</tbody></table>";
            echo "<a href='instructor_form.php' class='btn btn-primary mt-3'>Add New Instructor</a>";
        } else {
            echo "<p>No instructors found.</p>";
        }

        // Close the connection
        $conn->close();
        ?>
    </div>
</body>
</html>
