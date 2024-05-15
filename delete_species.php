<?php
// Check if species ID is provided in the URL
if (isset($_GET['speciesid'])) {
    $speciesid = $_GET['speciesid'];

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

    // Delete species from the database
    $sql = "DELETE FROM species WHERE speciesid = $speciesid";

    if ($conn->query($sql) === TRUE) {
        // Species deleted successfully
        echo "<p>Species deleted successfully.</p>";
        // Redirect to species.php
        header("Location: species.php");
        exit();
    } else {
        // Error deleting species
        echo "<p>Error deleting species: " . $conn->error . "</p>";
    }

    // Close connection
    $conn->close();
} else {
    echo "<p>Invalid species ID.</p>";
}
?>
