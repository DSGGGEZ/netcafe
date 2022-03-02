<?php
require('lock.php');
require('../dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $idmember = $_POST['idmember'];
    $name = $_POST['name'];
	$address = $_POST['address'];
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];
    

    $sql = "INSERT INTO member(idmember,name,address,city,zipcode) VALUES (?,?,?,?,?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('sssss',$idmember,$name,$address,$city,$zipcode);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: member.php');
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>NET Cafe | Register Member</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">

    <h1>NET Cafe |<small>Register</small></h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="idmember">Member id</label>
            <input type="text" class="form-control" name="idmember" required>
        </div>
        <div class="form-group">
            <label for="name">Member name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" name="address" required>
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" name="city" required>
        </div>
        <div class="form-group">
            <label for="zipcode">Zipcode</label>
            <input type="text" class="form-control" name="zipcode" required>
        </div>
        <input class="btn btn-success" type="submit" value="Register"> 
        <a href="member.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?>
</body>
</html>