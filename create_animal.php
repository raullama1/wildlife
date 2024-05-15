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
        // Redirect to the animal.php page upon successful insertion
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

<!DOCTYPE html>
<html>
<head>
    <title>Create Animal</title>
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
    <h2 class="mt-4">Create Animal</h2>
    <form method="POST" action="save_animal.php">
        <div class="form-group">
            <label for="animal_name">Animal Name:</label>
            <input type="text" class="form-control" id="animal_name" name="animal_name" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="year_arrival">Year of Arrival:</label>
            <input type="number" class="form-control" id="year_arrival" name="year_arrival" required>
        </div>
        <div class="form-group">
            <label for="speciesid">Species:</label>
            <select class="form-control" id="speciesid" name="speciesid" required>
                <?php
                // Database connection and query to retrieve species information

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
                $sql = "SELECT * FROM species";
                $result = $conn->query($sql);

                // Display species options
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["speciesid"] . "'>" . $row["species_type"] . "</option>";
                    }
                } else {
                    echo "<option value=''>No species found</option>";
                }

                // Close connection
                $conn->close();
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="enclosureid">Enclosure Type:</label>
            <select class="form-control" id="enclosureid" name="enclosureid" required>
                <?php
                // Database connection and query to retrieve enclosure information

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

                // Query to retrieve enclosure information
                $sql = "SELECT * FROM enclosure";
                $result = $conn->query($sql);

                // Display enclosure options
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["enclosureid"] . "'>" . $row["enclosure_type"] . " - " . $row["enclosure_location"] . " (Size: " . $row["enclosure_size"] . ")</option>";
                    }
                } else {
                    echo "<option value=''>No enclosures found</option>";
                }

                // Close connection
                $conn->close();
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="animal.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
