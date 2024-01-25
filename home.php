<?php
require_once('db.php');

$query = "SELECT * FROM song";
$result = mysqli_query($con, $query);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $title = $_POST['title'];
    $duration = $_POST['duration'];
    $releaseDate = $_POST['releaseDate'];

    $insertQuery = "INSERT INTO song (Title, Duration, ReleaseDate) VALUES ('$title', '$duration', '$releaseDate')";
    $insertResult = mysqli_query($con, $insertQuery);

    if ($insertResult) {
        echo "Record inserted successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $songIDToUpdate = $_POST['songID'];
    $newTitle = $_POST['newTitle'];
    $newDuration = $_POST['newDuration'];
    $newReleaseDate = $_POST['newReleaseDate'];

    $updateQuery = "UPDATE song SET Title='$newTitle', Duration='$newDuration', ReleaseDate='$newReleaseDate' WHERE SongID='$songIDToUpdate'";
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        echo "Record updated successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $songIDToDelete = $_POST['songID'];

    $deleteQuery = "DELETE FROM song WHERE SongID='$songIDToDelete'";
    $deleteResult = mysqli_query($con, $deleteQuery);

    if ($deleteResult) {
        echo "Record deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #343a40;
            color: #fff;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            background-color: #212529;
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .btn {
            margin-top: 10px;
        }

        .table {
            color: #fff;
        }

        .bg-dark {
            background-color: #343a40 !important;
        }
    </style>
</head>

<body class="bg-dark">
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h2 class="display-6">Your Songs</h2>
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <input type="text" class="form-control" name="title" placeholder="Title" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="duration" placeholder="Duration" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="releaseDate" placeholder="Release Date" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-success">Insert</button>
                        </form>

                        <form method="post" action="">
                            <div class="form-group">
                                <input type="text" class="form-control" name="songID" placeholder="Enter SongID to update" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="newTitle" placeholder="New Title">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="newDuration" placeholder="New Duration">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="newReleaseDate" placeholder="New Release Date">
                            </div>
                            <button type="submit" name="update" class="btn btn-warning">Update</button>
                        </form>

                        <form method="post" action="">
                            <div class="form-group">
                                <input type="text" class="form-control" name="songID" placeholder="Enter SongID to delete" required>
                            </div>
                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                        </form>

                        <table class="table table-bordered text-center table-dark mt-4">
                            <thead>
                                <tr>
                                    <th>SongID</th>
                                    <th>Title</th>
                                    <th>Duration</th>
                                    <th>ReleaseDate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td><?php echo $row['SongID']; ?></td>
                                        <td><?php echo $row['Title']; ?></td>
                                        <td><?php echo $row['Duration']; ?></td>
                                        <td><?php echo $row['ReleaseDate']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>