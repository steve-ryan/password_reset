<?php
session_start();
require 'db_connection.php';

// Check if user is logged in
if(!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])){
    header('Location: logout.php');
    exit;
}

// Retrieve user data from the database
$user_email = $_SESSION['user_email'];
$stmt = $db_connection->prepare("SELECT * FROM `users` WHERE user_email = ?");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/fontawesome.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/regular.css" rel="stylesheet">
    <title>Home</title>
</head>
<body>
    <?php require_once 'server.php'; ?>

    <nav class="navbar  fixed-top navbar-light bg-success">
        <span class="navbar-brand mb-0 h1">Hello, <?php echo $userData['firstname'];?>!</span>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link text-white"  href="logout.php">Logout</a>
            </li>
        </ul>
    </nav>
    <div class="jumbotron jumbotron-fluid">
        <h4 class="text-center">Welcome to event manager</h4>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="server.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $task_id ?>">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="event" value="<?php echo $name ?>"
                                placeholder="Event Name" required>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" class="form-control" name="venue" value="<?php echo $venue ?>"
                                placeholder="Venue" required>
                        </div>
                        <div class="form-group col-md-4">
                            <input type="date" class="form-control" value="<?php echo $event_date ?>"
                                min="<?php echo date("Y-m-d"); ?>" name="date" placeholder="Date" required>
                        </div>
                        <div class="form-group col-md-2">
                            <?php
                            if ($update == true) {
                                echo '<button type="submit" class="btn btn-success form-control" name="update">Update</button>';
                            } else {
                                echo '<button type="submit" class="btn btn-success form-control" name="add">Add</button>';
                            }
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table ">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Event</th>
                        <th scope="col">Venue</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    get_all_data($db_connection);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>