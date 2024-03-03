<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/timeline.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Update/Delete Timeline Event</title>
    <style>
        /* Add your additional CSS styles here */
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

    <h2>Timeline Events</h2>

    <div class="timeline_events">
        <table>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Event Title</th>
                <th>Event Description</th>
                <th>Action</th>
            </tr>
            <?php
            $servername = "localhost";
            $db_username = "root";
            $db_password = "";
            $dbname = "web";

            $connection = new mysqli($servername, $db_username, $db_password, $dbname);

            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            // Fetch data from the "timeline" table and display it in the table
            $query = "SELECT * FROM timeline";
            $result = $connection->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td>" . $row["event_title"] . "</td>";
                    echo "<td>" . $row["event_description"] . "</td>";
                    echo "<td>
                            <form action='' method='post'>
                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                <button type='submit' name='edit_event'>Edit</button>
                                <button type='submit' name='delete_event'>Delete</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>

        <h2>Add/Update Timeline Event</h2>
        <h3>Please provide the existing ID from the table to update a timeline event.</h3>
        <form action="" method="post">
            <label for="id">ID:</label>
            <input type="text" name="id" required><br>

            <label for="date">Date:</label>
            <input type="text" name="date" required><br>

            <label for="event_title">Event Title:</label>
            <input type="text" name="event_title" required><br>

            <label for="event_description">Event Description:</label>
            <textarea name="event_description" required></textarea><br>

            <?php
            if (isset($_POST['edit_event'])) {
                // Populate form fields with existing data for editing
                $editId = $_POST['id'];
                $editQuery = "SELECT * FROM timeline WHERE id = '$editId'";
                $editResult = $connection->query($editQuery);

                if ($editResult->num_rows > 0) {
                    $editData = $editResult->fetch_assoc();
                    echo "<script>
                            document.getElementsByName('id')[0].value = '" . $editData['id'] . "';
                            document.getElementsByName('date')[0].value = '" . $editData['date'] . "';
                            document.getElementsByName('event_title')[0].value = '" . $editData['event_title'] . "';
                            document.getElementsByName('event_description')[0].value = '" . $editData['event_description'] . "';
                         </script>";
                }
            }
            ?>

            <input type="submit" name="add_event" value="Add/Update Timeline Event">
        </form>

        <?php
        // Process the form data when the form is submitted
        if (isset($_POST['add_event'])) {
            // Get data from the form
            $id = $_POST['id'];
            $date = $_POST['date'];
            $event_title = $_POST['event_title'];
            $event_description = $_POST['event_description'];

            // Validate and sanitize the input
            $id = mysqli_real_escape_string($connection, $id);
            $date = mysqli_real_escape_string($connection, $date);
            $event_title = mysqli_real_escape_string($connection, $event_title);
            $event_description = mysqli_real_escape_string($connection, $event_description);

            // Check if the ID already exists
            $existing_query = "SELECT * FROM timeline WHERE id = '$id'";
            $existing_result = $connection->query($existing_query);

            if ($existing_result->num_rows > 0) {
                // Update existing row
                $update_query = "UPDATE timeline SET 
                                 date = '$date', 
                                 event_title = '$event_title', 
                                 event_description = '$event_description' 
                                 WHERE id = '$id'";

                if ($connection->query($update_query) === TRUE) {
                    echo "<p>Timeline event updated successfully!</p>";
                } else {
                    echo "Error updating timeline event: " . $connection->error;
                }
            } else {
                // Add new row
                $add_query = "INSERT INTO timeline (id, date, event_title, event_description) 
                              VALUES ('$id', '$date', '$event_title', '$event_description')";

                if ($connection->query($add_query) === TRUE) {
                    echo "<p>Timeline event added successfully!</p>";
                } else {
                    echo "Error adding timeline event: " . $connection->error;
                }
            }
        }

        // Process the delete request
        if (isset($_POST['delete_event'])) {
            // Get the event ID from the form
            $eventId = $_POST['id'];

            // Validate and sanitize the input
            $eventId = mysqli_real_escape_string($connection, $eventId);

            // Perform the delete operation
            $deleteQuery = "DELETE FROM timeline WHERE id = '$eventId'";

            if ($connection->query($deleteQuery) === TRUE) {
                echo "<p>Timeline event deleted successfully!</p>";
            } else {
                echo "Error deleting timeline event: " . $connection->error;
            }
        }

        // Close the database connection
        $connection->close();
        ?>
    </div>
</body>

</html>
