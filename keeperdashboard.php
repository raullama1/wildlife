<!DOCTYPE html>
<html>

<head>
    <title>Keeper Dashboard</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4; /* Light gray background */
            background-image: url('https://images.unsplash.com/photo-1503919005314-30d93d07d823?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjJ8fGFuaW1hbCUyMGtlZXBlcnxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&w=800&q=60');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .navbar {
            background-color: #fff; /* White background for navbar */
            color: #28a745;
            padding: 10px;
            cursor: pointer;
        }

        .container {
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* White background with opacity for container */
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px; /* Add margin to move the container down */
        }

        .welcome-message {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333; /* Dark text color for welcome message */
        }

        .animal-table {
        margin-top: 20px;
        background-color: rgba(249, 249, 249, 0.8); /* Light gray background with opacity */
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

        .card-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333; /* Dark text color for card titles */
        }

        .card-content {
            font-size: 16px;
            position: relative; /* Added for image positioning */
        }

        .card-content img {
            max-width: 100%;
            border-radius: 8px; /* Rounded corners for the image */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Updated Logout Button Style */
        .btn-logout {
            margin-right: 40px;
            color: #fff;
            background-color: #28a745; /* Light green color for the button */
            border-color: #28a745; /* Light green color for the border */
            transition: background-color 0.3s ease, border-color 0.3s ease; /* Smooth transition */
        }

        .btn-logout:hover {
            background-color: #218838; /* Darker green color on hover */
            border-color: #218838; /* Darker green color for the border on hover */
        }

        .logo{
            width: 50px;
            margin-left: 40px;
        }
    </style>
</head>

<body>
    <div class="navbar">
    <img src="https://img.freepik.com/premium-vector/animal-keeper-zoo_609550-90.jpg?w=2000" class="logo" alt="Logo" >
        <!-- Logout button -->
        <a href="keeperdashboard.php?logout=true" class="btn btn-logout">Logout</a>
    </div>

    <div class="container">
        <div class="welcome-message">
            <?php
            // Start the session (if not already started)
            session_start();

            // Check if the user is not logged in, redirect to keeperlogin.php
            if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
                header("Location: keeperlogin.php");
                exit;
            }

            // Handle logout when clicked on "Logout"
            if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
                // Destroy the session and redirect to the login page
                session_destroy();
                header("Location: keeperlogin.php");
                exit;
            }

            // Database credentials
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "assignment_zoo";

            // Create a connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Get the logged-in keeper's username from the session
            $keeper_username = $_SESSION['username'];

            // Fetch all keepers with the same username
            $sql_keepers = "SELECT * FROM keeper WHERE username = '$keeper_username'";
            $result_keepers = mysqli_query($conn, $sql_keepers);

            if (mysqli_num_rows($result_keepers) > 0) {
                // Display welcome message for all keepers with the same name and username
                echo "Hello, Keepers! Welcome to the Keeper Dashboard.";
                echo "</div>";

                // Initialize an array to store all assigned animals for the keepers
                $assigned_animals = array();

                // Loop through each keeper
                while ($keeper_row = mysqli_fetch_assoc($result_keepers)) {
                    $assigned_animal_id = $keeper_row['animalid'];

                    // Fetch the specific animal details assigned to the keeper from the "animal" table
                    $sql_animal = "SELECT * FROM animal WHERE animalid = $assigned_animal_id LIMIT 1";
                    $result_animal = mysqli_query($conn, $sql_animal);

                    if (mysqli_num_rows($result_animal) == 1) {
                        $animal_row = mysqli_fetch_assoc($result_animal);

                        // Add the animal details to the array
                        $assigned_animals[] = array(
                            'keeper_name' => $keeper_row['keeper_name'],
                            'animal_name' => $animal_row['animal_name'],
                            'animal_gender' => $animal_row['gender'],
                            'animal_year_arrival' => $animal_row['year_arrival']
                        );
                    }
                }

                // Display all assigned animals in one table
                if (!empty($assigned_animals)) {
                    echo "<div class='animal-table card'>";
                    echo "<div class='card-title'>Assigned Animals Details:</div>";
                    echo "<div class='card-content'>";
                    echo "<table class='table table-bordered'>";
                    echo "<thead class='thead-light'>";
                    echo "<tr>";
                    echo "<th scope='col'>Keeper Name</th>";
                    echo "<th scope='col'>Animal Name</th>";
                    echo "<th scope='col'>Gender</th>";
                    echo "<th scope='col'>Year of Arrival</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    foreach ($assigned_animals as $animal) {
                        echo "<tr>";
                        echo "<td>{$animal['keeper_name']}</td>";
                        echo "<td>{$animal['animal_name']}</td>";
                        echo "<td>{$animal['animal_gender']}</td>";
                        echo "<td>{$animal['animal_year_arrival']}</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "No animal details found for the assigned animals.";
                }
            } else {
                echo "Keeper details not found.";
            }

            mysqli_close($conn);
            ?>
        </div>
    </div>

    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Add custom JavaScript for interactivity (if needed)
    </script>
</body>

</html>
