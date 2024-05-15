<!DOCTYPE html>
<html>
<head>
    <title>Create Enclosure</title>
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
    <?php include 'menu.php';?>
    <div class="container">
        <h2 class="mt-4">Create Enclosure</h2>
        <form method="POST" action="save_enclosure.php">
            <div class="form-group">
                <label for="enclosure_type">Enclosure Type:</label>
                <input type="text" class="form-control" id="enclosure_type" name="enclosure_type" placeholder="Enter Enclosure Type" required>
            </div>
            <div class="form-group">
                <label for="enclosure_location">Enclosure Location:</label>
                <input type="text" class="form-control" id="enclosure_location" name="enclosure_location" placeholder="Enter Enclosure Location" required>
            </div>
            <div class="form-group">
                <label for="enclosure_size">Enclosure Size:</label>
                <input type="text" class="form-control" id="enclosure_size" name="enclosure_size" placeholder="Enter Enclosure Size" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="enclosure.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
