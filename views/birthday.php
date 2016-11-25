<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/4/2016
 * Time: 2:03 PM
 */

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Student Management</title>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/style.css"/>
</head>
<body>
<?php include 'layout/header.php'; ?>
<div class="container">
    <legend>Birthday Today</legend>
    <table class="table table-responsive table-striped">
        <thead>
        <th>Name</th>
        <th>Class</th>
        <th>Contact</th>
        <th>Address</th>
        </thead>
        <?php
            $studentInfo = getBirthdayStudent($connection);
            while($r = $studentInfo->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $r["first_name"]." ".$r["last_name"]; ?></td>
                    <td><?php echo $r["grade"] ?></td>
                    <td><?php echo $r["contact_number"] ?></td>
                    <td><?php echo $r["address"] ?></td>
                </tr>
            <?php
        }
        ?>
    </table>
</div>
</body>
</html>