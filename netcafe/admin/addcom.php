<?php
require('lock.php');
require('../dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $idcomputer = $_POST['idcomputer'];
    $idcomputer_tier = $_POST['idcomputer_tier'];
	$price = $_POST['price'];
    

    $sql = "INSERT INTO computer(idcomputer,idcomputer_tier,price) VALUES (?,?,?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('sss',$idcomputer,$idcomputer_tier,$price);
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
    <title>NET Cafe | Computer</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">

    <h1>NET Cafe |<small>Computer</small></h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="idcomputer">Computer NO</label>
            <input type="text" class="form-control" name="idcomputer" required>
        </div>
        <div class="form-group">
            <label for="idcomputer_tier">Computer Tier</label>
            <select name="idcomputer_tier" class="form-control" required>
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
            <input type="text" class="form-control" name="price" required>
        </div>
        <input class="btn btn-success" type="submit" value="เพิ่ม"> 
        <a href="com.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?>
</body>
</html>