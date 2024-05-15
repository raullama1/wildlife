<!DOCTYPE html>
<html>
<head>
    <title>Edit Keeper</title>
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
        <h2 class="mt-4">Edit Keeper</h2>

        <?php
        // Check if the keeper ID is provided in the URL
        if (isset($_GET['id'])) {
            $keeperId = $_GET['id'];

            // Database connection and query to retrieve keeper information

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

            // Query to retrieve keeper information
            $sql = "SELECT * FROM keeper WHERE keeperid = $keeperId";
            $result = $conn->query($sql);

            // Display keeper information in a form for editing
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>

                <form method="post" action="update_keeper.php">
                    <input type="hidden" name="keeperId" value="<?php echo $row['keeperid']; ?>">

                    <div class="form-group">
                        <label for="keeperName">Keeper Name:</label>
                        <input type="text" class="form-control" id="keeperName" name="keeperName" value="<?php echo $row['keeper_name']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="keeperDob">Date of Birth:</label>
                        <input type="date" class="form-control" id="keeperDob" name="keeperDob" value="<?php echo $row['keeper_dob']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="keeperRank">Rank:</label>
                        <select class="form-control" id="keeperRank" name="keeperRank">
                            <?php
                            // Query to retrieve rank information
                            $rankSql = "SELECT * FROM rank";
                            $rankResult = $conn->query($rankSql);

                            // Display rank options
                            if ($rankResult->num_rows > 0) {
                                while ($rankRow = $rankResult->fetch_assoc()) {
                                    $selected = ($rankRow['rankid'] == $row['keeper_rank']) ? "selected" : "";
                                    echo "<option value='" . $rankRow['rankid'] . "' " . $selected . ">" . $rankRow['rank'] . "</option>";
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
                            $animalSql = "SELECT * FROM animal";
                            $animalResult = $conn->query($animalSql);

                            // Display animal options
                            if ($animalResult->num_rows > 0) {
                                while ($animalRow = $animalResult->fetch_assoc()) {
                                    $selected = ($animalRow['animalid'] == $row['animalid']) ? "selected" : "";
                                    echo "<option value='" . $animalRow['animalid'] . "' " . $selected . ">" . $animalRow['animal_name'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="keeper.php" class="btn btn-secondary">Cancel</a>
                </form>

                <?php
            } else {
                echo "<p>No keeper information found.</p>";
            }

            // Close connection
            $conn->close();
        } else {
            echo "<p>Invalid keeper ID.</p>";
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
