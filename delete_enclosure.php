<?php
// Check if enclosure ID is provided
if (isset($_GET['enclosureid'])) {
    $enclosureid = $_GET['enclosureid'];

    // Database connection and query to delete enclosure

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

    // Query to delete enclosure
    $sql = "DELETE FROM enclosure WHERE enclosureid = '$enclosureid'";

    if ($conn->query($sql) === TRUE) {
        // Redirect to enclosure.php
        header("Location: enclosure.php");
        exit();
    } else {
        echo "Error deleting enclosure: " . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    echo "Invalid enclosure ID";
}
?>
