<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/18/2016
 * Time: 11:05 AM
 */
session_start();

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
    while($row = mysqli_fetch_assoc($parentsInfo)) {
        $student_id = $row["student_id"];
        $student_ids = explode(",",$student_id);
        $number_child = sizeof($student_ids);
        if($number_child>1){
            $_SESSION['multiChild'] = 1;
        }
    }

    for($i = 0; $i < $number_child; $i++){
        $sid = $student_ids[$i];
        ?>
        <a href="a_profile.php?sid=<?php echo $sid;?>">
            <div class="col-md-3">
                <div class="box">
                    <?php
                    echo getStudentName($sid, $connection);
                    ?>
                </div>
            </div>
        </a>
    <?php
    }
    ?>
</div>
</body>
</html>