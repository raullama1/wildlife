<!-- keeperanimals.php -->

<?php
// Start the session (if not already started)
session_start();

// Check if the user is not logged in, redirect to keeperlogin.php
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: keeperlogin.php");
    exit;
}

// Check if the keeper ID is provided in the URL
if (!isset($_GET['keeperid'])) {
    echo "Error: Keeper ID not provided in the URL.";
    exit;
}

// Get the keeper ID from the URL
$keeperid = $_GET['keeperid'];

// TODO: Fetch the relevant animals for the given keeper ID from the database
// Replace the below code with your database query to get animals for the given keeper.
// You can use the $keeperid to filter the animals for the particular keeper.

// Sample code to display the animal table for the keeper
$sample_animals = [
    ["animal_name" => "Lion", "species" => "Mammal", "gender" => "Male", "year_arrival" => "2019"],
    ["animal_name" => "Elephant", "species" => "Mammal", "gender" => "Female", "year_arrival" => "2020"],
    // Add more animals here as per the keeper's care.
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Keeper Animals</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <!-- Keeper Animals title -->
            <a class="navbar-brand" href="#">Keeper Animals</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Navigation links moved to the left -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="keeperdashboard.php">Dashboard</a>
                    </li>
                    <!-- You can add more navigation links here if needed -->
                </ul>
                <!-- Logout link pushed to the right -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link logout-link" href="#" onclick="logout()">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 class="my-4">Animals under your care:</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Animal Name</th>
                    <th>Species</th>
                    <th>Gender</th>
                    <th>Year of Arrival</th>
                </tr>
            </thead>
            <tbody>
                <!-- Display the animals under the keeper's care -->
                <?php foreach ($sample_animals as $animal) { ?>
                    <tr>
                        <td><?php echo $animal['animal_name']; ?></td>
                        <td><?php echo $animal['species']; ?></td>
                        <td><?php echo $animal['gender']; ?></td>
                        <td><?php echo $animal['year_arrival']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Add the JavaScript script to handle the logout click -->
    <script>
        function logout() {
            window.location.href = "keeperdashboard.php?logout=true";
        }
    </script>
</body>
</html>
