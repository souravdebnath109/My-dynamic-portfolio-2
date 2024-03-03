<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/editprojects.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services</title>
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

    <h2>Service Details</h2>

    <div class="project_details">
        <table>
            <tr>
                <th>ID</th>
                <th>Icon</th>
                <th>Title</th>
                <th>Description</th>
                <th>Link</th>
                <th>Background Color</th>
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

            // Fetch data from the "services" table and display it in the table
            $query = "SELECT * FROM services";
            $result = $connection->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo '<td><i class="fas ' . $row["icon"] . '"></i></td>';
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo '<td><a href="' . $row["link"] . '">Learn More</a></td>';
                    echo '<td style="background-color: ' . $row["background_color"] . '"></td>';
                    echo "<td>
                            <form action='' method='post'>
                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                <button type='submit' name='delete_service'>Delete</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </div>

    <h2>Add/Update Service</h2>
    <h3>Please provide the existing ID from the table to update a service.</h3>
    <form action="" method="post">
        <label for="id">ID:</label>
        <input type="text" name="id" required><br>

        <label for="icon">Icon:</label>
        <input type="text" name="icon" required><br>

        <label for="title">Title:</label>
        <input type="text" name="title" required><br>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br>

        <label for="link">Link:</label>
        <input type="text" name="link" required><br>

        <label for="background_color">Background Color:</label>
        <input type="text" name="background_color" required><br>

        <input type="submit" name="add_service" value="Add/Update Service">
    </form>

    <?php
    // Process the form data when the form is submitted
    if (isset($_POST['add_service'])) {
        // Get data from the form
        $id = $_POST['id'];
        $icon = $_POST['icon'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $link = $_POST['link'];
        $background_color = $_POST['background_color'];

        // Validate and sanitize the input
        $id = mysqli_real_escape_string($connection, $id);
        $icon = mysqli_real_escape_string($connection, $icon);
        $title = mysqli_real_escape_string($connection, $title);
        $description = mysqli_real_escape_string($connection, $description);
        $link = mysqli_real_escape_string($connection, $link);
        $background_color = mysqli_real_escape_string($connection, $background_color);

        // Check if the ID already exists
        $existing_query = "SELECT * FROM services WHERE id = '$id'";
        $existing_result = $connection->query($existing_query);

        if ($existing_result->num_rows > 0) {
            // Update existing row
            $update_query = "UPDATE services SET 
                             icon = '$icon', 
                             title = '$title', 
                             description = '$description', 
                             link = '$link', 
                             background_color = '$background_color' 
                             WHERE id = '$id'";

            if ($connection->query($update_query) === TRUE) {
                echo "<p>Service updated successfully!</p>";
            } else {
                echo "Error updating service: " . $connection->error;
            }
        } else {
            // Add new row
            $add_query = "INSERT INTO services (id, icon, title, description, link, background_color) 
                          VALUES ('$id', '$icon', '$title', '$description', '$link', '$background_color')";

            if ($connection->query($add_query) === TRUE) {
                echo "<p>Service added successfully!</p>";
            } else {
                echo "Error adding service: " . $connection->error;
            }
        }
    }

    // Process the delete request
    if (isset($_POST['delete_service'])) {
        // Get the service ID from the form
        $serviceId = $_POST['id'];

        // Validate and sanitize the input
        $serviceId = mysqli_real_escape_string($connection, $serviceId);

        // Perform the delete operation
        $delete_query = "DELETE FROM services WHERE id = '$serviceId'";

        if ($connection->query($delete_query) === TRUE) {
            echo "<p>Service deleted successfully!</p>";
        } else {
            echo "Error deleting service: " . $connection->error;
        }
    }

    // Close the database connection
    $connection->close();
    ?>
</body>

</html>
