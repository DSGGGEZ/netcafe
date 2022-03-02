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
    $sql = "SELECT * FROM computer_tier";
    $results = $conn->query($sql);
?>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
    <h1>NET Cafe Admin </h1>
    <div>
    <h4><a href="index.php" >Checkin</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="res.php" >Reservation</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="member.php" >Member</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="com.php" >Computer</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="ct.php" >Computer tier</a><a href="logout.php" class="btn btn-danger pull-right" style="margin-left: 10px">Logout</a>
    <a href="addct.php" class="btn btn-info pull-right" style="margin-left: 10px">Add Computer Tier</a><h4>
    <div>
    </div>
    <br>
</div>
    <table class="table table-bordered" style="margin-top: 20px">
        <thead>
            <tr>
                <th>ComputerTier Number</th>
                <th>CPU</th>
                <th>GPU</th>
                <th>RAM</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $results->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['idcomputer_tier'] ?></td>
                <td><?php echo $row['CPU']?></td>
                <td><?php echo $row['GPU']?></td>
                <td><?php echo $row['RAM']?></td>
                <td class="text-center">
                    <a href="editct.php?idcomputer_tier=<?php echo $row['idcomputer_tier'] ?>" class="btn btn-sm btn-info">
                        <span class="glyphicon glyphicon-edit"></span>
                    <a href="deletect.php?idcomputer_tier=<?php echo $row['idcomputer_tier'] ?>" class="btn btn-sm btn-danger">
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
