<?php
require('lock.php');
require('../dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $CPU = $_POST['CPU'];
    $GPU = $_POST['GPU'];
	$RAM = $_POST['RAM'];
    

    $sql = "INSERT INTO computer_tier(CPU,GPU,RAM) VALUES (?,?,?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('sss',$CPU,$GPU,$RAM);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: ct.php');
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>NET Cafe | Computer Tier</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">

    <h1>NET Cafe |<small>Computer Tier</small></h1>

    <form method="post" class="form">
    <div class="form-group">
            <label for="CPU">CPU</label>
            <input type="text" class="form-control" name="CPU" required>
        </div>
        <div class="form-group">
            <label for="GPU">GPU</label>
            <input type="text" class="form-control" name="GPU" required>
        </div>
        <div class="form-group">
            <label for="RAM">RAM</label>
            <input type="text" class="form-control" name="RAM" required>
        </div>
        <input class="btn btn-success" type="submit" value="เพิ่ม"> 
        <a href="ct.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?>
</body>
</html>