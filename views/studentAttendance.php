<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/7/2016
 * Time: 8:05 PM
 */
session_start();


$sid = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Student Management</title>

</head>
<body>
<?php include 'layout/header.php' ?>
<div class="container">
    <legend>Attendance of <?php echo getStudentName($sid, $connection); ?> of month <?php echo date("F")." ".date("o"); ?></legend>
    <table class="table table-responsive table-bordered">
        <thead>
        <th>Date</th>
        <th>Status</th>
        </thead>
    <?php
    $attendance = getStudentAttendance($sid, $connection);

    while($row = $attendance->fetch_assoc()){
        $status = $row['status'];
        ?>

            <tr class="<?php echo $status; ?>">
                <td><?php echo $row['day']; ?></td>
                <td><?php echo $status; ?></td>
            </tr>

    <?php
    }
    ?>
    </table>

</div>
</body>
</html>