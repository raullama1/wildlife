<!DOCTYPE html>
<html>
<head>
    <title>Enclosure Information</title>
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
        function searchEnclosure() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("enclosureTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Column index 1 corresponds to Enclosure Type
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
        <h2 class="mt-4">Enclosure Information</h2>
        <div class="mt-3 mb-3">
            <input type="text" id="searchInput" onkeyup="searchEnclosure()" placeholder="Search by Enclosure Type">
        </div>
        <div class="table-responsive">
            <table id="enclosureTable" class="table table-striped table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Enclosure ID</th>
                        <th>Enclosure Type</th>
                        <th>Enclosure Location</th>
                        <th>Enclosure Size</th>
                        <th>Occupancy</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
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

                    // Display enclosure information
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Query to count the number of animals in the enclosure
                            $enclosureId = $row['enclosureid'];
                            $animalCountSql = "SELECT COUNT(*) AS animal_count FROM animal WHERE enclosureid = '$enclosureId'";
                            $animalCountResult = $conn->query($animalCountSql);
                            $animalCountRow = $animalCountResult->fetch_assoc();
                            $animalCount = $animalCountRow['animal_count'];

                            echo "<tr>
                                      <td>" . $row["enclosureid"] . "</td>
                                      <td>" . $row["enclosure_type"] . "</td>
                                      <td>" . $row["enclosure_location"] . "</td>
                                      <td>" . $row["enclosure_size"] . "</td>
                                      <td>$animalCount / " . $row["enclosure_size"] . "</td>
                                      <td>
                                          <a href='edit_enclosure.php?enclosureid=" . $row['enclosureid'] . "' class='btn btn-primary btn-sm'>Edit</a>
                                          <a href='delete_enclosure.php?enclosureid=" . $row['enclosureid'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this enclosure?\")'>Delete</a>
                                      </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No enclosure information found.</td></tr>";
                    }

                    // Close connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <a href="create_enclosure.php" class="btn btn-success">Create Enclosure</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
