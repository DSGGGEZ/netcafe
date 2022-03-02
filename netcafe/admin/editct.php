<?php
require('lock.php');
require('../dbconnect.php');

$idcomputer_tier = $_GET['idcomputer_tier'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    $CPU = $_POST['CPU'];
    $GPU = $_POST['GPU'];
	$RAM = $_POST['RAM'];

    // Prepare sql and bind parameters
    $sql = "UPDATE computer_tier SET CPU =? , GPU =? , RAM = ? WHERE idcomputer_tier = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('sssi',$CPU,$GPU,$RAM,$idcomputer_tier);
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
    <title>NET Cafe </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">
    <?php
        $sql = "select * from computer_tier where idcomputer_tier = '$idcomputer_tier'";
        $res = $conn->query($sql);
        $line = $res->fetch_assoc();
    ?>
    <h1>NET Cafe |<small>Edit Computer Tier</small></h1>
    <form method="post" class="form">
        <div class="form-group">
            <label for="CPU">CPU</label>
            <input type="text" class="form-control" name="CPU" value="<?php echo $line['CPU'] ?>" required>
        </div>
        <div class="form-group">
            <label for="GPU">GPU</label>
            <input type="text" class="form-control" name="GPU" value="<?php echo $line['GPU'] ?>" required>
        </div>
        <div class="form-group">
            <label for="RAM">RAM</label>
            <input type="text" class="form-control" name="RAM" value="<?php echo $line['RAM'] ?>" required>
        </div>
        <input class="btn btn-success" type="submit" value="แก้ไข"> 
        <a href="ct.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?>
</body>
</html>