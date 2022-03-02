<?php
require('lock.php');
require('../dbconnect.php');
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>NET Cafe Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">
<?php
$price = isset($_GET['price']) ? $_GET['price'] : "";
if ($price != "") {
    $sql = "SELECT * FROM computer LEFT JOIN  computer_tier ON computer.idcomputer_tier=computer_tier.idcomputer_tier WHERE computer.price = '$price'";
}
else {
    $sql = "SELECT * FROM computer LEFT JOIN  computer_tier ON computer.idcomputer_tier=computer_tier.idcomputer_tier";
}
    $results = $conn->query($sql);
?>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
    <h1>NET Cafe Admin </h1>
    <div>
    <h4><a href="index.php" >Checkin</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="res.php" >Reservation</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="member.php" >Member</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="com.php" >Computer</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="ct.php" >Computer tier</a><a href="logout.php" class="btn btn-danger pull-right" style="margin-left: 10px">Logout</a>
    <a href="addcom.php" class="btn btn-info pull-right" style="margin-left: 10px">Add Computer</a><h4>
    <div>
    </div>
    <br>
</div>
<form method="get" class="form-inline">
        Price: &nbsp;
        <input type="text" name="price" class="form-control" placeholder="price">
        <input class="btn btn-primary" type="submit" value="Filter">
    </form>
    <table class="table table-bordered" style="margin-top: 20px">
        <thead>
            <tr>
                <th>Computer Number</th>
                <th>Spec</th>
                <th>price</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $results->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['idcomputer'] ?></td>
                <td><ul>
                    <li><?php echo $row['CPU']?></li>
                    <li><?php echo $row['GPU']?></li>
                    <li><?php echo $row['RAM']?></li>
                </ul></td>
                <td><?php echo $row['price'] ?></td>
                <td class="text-center">
                    <a href="editcom.php?idcomputer=<?php echo $row['idcomputer'] ?>" class="btn btn-sm btn-info">
                        <span class="glyphicon glyphicon-edit"></span>
                    <a href="deletecom.php?idcomputer=<?php echo $row['idcomputer'] ?>" class="btn btn-sm btn-danger">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

<?php
$conn->close();
?>
</body>
</html>
