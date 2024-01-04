<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5 d-flex flex-column">
        <h2>Add Student</h2>
        <form class="d-flex flex-column" action="student_process.php" method="post">
            <div class="pb-2">
                <label for="first_name">First Name:</label>
                <input class="w-50 d-flex flex-column" type="text" name="first_name" required>
            </div>

            <div class="pb-2">
                <label for="last_name">Last Name:</label>
                <input class="w-50 d-flex flex-column" type="text" name="last_name" required>
            </div>

            <div class="pb-2">
                <label for="birthdate">Birthdate:</label>
                <input class="w-50 d-flex flex-column" type="date" name="birthdate" required>
            </div>

            <div class="pb-2">
                <label for="major">Major:</label>
                <select class="w-50 d-flex flex-column form-control" name="major" required>
                    <option value="Web Development">Web Development</option>
                    <option value="Network and Security">Network and Security</option>
                    <option value="Enterprise">Enterprise</option>
                    <option value="Multimedia">Multimedia</option>
                </select>
            </div>

            <div class='pt-5'>
            <button class="w-10 d-flex flex-column btn btn-primary" type="submit">Add Student</button>
            </div>
        </form>
    </div>
</body>
</html>
