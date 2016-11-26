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
                            <td>Address</td>
                            <td>: <?php echo $row["address"]; ?></td>
                        </tr>
                        <tr>
                            <td>Class</td>
                            <td>: <?php echo $row["grade"]." ".$row["section"]; ?></td>
                        </tr>
                        <tr>
                            <td>Roll .no</td>
                            <td>: <?php echo $row["roll_number"]; ?></td>
                        </tr>
                        <tr>
                            <td>Father</td>
                            <td>: <?php echo $row["father_name"]; ?></td>
                        </tr>
                        <tr>
                            <td>Mother</td>
                            <td>: <?php echo $row["mother_name"]; ?></td>
                        </tr>
                        <tr>
                            <td>Contact</td>
                            <td>: <?php echo $row["contact_number"]; ?></td>
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
                <br/><br/>
                <legend>Exam Marks</legend>
                <div class="col-lg-3">
                    <div class="box">
                        First Term
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="box">
                        Second Term
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="box">
                        Third Term
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="box">
                        First Term
                    </div>
                </div>
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