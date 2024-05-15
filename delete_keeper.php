<?php
// Database connection

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

// Check if keeper ID is provided
if (isset($_GET['id'])) {
    $keeperId = $_GET['id'];

    // Delete keeper from the database
    $sql = "DELETE FROM keeper WHERE keeperid = '$keeperId'";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the keeper.php page with success message
        header("Location: keeper.php?message=delete_success");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Keeper ID not provided.";
}

// Close connection
$conn->close();
?>
