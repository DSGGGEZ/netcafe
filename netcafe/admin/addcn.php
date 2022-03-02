<?php
require('lock.php');
require('../dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $idcomputer = $_POST['idcomputer'];
	$idmember = $_POST['idmember'];
    $time = $_POST['time'];
	$date = $_POST['date'];
    $cntime = $_POST['cntime'];
    

    $sql = "INSERT INTO member_has_computer(idcomputer,idmember,time,date,cntime) VALUES (?,?,?,?,?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('sssss',$idcomputer,$idmember,$time,$date,$cntime);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: index.php');
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>NET Cafe | Check in</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">

    <h1>NET Cafe |<small>Check in</small></h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="idcomputer">Computer NO</label>
            <input type="text" class="form-control" name="idcomputer" required>
        </div>
        <div class="form-group">
            <label for="idmember">Member ID</label>
            <input type="text" class="form-control" name="idmember" required>
        </div>
        <div class="form-group">
            <label for="time">Time</label>
            <input type="text" class="form-control" name="time" required>
        </div>
        <div class="form-group">
            <label for="idbranch_store">Date</label>
            <input type="date" class="form-control" name="date" value="<?php $t=date('Y-m-d'); echo $t ?>" required>
        </div>
        <div class="form-group">
            <label for="cntime">Checkin Time</label>
            <input type="time" class="form-control" name="cntime" min="00:00" max="24:00" required>
        </div>
        <input class="btn btn-success" type="submit" value="จอง"> 
        <a href="index.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?>
</body>
</html>