<?php
require('lock.php');
require('../dbconnect.php');

$idcomputer = $_GET['idcomputer'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    $idcomputer = $_POST['idcomputer'];
    $idcomputer_tier = $_POST['idcomputer_tier'];
	$price = $_POST['price'];

    // Prepare sql and bind parameters
    $sql = "UPDATE computer SET idcomputer =? , idcomputer_tier =? , price = ? WHERE idcomputer = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('sssi',$idcomputer,$idcomputer_tier,$price,$idcomputer);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: com.php');
    
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>NET Cafe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">
    <?php
        $sql = "select * from computer where idcomputer = '$idcomputer'";
        $res = $conn->query($sql);
        $line = $res->fetch_assoc();
    ?>
    <h1>NET Cafe |<small>Edit Computer</small></h1>
    <form method="post" class="form">
        <div class="form-group">
            <label for="idcomputer">Computer NO</label>
            <input type="text" class="form-control" name="idcomputer" value="<?php echo $line['idcomputer'] ?>" required>
        </div>
        <div class="form-group">
            <label for="idcomputer_tier">Computer Tier</label>
            <select name="idcomputer_tier" class="form-control" value="<?php echo $line['idcomputer_tier'] ?>" required>
                <?php
                $idplatform = $conn->query('select * from computer_tier');
                while($row = $idplatform->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row['idcomputer_tier'] ?>"><?php echo $row['CPU'] ?> <?php echo $row['GPU'] ?> <?php echo $row['RAM'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" class="form-control" name="price" value="<?php echo $line['price'] ?>" required>
        </div>
        <input class="btn btn-success" type="submit" value="แก้ไข"> 
        <a href="com.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?>
</body>
</html>