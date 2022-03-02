<?php
require('lock.php');
require('../dbconnect.php');

$idreservation = $_GET['idreservation'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Prepare sql and bind parameters
    $sql = "delete from reservation where idreservation = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $idreservation);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: res.php');
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

<h1>NET Cafe | Reservation <small></small></h1>


    <?php
    $sql = "select idreservation from reservation where idreservation = $idreservation";
    $name = $conn->query($sql);
    $row = $name->fetch_assoc();
    ?>
    <p>คุณต้องการจะลบการจองเลขที่ '<?php echo $row['idreservation'] ?>'?</p>

    <form method="post" class="form">
        <input class="btn btn-danger" type="submit" value="Delete">
        <a href="res.php" class="btn btn-default">Cancel</a>
    </form>

<?php
$conn->close();
?>
</body>
</html>