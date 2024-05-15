<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enclosureid = isset($_POST['enclosureid']) ? $_POST['enclosureid'] : null;
    $enclosureType = $_POST['enclosure_type'];
    $enclosureLocation = $_POST['enclosure_location'];
    $enclosureSize = $_POST['enclosure_size'];

    // Database connection and query to update or insert enclosure information

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

    if ($enclosureid) {
        // Update existing enclosure
        $stmt = $conn->prepare("UPDATE enclosure SET enclosure_type = ?, enclosure_location = ?, enclosure_size = ? WHERE enclosureid = ?");
        $stmt->bind_param("sssi", $enclosureType, $enclosureLocation, $enclosureSize, $enclosureid);
    } else {
        // Create new enclosure
        $stmt = $conn->prepare("INSERT INTO enclosure (enclosure_type, enclosure_location, enclosure_size) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $enclosureType, $enclosureLocation, $enclosureSize);
    }

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Redirect to enclosure.php
        header("Location: enclosure.php");
        exit();
    } else {
        echo "Error saving enclosure: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
