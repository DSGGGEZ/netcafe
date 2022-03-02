<?php
    require('dbconnect.php');
    require('header.php');

$sql = "SELECT * FROM computer LEFT JOIN computer_tier ON computer.idcomputer_tier=computer_tier.idcomputer_tier";
$results = $conn->query($sql);
?>
    <h1>Computer Reservation<small></small></h1>
    <div class="row">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>Computer Number</th>
                    <th>Spec</th>
                    <th>price</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php
                    while($row = $results->fetch_assoc()) {
                    echo '<tr>
                            <td>'.$row['idcomputer'].'</td>
                            <td>
                            <ul>
                                <li>'.$row['CPU'].'</li>
                                <li>'.$row['GPU'].'</li>
                                <li>'.$row['RAM'].'</li>
                            </ul>
                            </td>
                            <td>'.$row['price'].' baht </td>
                            <td><center><a href="reservation.php?idcomputer='.$row['idcomputer'].'" class="btn btn-success" role="button">จอง</a></center></td>
                        <tr>';
                    }
                    ?>
                </tbody>
            </table>
    </div>

<?php
require('footer.php');
?>
