<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/editprojects.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Update/Delete Project</title>
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
</head>

<body>
    <div class="home">
        <a class="hme" href="index.php">Home</a>
    </div>

    <h2>Project Details</h2>

    <div class="project_details">
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image Path</th>
                <th>GitHub Link</th>
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

            // Fetch data from the "projects" table and display it in the table
            $query = "SELECT * FROM projects";
            $result = $connection->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "<td>" . $row["image_path"] . "</td>";
                    echo "<td>" . $row["github_link"] . "</td>";
                    echo "<td>
                            <form action='' method='post'>
                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                <button type='submit' name='delete_project'>Delete</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </div>

    <h2>Add/Update Project</h2>
    <h3>Please provide the existing ID from the table to update a project.</h3>
    <form action="" method="post">
        <label for="id">ID:</label>
        <input type="text" name="id" required><br>

        <label for="title">Title:</label>
        <input type="text" name="title" required><br>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br>

        <label for="image_path">Image Path:</label>
        <input type="text" name="image_path" required><br>

        <label for="github_link">GitHub Link:</label>
        <input type="text" name="github_link" required><br>

        <input type="submit" name="add_project" value="Add/Update Project">
    </form>

    <?php
    // Process the form data when the form is submitted
    if (isset($_POST['add_project'])) {
        // Get data from the form
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image_path = $_POST['image_path'];
        $github_link = $_POST['github_link'];

        // Validate and sanitize the input
        $id = mysqli_real_escape_string($connection, $id);
        $title = mysqli_real_escape_string($connection, $title);
        $description = mysqli_real_escape_string($connection, $description);
        $image_path = mysqli_real_escape_string($connection, $image_path);
        $github_link = mysqli_real_escape_string($connection, $github_link);

        // Check if the ID already exists
        $existing_query = "SELECT * FROM projects WHERE id = '$id'";
        $existing_result = $connection->query($existing_query);

        if ($existing_result->num_rows > 0) {
            // Update existing row
            $update_query = "UPDATE projects SET 
                             title = '$title', 
                             description = '$description', 
                             image_path = '$image_path', 
                             github_link = '$github_link' 
                             WHERE id = '$id'";

            if ($connection->query($update_query) === TRUE) {
                echo "<p>Project updated successfully!</p>";
            } else {
                echo "Error updating project: " . $connection->error;
            }
        } else {
            // Add new row
            $add_query = "INSERT INTO projects (id, title, description, image_path, github_link) 
                          VALUES ('$id', '$title', '$description', '$image_path', '$github_link')";

            if ($connection->query($add_query) === TRUE) {
                echo "<p>Project added successfully!</p>";
            } else {
                echo "Error adding project: " . $connection->error;
            }
        }
    }

    // Process the delete request
    if (isset($_POST['delete_project'])) {
        // Get the project ID from the form
        $projectId = $_POST['id'];

        // Validate and sanitize the input
        $projectId = mysqli_real_escape_string($connection, $projectId);

        // Perform the delete operation
        $delete_query = "DELETE FROM projects WHERE id = '$projectId'";

        if ($connection->query($delete_query) === TRUE) {
            echo "<p>Project deleted successfully!</p>";
        } else {
            echo "Error deleting project: " . $connection->error;
        }
    }

    // Close the database connection
    $connection->close();
    ?>
</body>

</html>
