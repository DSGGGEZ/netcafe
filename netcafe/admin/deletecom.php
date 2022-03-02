<?php
require('lock.php');
require('../dbconnect.php');

$idcomputer = $_GET['idcomputer'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Prepare sql and bind parameters
    $sql = "delete from computer where idcomputer = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $idcomputer);
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

<h1>NET Cafe | Computer<small></small></h1>


    <?php
    $sql = "select idcomputer from computer where idcomputer = $idcomputer";
    $name = $conn->query($sql);
    $row = $name->fetch_assoc();
    ?>
    <p>คุณต้องการจะลบคอมพิวเตอร์เครื่องที่ '<?php echo $row['idcomputer'] ?>'?</p>

    <form method="post" class="form">
        <input class="btn btn-danger" type="submit" value="ลบ">
        <a href="com.php" class="btn btn-default">Cancel</a>
    </form>

<?php
$conn->close();
?>
</body>
</html>