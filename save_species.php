<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $speciesType = $_POST["speciesType"];
    $speciesGroup = $_POST["speciesGroup"];
    $speciesLifestyle = $_POST["speciesLifestyle"];
    $conservationStatus = $_POST["conservationStatus"];

    // Database connection details
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

    // Check if speciesid is set (for updating an existing species)
    if (isset($_POST["speciesid"])) {
        $speciesId = $_POST["speciesid"];

        // Update the species record
        $sql = "UPDATE species SET species_type='$speciesType', species_group='$speciesGroup', species_lifestyle='$speciesLifestyle', species_conservationstatus='$conservationStatus' WHERE speciesid='$speciesId'";

        if ($conn->query($sql) === TRUE) {
            echo "Species updated successfully!";
        } else {
            echo "Error updating species: " . $conn->error;
        }
    } else {
        // Insert a new species record
        $sql = "INSERT INTO species (species_type, species_group, species_lifestyle, species_conservationstatus) VALUES ('$speciesType', '$speciesGroup', '$speciesLifestyle', '$conservationStatus')";

        if ($conn->query($sql) === TRUE) {
            echo "New species created successfully!";
        } else {
            echo "Error creating species: " . $conn->error;
        }
    }

    // Close connection
    $conn->close();

    // Redirect to species.php
    header("Location: species.php");
    exit();
} else {
    // If the form is not submitted, redirect to the species.php page
    header("Location: species.php");
    exit();
}
?>
