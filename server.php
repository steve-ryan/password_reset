<?php

include 'db_connection.php';

$task_id = 0;
$update = false;
$name = '';
$venue = '';
$event_date = '';

// Add event in the database
if (isset($_POST['add'])) {
    // check user inputs not empty
    if (!empty($_POST['event']) && !empty($_POST['venue']) && !empty($_POST['date'])) {
        $event = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['event']));
        $venue = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['venue']));
        $date = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['date']));

        $check_event = mysqli_query($db_connection, "SELECT `name`,`event_date` FROM `task` 
            WHERE name = '$event' AND event_date = '$date'");

        if (mysqli_num_rows($check_event) > 0) {
            echo "<h3>This event already exists. Please try another.</h3>";
        } else {
            $insert_query = mysqli_query($db_connection, "INSERT INTO `task`(name,venue, event_date) 
                VALUES('$event','$venue','$date')");

            if ($insert_query) {
                echo "<script>
                    alert('Data inserted');
                    window.location.href = 'home.php';
                    </script>";
                exit;
            } else {
                echo "<h3>Oops something went wrong!</h3>";
            }
        }
    } else {
        echo "<h4>Please fill all fields</h4>";
    }
}

// Get all tasks
function get_all_data($db_connection)
{
    $sql = "SELECT * FROM task ORDER BY event_date DESC";
    $result = $db_connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $curDate = date("Y-m-d");

            if ($curDate < $row['event_date']) {
                $status = '<p><span class="badge badge-success">Upcoming</span></p>';
            } elseif ($curDate == $row['event_date']) {
                $status = '<p><span class="badge badge-warning">Happening</span></p>';
            } else {
                $status = '<p><span class="badge badge-danger">Past event</span></p>';
            }

            echo '<tr>
            <td>' . $row['name'] . '</td>
            <td>' . $row['venue'] . '</td>
            <td>' . $row['event_date'] . '</td>
            <td>' . $status . '</td>
            <td>
            <a href="home.php?edit=' . $row['task_id'] . '" class="rounded"><i class="far fa-edit text-primary mr-2">Edit</i></a>
            <a href="server.php?delete=' . $row['task_id'] . '" class="rounded"><i class="far fa-trash-alt text-danger ml-2">Delete</i></a>
            </td>
            </tr>';
        }
    } else {
        echo "0 results";
    }
}

// Delete event from the database
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete_event = mysqli_query($db_connection, "DELETE FROM `task` WHERE task_id ='$id'");

    if ($delete_event) {
        echo "<script>
         alert('Event Deleted!');
         window.location.href = 'home.php';
         </script>";
        exit;
    } else {
        echo "<h3>Oops something went wrong!</h3>";
    }
}

// Get event from database for update
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $id = $_GET['edit'];

    $update = true;
    $result = mysqli_query($db_connection, "SELECT * FROM task WHERE task_id =$id");

    if ($result->num_rows == 1) {
        $row = $result->fetch_array();
        $task_id = $row['task_id'];
        $name = $row['name'];
        $venue = $row['venue'];
        $event_date = $row['event_date'];
    }
}

// Update the selected event
if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['id']));
    $name = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['event']));
    $venue = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['venue']));
    $date = mysqli_real_escape_string($db_connection, htmlspecialchars($_POST['date']));

    $sql = mysqli_query($db_connection, "UPDATE task SET name='$name',venue='$venue',event_date='$date' WHERE task_id=$id");

    if ($sql) {
        echo "<script>
         alert('Event has been successfully updated!');
         window.location.href = 'home.php';
         </script>";
        exit;
    } else {
        echo "<h3>Oops something went wrong!</h3>";
    }
}
