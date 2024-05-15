<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the form data
    $animalName = $_POST["animal_name"];
    $gender = $_POST["gender"];
    $yearArrival = $_POST["year_arrival"];
    $speciesId = $_POST["speciesid"];
    $enclosureId = $_POST["enclosureid"];

    // Validate animal name
    if (!preg_match("/^[a-zA-Z ]*$/", $animalName)) {
        echo "<script>alert('Invalid name! Numbers cannot be entered in the name field. Please enter a valid name.');";
        echo "window.location.href = 'create_animal.php';</script>";
        exit();
    }

    // Validate year of arrival
    if ($yearArrival < 2000 || $yearArrival > 2023) {
        echo "<script>alert('Invalid year of arrival! Please enter a valid year of arrival.');";
        echo "window.location.href = 'create_animal.php';</script>";
        exit();
    }

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

    // Prepare the SQL statement
    $sql = "INSERT INTO animal (animal_name, gender, year_arrival, speciesid, enclosureid) VALUES (?, ?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters to the statement
    $stmt->bind_param("sssii", $animalName, $gender, $yearArrival, $speciesId, $enclosureId);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the appropriate page upon successful insertion
        header("Location: animal.php");
        exit();
    } else {
        // Handle the error if the statement execution fails
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
