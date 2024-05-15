<!DOCTYPE html>
<html>
<head>
    <title>Create Species</title>
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
    <?php
    // Replace this section with your actual database connection and query code
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "assignment_zoo";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to retrieve distinct values for species group, lifestyle, and conservation status
    $sqlSpeciesGroup = "SELECT DISTINCT species_group FROM species";
    $resultSpeciesGroup = $conn->query($sqlSpeciesGroup);

    $sqlSpeciesLifestyle = "SELECT DISTINCT species_lifestyle FROM species";
    $resultSpeciesLifestyle = $conn->query($sqlSpeciesLifestyle);

    $sqlConservationStatus = "SELECT DISTINCT species_conservationstatus FROM species";
    $resultConservationStatus = $conn->query($sqlConservationStatus);
    ?>
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <h2 class="mt-4">Create Species</h2>
        <form method="post" action="save_species.php">
            <div class="form-group">
                <label for="speciesType">Species Type:</label>
                <input type="text" class="form-control" id="speciesType" name="speciesType" required>
            </div>

            <div class="form-group">
                <label for="speciesGroup">Species Group:</label>
                <select class="form-control" id="speciesGroup" name="speciesGroup" required>
                    <?php
                    if ($resultSpeciesGroup->num_rows > 0) {
                        while ($row = $resultSpeciesGroup->fetch_assoc()) {
                            echo "<option value='" . $row['species_group'] . "'>" . $row['species_group'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="speciesLifestyle">Species Lifestyle:</label>
                <select class="form-control" id="speciesLifestyle" name="speciesLifestyle" required>
                    <?php
                    if ($resultSpeciesLifestyle->num_rows > 0) {
                        while ($row = $resultSpeciesLifestyle->fetch_assoc()) {
                            echo "<option value='" . $row['species_lifestyle'] . "'>" . $row['species_lifestyle'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="conservationStatus">Conservation Status:</label>
                <select class="form-control" id="conservationStatus" name="conservationStatus" required>
                    <?php
                    if ($resultConservationStatus->num_rows > 0) {
                        while ($row = $resultConservationStatus->fetch_assoc()) {
                            echo "<option value='" . $row['species_conservationstatus'] . "'>" . $row['species_conservationstatus'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
            <a href="species.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
