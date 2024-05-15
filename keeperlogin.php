<?php
// Start the session (if not already started)
session_start();

// Check if the user is already logged in, if so, redirect to keeperdashboard.php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: keeperdashboard.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "assignment_zoo";

    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the entered username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Replace 'keeper' with the actual name of your "keeper" table in the database
    $sql = "SELECT * FROM keeper WHERE username = '$username' AND password = '$password' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Login successful
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: keeperdashboard.php");
        exit;
    } else {
        // Login failed
        $login_error = "Invalid username or password. Please try again.";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Keeper Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url("https://images.unsplash.com/photo-1503918756811-975bd3397178?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            opacity: 0; /* Start with background image hidden */
            animation: fade-in-bg 1s ease forwards;
        }

        .container {
            margin-top: 100px;
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
        }

        /* New animation styles */
        @keyframes fade-in-bg {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Updated button and text styles */
        .btn-login {
            background-color: #28a745; /* Light green color for the button */
            border-color: #28a745; /* Light green color for the border */
            color: #fff; /* White text color */
            transition: background-color 0.3s ease, border-color 0.3s ease; /* Smooth transition */
        }

        .btn-login:hover {
            background-color: #218838; /* Darker green color on hover */
            border-color: #218838; /* Darker green color for the border on hover */
        }

        /* Updated form input text color */
        .form-control {
            color: #333; /* Dark text color for form inputs */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4">Keeper Login</h2>
        <?php if (isset($login_error)) { ?>
            <div class="alert alert-danger"><?php echo $login_error; ?></div>
        <?php } ?>

        <form method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-login btn-block">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- JavaScript to remove opacity when the page loads -->
    <script>
        window.addEventListener("load", function () {
            document.body.style.opacity = 1;
        });
    </script>
</body>
</html>
