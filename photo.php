<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/photo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Photographs</title>
    <style>
        /* Additional CSS styles for the gallery */
        .gallery {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin: 0 auto;
            background-color: var(--black);
            border-radius: 2rem;
        }

        .gallery a {
            height: 15rem;
            width: 20rem;
            margin: 1.2rem;
            border-radius: 0.3rem;
            overflow: hidden;
            box-shadow: 0 3px 5px var(--primary);
        }

        .gallery a img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gallery a img:hover {
            transform: scale(1.4);
        }

        /* Additional CSS styles for the table */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
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

    <h2>Photograph Gallery</h2>

    <div class="gallery">
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

        // Fetch data from the "photograph" table and display it in the gallery
        $query = "SELECT * FROM photograph";
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<a href='" . $row["image_path"] . "'><img src='" . $row["image_path"] . "' alt='" . $row["alt_text"] . "'></a>";
            }
        }
        ?>
    </div>

    <h2>Photograph Details</h2>

    <div class="project_details">
        <table>
            <tr>
                <th>ID</th>
                <th>Image Path</th>
                <th>Alt Text</th>
                <th>Action</th>
            </tr>
            <?php
            // Fetch data from the "photograph" table and display it in the table
            $query = "SELECT * FROM photograph";
            $result = $connection->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["image_path"] . "</td>";
                    echo "<td>" . $row["alt_text"] . "</td>";
                    echo "<td>
                            <form action='' method='post'>
                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                <button type='submit' name='delete_photo'>Delete</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </div>

    <h2>Add/Update Photograph</h2>
    <h3>Please provide the existing ID from the table to update a photograph.</h3>
    <form action="" method="post">
        <label for="id">ID:</label>
        <input type="text" name="id" required><br>

        <label for="image_path">Image Path:</label>
        <input type="text" name="image_path" required><br>

        <label for="alt_text">Alt Text:</label>
        <input type="text" name="alt_text" required><br>

        <input type="submit" name="add_photo" value="Add/Update Photograph">
    </form>

    <?php
    // Process the form data when the form is submitted
    if (isset($_POST['add_photo'])) {
        // Get data from the form
        $id = $_POST['id'];
        $image_path = $_POST['image_path'];
        $alt_text = $_POST['alt_text'];

        // Validate and sanitize the input
        $id = mysqli_real_escape_string($connection, $id);
        $image_path = mysqli_real_escape_string($connection, $image_path);
        $alt_text = mysqli_real_escape_string($connection, $alt_text);

        // Check if the ID already exists
        $existing_query = "SELECT * FROM photograph WHERE id = '$id'";
        $existing_result = $connection->query($existing_query);

        if ($existing_result->num_rows > 0) {
            // Update existing row
            $update_query = "UPDATE photograph SET 
                             image_path = '$image_path', 
                             alt_text = '$alt_text' 
                             WHERE id = '$id'";

            if ($connection->query($update_query) === TRUE) {
                echo "<p>Photograph updated successfully!</p>";
            } else {
                echo "Error updating photograph: " . $connection->error;
            }
        } else {
            // Add new row
            $add_query = "INSERT INTO photograph (id, image_path, alt_text) 
                          VALUES ('$id', '$image_path', '$alt_text')";

            if ($connection->query($add_query) === TRUE) {
                echo "<p>Photograph added successfully!</p>";
            } else {
                echo "Error adding photograph: " . $connection->error;
            }
        }
    }

    // Process the delete request
    if (isset($_POST['delete_photo'])) {
        // Get the photograph ID from the form
        $photoId = $_POST['id'];

        // Validate and sanitize the input
        $photoId = mysqli_real_escape_string($connection, $photoId);

        // Perform the delete operation
        $delete_query = "DELETE FROM photograph WHERE id = '$photoId'";

        if ($connection->query($delete_query) === TRUE) {
            echo "<p>Photograph deleted successfully!</p>";
        } else {
            echo "Error deleting photograph: " . $connection->error;
        }
    }

    // Close the database connection
    $connection->close();
    ?>
</body>

</html>
