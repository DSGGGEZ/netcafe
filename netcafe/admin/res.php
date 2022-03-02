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
    $sql = "SELECT * FROM reservation LEFT JOIN computer ON computer.idcomputer=reservation.idcomputer LEFT JOIN computer_tier ON computer.idcomputer_tier=computer_tier.idcomputer_tier LEFT JOIN member ON member.idmember=reservation.idmember";
    $results = $conn->query($sql);
?>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
    <h1>NET Cafe Admin </h1>
    <div>
    <h4><a href="index.php" >Checkin</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="res.php" >Reservation</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="member.php" >Member</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="com.php" >Computer</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="ct.php" >Computer tier</a><a href="logout.php" class="btn btn-danger pull-right" style="margin-left: 10px">Logout</a>
    <a href="addres.php" class="btn btn-info pull-right" style="margin-left: 10px">จอง</a><h4>
    <div>
    </div>
    <br>
</div>

    <table class="table table-bordered" style="margin-top: 20px">
        <thead>
            <tr>
                <th>Computer NO</th>
                <th>Member ID</th>
                <th>time</th>
                <th>Date</th>
                <th>Reservation Time</th>
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
                <td><?php echo $row['idmember']?>  <?php echo $row['name']?></td>
                <td><?php echo $row['time'] ?></td>
                <td><?php echo $row['date'] ?></td>
                <td><?php echo $row['restime'] ?></td>
                <td><?php $reprice=$row['time']*$row['price']; echo $reprice ?></td>
                <td class="text-center">
                    <a href="deleteres.php?idreservation=<?php echo $row['idreservation'] ?>" class="btn btn-sm btn-danger">
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
