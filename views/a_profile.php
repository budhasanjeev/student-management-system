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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
<body>
<?php include 'layout/header.php';

?>

<div class="container">
    <?php

    $sid = $_GET['sid'];
    $info = getStudentInfo($sid, $connection);
    $attendanceStatus = getAttendanceStatus($sid, $connection);


    if($_SESSION['role'] != "Parents"){
        $lid = $_GET['lid'];
        ?>
        <div class="row">
            <legend><a href="t_marks.php">Class</a>/<a href="a_student.php?id=<?php echo $lid; ?>">students</a>/profile</legend>
        </div>
    <?php
    }
    ?>
        <div class="col-lg-3">
            <?php
            while($row = $info->fetch_assoc()) {
                ?>

                <div class="row" style="text-align: center;">
                    <img width="100%" height="200px" src="../img/<?php echo $row["photo"] ?>">
                </div>
                <h2><?php echo $row["first_name"]." ".$row["last_name"]; ?></h2>
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
<!--                <h3>Attendance of this month</h3>--> <br/><br/>
                <div id="piechart" style="padding-left: 20%; boarder"></div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart()
        {
            var data = google.visualization.arrayToDataTable([
                ['Status', 'Number'],
                <?php
                while($row = mysqli_fetch_array($attendanceStatus))
                {
                     echo "['".$row["status"]."', ".$row["number"]."],";
                }
                ?>
            ]);
            var options = {
                title: 'Attendance of this month till date',
                'width':600,
                'height':500,
                'border':1,
                is3D:true
//                pieHole: 0.4
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>

</body>
</html>