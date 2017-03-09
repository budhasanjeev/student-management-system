<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/7/2016
 * Time: 9:31 PM
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
<body>
<?php include 'layout/header.php';

?>

<div class="container">

    <!--edit fee Modal -->
    <div id="editFeeModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Payed Fee</h4>
                </div>
                <div class="modal-body">
                    <form class="form" action="../controller/c_editNews.php" method="post">

                        <input type="hidden" name="id" id="feeID">
                        <input type="hidden" name="sid" value="<?php echo $_GET['sid']; ?>">

                        <div class="form-group">
                            <label for="class">Change Amount: </label>
                            <input class="form-control" type="text" name="newAmount" required=""/>
                        </div>
                        <div style="text-align: right">
                            <button type="submit" class="btn btn-success">Change</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>



    <!--Payed Fee Modal -->
    <div id="payedFeeModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Enter Payed Fee</h4>
                </div>
                <div class="modal-body">
                    <form class="form" action="../controller/payedFeeController.php" method="post">
                        <input type="hidden" name="student_id" value="<?php echo $_GET['sid']; ?>">
                        <div class="form-group">
                            <label for="">Payed Date:</label>
                            <input type="date" class="form-control" name="date" required="">
                        </div>
                        <div class="form-group">
                            <label for="">Payed Amount:</label>
                            <input type="number" class="form-control" name="amount" required="">
                        </div>

                        <div style="text-align: right">
                            <button type="submit" class="btn btn-success">Add</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <?php

    $sid = $_GET['sid'];
    $info = getStudentInfo($sid, $connection);
    $attendanceStatus = getAttendanceStatus($sid, $connection);


    if ($_SESSION['role'] == 'Parents') {
        $AStat = getStudentAttendanceStatus($sid, $connection);
        if ($AStat == 'absent' || $AStat == 'leave') {
            ?>
            <div class="notif"><?php echo $AStat; ?> today!</div>
            <?php
        }
    }
    ?>
    <div class="col-lg-3">
        <?php
        while ($row = $info->fetch_assoc()) {
            ?>

            <div class="row" style="text-align: center;">
                <img width="100%" height="200px" src="../img/<?php echo $row["photo"] ?>">
            </div>
            <h2><?php echo $row["first_name"] . " " . $row["last_name"]; ?></h2>
            <div class="row">
                <table class="table table-striped table-responsive">
                    <tr>
                        <td>Address</td>
                        <td>: <?php echo $row["address"]; ?></td>
                    </tr>
                    <tr>
                        <td>Class</td>
                        <td>: <?php echo $row["grade"] . " " . $row["section"]; ?></td>
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
            <li class="active"><a data-toggle="tab" href="#perform" style="color: #000000 !important;">Performance</a>
            </li>
            <li><a data-toggle="tab" href="#Attendance" style="color: #000000 !important;">Attendance</a></li>
            <li><a data-toggle="tab" href="#Fee" style="color: #000000 !important;">Fee</a></li>
        </ul>

        <div class="tab-content">
            <div id="perform" class="c_tab tab-pane fade in active">
                <br/><br/>
                <legend>Exam Marks</legend>
                <?php
                $class = getExam($connection);
                while ($row = $class->fetch_assoc()) {
                    ?>
                    <form action="markSheet.php" method="post" id="<?php echo $row['exam']; ?>">
                        <input type="hidden" name="exam" value="<?php echo $row['exam']; ?>"/>
                        <input type="hidden" name="sid" value="<?php echo $sid; ?>"/>
                        <div class="col-lg-3" onclick="submitForm('#<?php echo $row['exam']; ?>')">
                            <div class="box" style="height: 150px;">
                                <?php echo $row['exam']; ?>
                            </div>
                        </div>
                    </form>
                    <?php
                }
                ?>
            </div>
            <div id="Attendance" class="c_tab tab-pane fade">
                <!--                <h3>Attendance of this month</h3>--> <br/><br/>
                <div id="piechart" style="padding-left: 20%; boarder"></div>
            </div>
            <div id="Fee" class="c_tab tab-pane fade">
                <br/><br/>
                <?php
                $info = getStudentInfo($sid, $connection);
                $row = $info->fetch_assoc();
                $result = getTotalFee(getClassID($row['grade'], $connection), $connection);

                if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin') {
                    ?>
                    <a data-toggle="modal" data-target="#payedFeeModal" class="btn btn-block btn-primary">Enter payed
                        fee</a>
                    <?php
                }

                if ($result->num_rows > 0) {
                    $totalFee = $result->fetch_assoc();
                    $payed = getPayedFee($sid, $connection);

                    ?>
                    <h4 style="text-align: center;">Total fee for this academic year: </h4>
                    <div class="adjust">Rs <?php echo $totalFee['total']; ?>/-</div>

                    <?php
                    if ($payed->num_rows > 0) {
                        $totalPayed = 0;
                        while ($p = $payed->fetch_assoc()){
                            $totalPayed = $totalPayed + $p['paid'];
                        }
                        $per = ($totalPayed/$totalFee['total'])*100;
                        ?>

                        <div id="myProgress">
                            <?php
                            if($per > 100){
                                $p = 100;
                            }else{
                                $p = $per;
                            }
                            ?>
                            <div id="myBar" style="width: <?php echo $p; ?>%;">
                                <div id="label"> Payed  <?php echo round($per,2); ?>%</div>
                            </div>
                        </div>

                        <table class="table table-responsive table-bordered">

                        <thead style="background-color: whitesmoke;">
                        <th>Payed Date</th>
                        <th>Payed Amount</th>
                        </thead>

                        <?php
                        $payed = getPayedFee($sid, $connection);
                        while ($row = $payed->fetch_assoc()){
                           ?>
                            <tr>
                                <td><?php echo $row['date']; ?></td>
                                <td>Rs <?php echo $row['paid']; ?>/- &nbsp;
                                    <?php
                                    if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin') {
                                        ?>
                                        <span style="float: right;">
                                        <a data-toggle="modal" data-target="#editFeeModal" onclick="setModelInId('<?php echo $row['id']; ?>')" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"> </span> Edit</a>
                                        <a href="../controller/deleteFee.php?id=<?php echo $row['id']; ?>&sid=<?php echo $_GET['sid']; ?>&lid=<?php echo $_GET['lid']; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-trash"> </span> Delete</a>
                                        </span>
                                        <?php
                                    }
                                    ?>

                                </td>

                            </tr>
                            <?php
                        }
                        ?>
                            <tr style="background-color: whitesmoke;">
                                <td><strong>Total:</strong></td>
                                <td><strong>Rs <?php echo $totalPayed; ?>/-</strong></td>
                            </tr>
                        </table>
                            <?php
                    } else {
                        ?>
                        <h4>No payment recorded</h4>
                        <?php
                    }
                    ?>

                    <?php

                } else {
                    echo '<h4>Fee not added yet</h4>';
                }
                ?>
            </div>
        </div>
    </div>



    <script type="text/javascript">

        function setModelInId(id) {
            $('#feeID').val(id);
        }

        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Status', 'Number'],
                <?php
                while ($row = mysqli_fetch_array($attendanceStatus)) {
                    echo "['" . $row["status"] . "', " . $row["number"] . "],";
                }
                ?>
            ]);
            var options = {
                title: 'Attendance of this month till date',
                'width': 600,
                'height': 500,
                'border': 1,
                is3D: true
//                pieHole: 0.4
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }

        function submitForm(id) {
            $(id).submit();
        }

    </script>

</body>
</html>