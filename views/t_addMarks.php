<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/18/2016
 * Time: 11:05 AM
 */

$class_id = $_GET['class'];
$subject_id = $_GET['sub'];
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

    <legend>Marks for <strong><?php echo getSubjectName($subject_id, $connection) ?></strong> of class <strong><?php echo getClassName($class_id, $connection) ?></strong></legend>
    <form action="../controller/c_addMarks.php" method="post">
        <input type="hidden" name="class_id" value="<?php echo $class_id ?>"/>
        <input type="hidden" name="subject_id" value="<?php echo $subject_id ?>"/>
        <select class="form-control" name="exam" id="">
            <option value="first">First Term</option>
            <option value="second">Second Term</option>
            <option value="third">Third Term</option>
            <option value="final">Final Term</option>
        </select>
        <br/><br/>
    <table class="table table-responsive">
        <thead>
        <th>Student</th>
        <th>Marks</th>
        </thead>

    <?php
    $students = getClassStudents(getClassName($class_id, $connection), $connection);
    while($row = $students->fetch_assoc()){
        ?>
<tr>
    <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
    <td><input class="form-control" type="number" name="<?php echo $row['id']; ?>"/></td>
</tr>
    <?php
    }
    ?>    </table>
    <input type="submit" value="ADD" class="btn btn-primary btn-block"/>
    </form>
</div>
</body>
</html>