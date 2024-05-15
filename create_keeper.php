<!DOCTYPE html>
<html>
<head>
    <title>Create Keeper</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
    <?php include 'menu.php'; ?>
    body {
        padding: 20px;
    }

    .container {
        background-image: url('https://media.istockphoto.com/id/1203327078/vector/abstract-background-of-smooth-curves.jpg?s=612x612&w=0&k=20&c=ybD3C-N3ZUX9abrp4XHrpSRhwubH0DiZ1-ZuZLWTBnY=');
        background-repeat: no-repeat;
        background-size: cover;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        color: black;
    }

    .container h2 {
        color: black;
    }
</style>
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <h2 class="mt-4">Create Keeper</h2>

        <form method="post" action="save_keeper.php">
            <div class="form-group">
                <label for="keeperName">Keeper Name:</label>
                <input type="text" class="form-control" id="keeperName" name="keeperName" placeholder="Enter Keeper Name">
            </div>

            <div class="form-group">
                <label for="keeperDob">Date of Birth:</label>
                <input type="date" class="form-control" id="keeperDob" name="keeperDob">
            </div>

            <div class="form-group">
                <label for="keeperRank">Rank:</label>
                <select class="form-control" id="keeperRank" name="keeperRank">
                    <?php
                    // Database connection and query to retrieve rank information

                    // Replace the following with your actual database connection details
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "assignment_zoo";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Query to retrieve rank information
                    $sql = "SELECT * FROM rank";
                    $result = $conn->query($sql);

                    // Display rank options
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['rankid'] . "'>" . $row['rank'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="animalId">Animal Name:</label>
                <select class="form-control" id="animalId" name="animalId">
                    <?php
                    // Query to retrieve animal information
                    $sql = "SELECT * FROM animal";
                    $result = $conn->query($sql);

                    // Display animal options
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['animalid'] . "'>" . $row['animal_name'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="keeper.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
