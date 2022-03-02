<?php
require('lock.php');
require('../dbconnect.php');

$idcheckin = $_GET['idcheckin'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Prepare sql and bind parameters
    $sql = "delete from member_has_computer where idcheckin = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $idcheckin);
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
    <title>NET Cafe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">

<h1>NET Cafe | Checkin<small></small></h1>


    <?php
    $sql = "select idcheckin from member_has_computer where idcheckin = $idcheckin";
    $name = $conn->query($sql);
    $row = $name->fetch_assoc();
    ?>
    <p>คุณต้องการจะลบการ checkin เลขที่ '<?php echo $row['idcheckin'] ?>'?</p>

    <form method="post" class="form">
        <input class="btn btn-danger" type="submit" value="Delete">
        <a href="index.php" class="btn btn-default">Cancel</a>
    </form>

<?php
$conn->close();
?>
</body>
</html>