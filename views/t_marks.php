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

    <div class="row">
        <legend>Exam Marks</legend>
    </div>

    <?php
    $teacherClass = getTeacherSubject($_SESSION['teacher_id'], $connection);
    while($row = $teacherClass->fetch_assoc()){
        $cid = $row['class_id'];
        $sid = $row['subject_id'];
        ?>
        <a href="t_addMarks.php?class=<?php echo $cid; ?>&sub=<?php echo $sid; ?>">
            <div class="col-lg-3">
                <div class="box" style="padding: 15px;">
                <table class="table table-responsive table-bordered" style="text-align: center;">
                    <tr>
                    <td>Class</td>
                    <td>Subject</td>
                    </tr>
                <tr>
                    <td><strong>
                        <?php
                        echo getClassName($cid, $connection);
                        ?></strong>
                    </td>
                    <td><strong>
                        <?php
                        echo getSubjectName($sid, $connection);
                        ?></strong>
                    </td>
                </tr>
                </table>
                </div>
            </div>
        </a>

    <?php
    }
    ?>


</div>
</body>
</html>
