<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/18/2016
 * Time: 1:39 PM
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
    $lid = $_GET['lid'];
    $sid = $_GET['sid'];
    $info = getStudentInfo($sid, $connection);
    ?>

    <div class="row">
        <legend><a href="t_marks.php">Class</a>/<a href="a_student.php?id=<?php echo $lid; ?>">students</a>/profile</legend>
    </div>

        <div class="col-lg-3">
            <?php
            while($row = $info->fetch_assoc()) {
                ?>
                <h2><?php echo $row["first_name"]." ".$row["last_name"]; ?></h2>
                <div class="row" style="text-align: center;">
                    <img width="100%" height="200px" src="../img/<?php echo $row["photo"] ?>">
                </div>
                <div class="row">
                    <table class="table table-striped table-responsive">
                        <tr>
                            <td><span class="glyphicon glyphicon-home"></span></td>
                            <td><?php echo $row["address"]; ?></td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-phone"></span></td>
                            <td><?php echo $row["contact_number"]; ?></td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-phone"></span></td>
                            <td><?php echo $row["grade"]; ?></td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-phone"></span></td>
                            <td><?php echo $row["section"]; ?></td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-phone"></span></td>
                            <td><?php echo $row["roll_number"]; ?></td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon">Father</span></td>
                            <td><?php echo $row["father_name"]; ?></td>
                        </tr>
                        <tr>
                            <td><span class="glyphicon glyphicon-phone">Mother</span></td>
                            <td><?php echo $row["mother_name"]; ?></td>
                        </tr>
                    </table>
                </div>
            <?php
            }
            ?>
        </div>

    <div class="col-md-9" style="padding-left: 50px;">
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a data-toggle="tab" href="#perform">Performance</a></li>
            <li><a data-toggle="tab" href="#Attendance">Attendance</a></li>
            <li><a data-toggle="tab" href="#Achievements">Achievements</a></li>
        </ul>

        <div class="tab-content">
            <div id="perform" class="c_tab tab-pane fade in active">
                <h3>Yearly</h3>
                <p>Some content.</p>
            </div>
            <div id="Attendance" class="c_tab tab-pane fade">
                <h3></h3>
                <p>Some content in menu 1.</p>
            </div>
            <div id="Achievements" class="c_tab tab-pane fade">
                <h3>Menu 2</h3>
                <p>Some content in menu 2.</p>
            </div>
        </div>
    </div>
</body>
</html>