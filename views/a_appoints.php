<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/7/2016
 * Time: 9:31 PM
 */
session_start();

if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin'){


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
<?php include 'layout/header.php';
?>

<div class="container">
    <legend>Appoints Today</legend>

    <table class="table table-responsive table-bordered">
        <thead>
        <th>s/n</th>
        <th>Parents Name</th>
        <th>Child</th>
        <th>Agenda</th>
        <th>Time</th>
        <th>Contact no</th>
        </thead>
        <?php
        $i = 1;
        $appointments = getTodayAppoint($connection);
        while($row = $appointments->fetch_assoc()){
            $purpose = $row['purpose'];
            $time = $row['prefered_time'];
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <?php
                $parents = getParentsInfo($row['parent_id'], $connection);
                $p = $parents->fetch_assoc();
                $fName = $p['first_name'];
                $lName = $p['last_name'];
                $student_id = $p["student_id"];
                $student_ids = explode(",",$student_id);
                $number_child = sizeof($student_ids);
                ?>
                <td><?php echo $fName." ".$lName ?></td>
                <td><?php
                for($j=0; $j<$number_child; $j++){
                    echo getStudentName($student_ids[$j], $connection).", ";
                }
                    ?></td>
                <td><?php echo $purpose; ?></td>
                <td><?php echo $time; ?></td>
                <td><?php
                    $contact = getStudentInfo($student_ids[$j-1], $connection);
                    $c = $contact->fetch_assoc();
                    echo $c['contact_number'];
                    ?></td>
            </tr>
        <?php
        }
        ?>

    </table>
</div>

</body>
</html>

<?php
}else{
    header('Location: logout.php');
}
?>