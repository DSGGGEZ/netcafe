<?php
require('lock.php');
require('../dbconnect.php');

$idcomputer_tier = $_GET['idcomputer_tier'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Prepare sql and bind parameters
    $sql = "delete from computer_tier where idcomputer_tier = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $idcomputer_tier);
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
    <title>NET Cafe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">

<h1>NET Cafe | Computer<small></small></h1>


    <?php
    $sql = "select idcomputer_tier from computer_tier where idcomputer_tier = $idcomputer_tier";
    $name = $conn->query($sql);
    $row = $name->fetch_assoc();
    ?>
    <p>คุณต้องการจะลบ Computer Tier ที่'<?php echo $row['idcomputer_tier'] ?>'?</p>

    <form method="post" class="form">
        <input class="btn btn-danger" type="submit" value="ลบ">
        <a href="ct.php" class="btn btn-default">Cancel</a>
    </form>

<?php
$conn->close();
?>
</body>
</html>