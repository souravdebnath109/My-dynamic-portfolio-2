<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/editcourse.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="aud">Add/Update/Delete Course</title>
</head>

<body>
    <div class="home">
        <a class="hme" href="index.php">Home</a>
    </div>

    <h2>Course Details</h2>

    <div class="course_details">
    <style>
        /* Additional CSS styles for the table */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image Path</th>
                <th>Internet Link</th>
                <th>Action</th>
            </tr>
            <?php
            // Step 1: Connect to the "web" database
            $servername = "localhost";
            $db_username = "root";
            $db_password = "";
            $dbname = "web";

            $connection = new mysqli($servername, $db_username, $db_password, $dbname);

            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            // Fetch data from the "courses" table and display it in the table
            $query = "SELECT * FROM courses";
            $result = $connection->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "<td>" . $row["image_path"] . "</td>";
                    echo "<td>" . $row["internet_link"] . "</td>";
                    echo "<td>
                            <form action='' method='post'>
                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                <button type='submit' name='delete_course'>Delete</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </div>

    <h2>Add/Update Course</h2>
    <h3 class="cntr" >please ,Provide the existing ID from the table to update a course.</h3>
    <form action="" method="post">
        <label for="id">ID:</label>
        <input type="text" name="id" required><br>

        <label for="title">Title:</label>
        <input type="text" name="title" required><br>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br>

        <label for="image_path">Image Path:</label>
        <input type="text" name="image_path" required><br>

        <label for="internet_link">Internet Link:</label>
        <input type="text" name="internet_link" required><br>

        <input type="submit" name="add_course" value="Add/Update Course">
    </form>

    <?php
    // Process the form data when the form is submitted
    if (isset($_POST['add_course'])) {
        // Get data from the form
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image_path = $_POST['image_path'];
        $internet_link = $_POST['internet_link'];

        // Validate and sanitize the input
        $id = mysqli_real_escape_string($connection, $id);
        $title = mysqli_real_escape_string($connection, $title);
        $description = mysqli_real_escape_string($connection, $description);
        $image_path = mysqli_real_escape_string($connection, $image_path);
        $internet_link = mysqli_real_escape_string($connection, $internet_link);

        // Check if the ID already exists
        $existing_query = "SELECT * FROM courses WHERE id = '$id'";
        $existing_result = $connection->query($existing_query);

        if ($existing_result->num_rows > 0) {
            // Update existing row
            $update_query = "UPDATE courses SET 
                             title = '$title', 
                             description = '$description', 
                             image_path = '$image_path', 
                             internet_link = '$internet_link' 
                             WHERE id = '$id'";

            if ($connection->query($update_query) === TRUE) {
                echo "<p>Course updated successfully!</p>";
            } else {
                echo "Error updating course: " . $connection->error;
            }
        } else {
            // Add new row
            $add_query = "INSERT INTO courses (id, title, description, image_path, internet_link) 
                          VALUES ('$id', '$title', '$description', '$image_path', '$internet_link')";

            if ($connection->query($add_query) === TRUE) {
                echo "<p>Course added successfully!</p>";
            } else {
                echo "Error adding course: " . $connection->error;
            }
        }
    }

    // Process the delete request
    if (isset($_POST['delete_course'])) {
        // Get the course ID from the form
        $courseId = $_POST['id'];

        // Validate and sanitize the input
        $courseId = mysqli_real_escape_string($connection, $courseId);

        // Perform the delete operation
        $delete_query = "DELETE FROM courses WHERE id = '$courseId'";

        if ($connection->query($delete_query) === TRUE) {
            echo "<p>Course deleted successfully!</p>";
        } else {
            echo "Error deleting course: " . $connection->error;
        }
    }

    // Close the database connection
    $connection->close();
    ?>
</body>

</html>
