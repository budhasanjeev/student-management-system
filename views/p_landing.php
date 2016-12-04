<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/18/2016
 * Time: 11:05 AM
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
    <?php
    $pid = $_SESSION['user_id'];
    $parentsInfo = getParentsInfo($pid, $connection);
    while($row = mysqli_fetch_assoc($parentsInfo)){
        $student_id = $row["student_id"];
        $student_ids = explode(",",$student_id);
        $number_child = sizeof($student_ids);
    }
    ?>
 </div>
</body>
</html>