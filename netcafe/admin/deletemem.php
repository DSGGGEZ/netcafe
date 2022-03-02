<?php
require('lock.php');
require('../dbconnect.php');

$idmember = $_GET['idmember'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Prepare sql and bind parameters
    $sql = "delete from member where idmember = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('s', $idmember);
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
    <title>NET Cafe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">

<h1>NET Cafe | Member <small></small></h1>


    <?php
    $sql = "select name from member where idmember = $idmember";
    $name = $conn->query($sql);
    $row = $name->fetch_assoc();
    ?>
    <p>คุณต้องการจะลบสมาชิกหมายเลข '<?php echo $row['name'] ?>'?</p>

    <form method="post" class="form">
        <input class="btn btn-danger" type="submit" value="Delete">
        <a href="member.php" class="btn btn-default">Cancel</a>
    </form>

<?php
$conn->close();
?>
</body>
</html>