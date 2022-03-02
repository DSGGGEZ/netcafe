<?php
    require('dbconnect.php');
    require('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>NET Cafe | reservation stat</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">
<?php
$idmember = isset($_GET['idmember']) ? $_GET['idmember'] : "";
if ($idmember != "") {
    $sql = "SELECT * FROM reservation LEFT JOIN computer ON computer.idcomputer=reservation.idcomputer LEFT JOIN computer_tier ON computer.idcomputer_tier=computer_tier.idcomputer_tier LEFT JOIN member ON member.idmember=reservation.idmember WHERE reservation.idmember = '$idmember'";
}
else {
    $sql = "SELECT * FROM reservation LEFT JOIN computer ON computer.idcomputer=reservation.idcomputer LEFT JOIN computer_tier ON computer.idcomputer_tier=computer_tier.idcomputer_tier LEFT JOIN member ON member.idmember=reservation.idmember";
}
    $results = $conn->query($sql);
?>

    <h1>Reservation</h1>
    <form method="get" class="form-inline">
        Member id: &nbsp;
        <input type="text" name="idmember" class="form-control" placeholder="name">
        <input class="btn btn-primary" type="submit" value="Filter">
    </form>

    <table class="table table-bordered" style="margin-top: 20px">
        <thead>
            <tr>
                <th>Computer Number</th>
                <th>Member name</th>
                <th>time</th>
                <th>Date Time</th>
                <th>Reservation Time</th>
                <th>price</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $results->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['idcomputer'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['time'] ?></td>
                <td><?php echo $row['date'] ?></td>
                <td><?php echo $row['restime'] ?></td>
                <td><?php $reprice=$row['time']*$row['price']; echo $reprice ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
<?php
require('footer.php');
?>
</body>
</html>