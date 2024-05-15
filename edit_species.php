<!DOCTYPE html>
<html>
<head>
    <title>Edit Species</title>
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
        <h2 class="mt-4">Edit Species</h2>

        <?php
        // Check if species ID is provided in the URL
        if (isset($_GET['speciesid'])) {
            $speciesid = $_GET['speciesid'];

            // Retrieve species information from the database based on the species ID

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

            // Query to retrieve species information
            $sql = "SELECT * FROM species WHERE speciesid = $speciesid";
            $result = $conn->query($sql);

            // Display species information in a form for editing
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>

<form method="post" action="save_species.php">
    <input type="hidden" name="speciesid" value="<?php echo $row['speciesid']; ?>">

    <div class="form-group">
        <label for="speciesType">Species Type:</label>
        <input type="text" class="form-control" id="speciesType" name="speciesType" value="<?php echo $row['species_type']; ?>" required>
    </div>

    <div class="form-group">
        <label for="speciesGroup">Species Group:</label>
        <select class="form-control" id="speciesGroup" name="speciesGroup">
            <?php
            // Query to fetch species groups from the database
            $speciesGroupQuery = "SELECT DISTINCT species_group FROM species";
            $speciesGroupResult = $conn->query($speciesGroupQuery);

            // Display species groups in the dropdown
            if ($speciesGroupResult->num_rows > 0) {
                while ($speciesGroupRow = $speciesGroupResult->fetch_assoc()) {
                    $selected = ($speciesGroupRow['species_group'] == $row['species_group']) ? "selected" : "";
                    echo "<option value='" . $speciesGroupRow['species_group'] . "' " . $selected . ">" . $speciesGroupRow['species_group'] . "</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="speciesLifestyle">Species Lifestyle:</label>
        <select class="form-control" id="speciesLifestyle" name="speciesLifestyle">
            <?php
            // Query to fetch species lifestyles from the database
            $speciesLifestyleQuery = "SELECT DISTINCT species_lifestyle FROM species";
            $speciesLifestyleResult = $conn->query($speciesLifestyleQuery);

            // Display species lifestyles in the dropdown
            if ($speciesLifestyleResult->num_rows > 0) {
                while ($speciesLifestyleRow = $speciesLifestyleResult->fetch_assoc()) {
                    $selected = ($speciesLifestyleRow['species_lifestyle'] == $row['species_lifestyle']) ? "selected" : "";
                    echo "<option value='" . $speciesLifestyleRow['species_lifestyle'] . "' " . $selected . ">" . $speciesLifestyleRow['species_lifestyle'] . "</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="conservationStatus">Conservation Status:</label>
        <select class="form-control" id="conservationStatus" name="conservationStatus">
            <?php
            // Query to fetch conservation statuses from the database
            $conservationStatusQuery = "SELECT DISTINCT species_conservationstatus FROM species";
            $conservationStatusResult = $conn->query($conservationStatusQuery);

            // Display conservation statuses in the dropdown
            if ($conservationStatusResult->num_rows > 0) {
                while ($conservationStatusRow = $conservationStatusResult->fetch_assoc()) {
                    $selected = ($conservationStatusRow['species_conservationstatus'] == $row['species_conservationstatus']) ? "selected" : "";
                    echo "<option value='" . $conservationStatusRow['species_conservationstatus'] . "' " . $selected . ">" . $conservationStatusRow['species_conservationstatus'] . "</option>";
                }
            }
            ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="species.php" class="btn btn-secondary">Cancel</a>
</form>

                <?php
            } else {
                echo "<p>No species information found.</p>";
            }

            // Close connection
            $conn->close();
        } else {
            echo "<p>Invalid species ID.</p>";
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
