<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $keeperId = $_POST["keeperId"];
    $keeperName = $_POST["keeperName"];
    $keeperDob = $_POST["keeperDob"];
    $keeperRank = $_POST["keeperRank"];
    $animalId = $_POST["animalId"];

    // Check if the name contains any numbers
    if (preg_match('/\d/', $keeperName)) {
        echo "<script>alert('Invalid Name. Numbers cannot be entered in the name.'); window.history.go(-1);</script>";
        exit();
    }

    // Validate year format and range
    $year = date("Y", strtotime($keeperDob));
    if (!preg_match("/^\d{4}$/", $year)) {
        echo "<script>alert('Invalid Date of Birth. Please enter a valid one.'); window.history.go(-1);</script>";
        exit();
    }

    // Check the year range
    if ($year < 1960 || $year > 2005) {
        echo "<script>alert('Invalid Date of Birth. Please enter a valid one.'); window.history.go(-1);</script>";
        exit();
    }

    // Database connection parameters
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

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("UPDATE keeper SET keeper_name = ?, keeper_dob = ?, keeper_rank = ?, animalid = ? WHERE keeperid = ?");
    $stmt->bind_param("ssiii", $keeperName, $keeperDob, $keeperRank, $animalId, $keeperId);

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Redirect to the keeper.php page after successful update
        header("Location: keeper.php");
        exit();
    } else {
        // Display an error message if the update operation fails
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
