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
$name = isset($_GET['name']) ? $_GET['name'] : "";
if ($name != "") {
    $sql = "SELECT * FROM member WHERE name = '$name'";
}
else {
    $sql = "SELECT * FROM member";
}
    $results = $conn->query($sql);
?>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
    <h1>NET Cafe Admin </h1>
    <div>
    <h4><a href="index.php" >Checkin</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="res.php" >Reservation</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="member.php" >Member</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="com.php" >Computer</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="ct.php" >Computer tier</a><a href="logout.php" class="btn btn-danger pull-right" style="margin-left: 10px">Logout</a>
    <a href="addmem.php" class="btn btn-info pull-right" style="margin-left: 10px">Register Member</a><h4>
    <div>
    </div>
    <br>
</div>
<form method="get" class="form-inline">
    Name: &nbsp;
        <input type="text" name="name" class="form-control" placeholder="name">
        <input class="btn btn-primary" type="submit" value="Filter">
    </form>
    <table class="table table-bordered" style="margin-top: 20px">
        <thead>
            <tr>
                <th>Member id</th>
                <th>Name</th>
                <th>Address ID</th>
                <th>City</th>
                <th>Zipcode</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $results->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['idmember'] ?></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['address'] ?></td>
                <td><?php echo $row['city'] ?></td>
                <td><?php echo $row['zipcode']?></td>
                <td class="text-center">
                    <a href="editmem.php?idmember=<?php echo $row['idmember'] ?>" class="btn btn-sm btn-info">
                        <span class="glyphicon glyphicon-edit"></span>
                    <a href="deletemem.php?idmember=<?php echo $row['idmember'] ?>" class="btn btn-sm btn-danger">
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
