<?php
// Check if animal ID is provided
if (!isset($_GET['animalid'])) {
    // Redirect back to animal.php
    header("Location: animal.php");
    exit();
}

$animalid = $_GET['animalid'];

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

// Retrieve animal information
$sql = "SELECT * FROM animal WHERE animalid = '$animalid'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    // Animal not found, redirect back to animal.php
    header("Location: animal.php");
    exit();
}

$row = $result->fetch_assoc();

// Check if form is submitted for updating animal information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated values from the form
    $animal_name = $_POST["animal_name"];
    $gender = $_POST["gender"];
    $year_arrival = $_POST["year_arrival"];
    $speciesid = $_POST["speciesid"];
    $enclosureid = $_POST["enclosureid"];

    // Validate animal name
    if (!preg_match("/^[a-zA-Z ]*$/", $animal_name)) {
        echo "<script>alert('Invalid name! Numbers cannot be entered in the name field. Please enter a valid name.');";
        echo "window.location.href = 'edit_animal.php?animalid=" . $animalid . "';</script>";
        exit();
    }

    // Validate year of arrival
    if ($year_arrival < 2000 || $year_arrival > 2023) {
        echo "<script>alert('Invalid year of arrival! Please enter a valid year of arrival.');";
        echo "window.location.href = 'edit_animal.php?animalid=" . $animalid . "';</script>";
        exit();
    }

    // Update the animal information in the database
    $sql = "UPDATE animal SET animal_name = '$animal_name', gender = '$gender', year_arrival = '$year_arrival', speciesid = '$speciesid', enclosureid = '$enclosureid' WHERE animalid = '$animalid'";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to animal.php
        header("Location: animal.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Retrieve species information for dropdown
$species_sql = "SELECT * FROM species";
$species_result = $conn->query($species_sql);

// Retrieve enclosure information for dropdown
$enclosure_sql = "SELECT enclosure.enclosureid, enclosure.enclosure_type, enclosure.enclosure_location, enclosure.enclosure_size FROM enclosure";
$enclosure_result = $conn->query($enclosure_sql);

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Animal</title>
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
    <h2 class="mt-4">Edit Animal</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?animalid=' . $animalid; ?>">
        <div class="form-group">
            <label for="animal_name">Animal Name:</label>
            <input type="text" class="form-control" id="animal_name" name="animal_name"
                   value="<?php echo $row["animal_name"]; ?>" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="M" <?php echo ($row["gender"] === "M") ? "selected" : ""; ?>>Male</option>
                <option value="F" <?php echo ($row["gender"] === "F") ? "selected" : ""; ?>>Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="year_arrival">Year of Arrival:</label>
            <input type="number" class="form-control" id="year_arrival" name="year_arrival"
                   value="<?php echo $row["year_arrival"]; ?>" required>
        </div>
        <div class="form-group">
            <label for="speciesid">Species Type:</label>
            <select class="form-control" id="speciesid" name="speciesid" required>
                <?php
                while ($species_row = $species_result->fetch_assoc()) {
                    $selected = ($species_row['speciesid'] == $row['speciesid']) ? 'selected' : '';
                    echo '<option value="' . $species_row['speciesid'] . '" ' . $selected . '>' . $species_row['species_type'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="enclosureid">Enclosure:</label>
            <select class="form-control" id="enclosureid" name="enclosureid" required>
                <?php
                while ($enclosure_row = $enclosure_result->fetch_assoc()) {
                    $selected = ($enclosure_row['enclosureid'] == $row['enclosureid']) ? 'selected' : '';
                    echo '<option value="' . $enclosure_row['enclosureid'] . '" ' . $selected . '>' . $enclosure_row['enclosure_type'] . ' - ' . $enclosure_row['enclosure_location'] . ' (' . $enclosure_row['enclosure_size'] . ')' . '</option>';
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="animal.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
