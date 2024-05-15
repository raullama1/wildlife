<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assignment_zoo";

// Check if animal ID is provided
if (isset($_GET['animalid'])) {
    $animalid = $_GET['animalid'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete animal from the database
    $sql = "DELETE FROM animal WHERE animalid = '$animalid'";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to animal.php
        header("Location: animal.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    echo "Animal ID not provided.";
}
?>
