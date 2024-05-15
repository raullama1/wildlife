<?php session_start();

// Check if the user is not logged in, redirect to index.php
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit();
} ?>

<!DOCTYPE html>
<html>
<head>
    <title>Wildlife Park Menu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://media.istockphoto.com/id/1203327078/vector/abstract-background-of-smooth-curves.jpg?s=612x612&w=0&k=20&c=ybD3C-N3ZUX9abrp4XHrpSRhwubH0DiZ1-ZuZLWTBnY=');
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body>

<?php include 'menu.php';?>

<div class="container mt-5">
    <h2>Case Study</h2>
    <p>
        Go Wild Wildlife Park, located in the Jaya Setia Square, requires a management information system. As an IT consultant, you have been tasked with creating a relational database to store records of animals, keepers, enclosures, and species.  </p>
    <!-- <br> -->
    <p>   The park cares for endangered animals from around the world and employs keepers of different ranks: senior, standard, and junior. Each animal is assigned to a specific keeper, who may have multiple animals under their care. The park uses various enclosure types, such as moats, fields, and aquariums, to house multiple animals. Each animal is assigned to a single enclosure, and feeding times are specified for each animal species. You are allowed to have more than four tables if they are related to the system.
    </p>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
