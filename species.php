<?php session_start();

// Check if the user is not logged in, redirect to index.php
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit();
} ?>

<!DOCTYPE html>
<html>
<head>
    <title>Species Information</title>
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
        color: #ffffff;
    }

    .container h2 {
        color: black;
    }
</style>

    <script>
        function searchSpecies() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("speciesTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Column index 1 corresponds to Species Type
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</head>
<body>
    <?php include 'menu.php'; ?>
    <div class="container">
        <h2 class="mt-4">Species Information</h2>
        <div class="mt-3 mb-3">
            <input type="text" id="searchInput" onkeyup="searchSpecies()" placeholder="Search by Species Name">
        </div>
        <div class="table-responsive">
            <table id="speciesTable" class="table table-striped table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Species ID</th>
                        <th>Species Type</th>
                        <th>Species Group</th>
                        <th>Species Lifestyle</th>
                        <th>Conservation Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
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

                    // Display species information
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                      <td>" . $row["speciesid"] . "</td>
                                      <td>" . $row["species_type"] . "</td>
                                      <td>" . $row["species_group"] . "</td>
                                      <td>" . $row["species_lifestyle"] . "</td>
                                      <td>" . $row["species_conservationstatus"] . "</td>
                                      <td>
                                          <a href='edit_species.php?speciesid=" . $row['speciesid'] . "' class='btn btn-primary btn-sm'>Edit</a>
                                          <a href='delete_species.php?speciesid=" . $row['speciesid'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this species?\")'>Delete</a>
                                      </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No species information found.</td></tr>";
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <a href="create_species.php" class="btn btn-success">Create Species</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
