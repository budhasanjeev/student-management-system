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
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/style.css"/>
</head>
<body>
<?php include'../layout/header.php'; ?>
<div class="row" style="padding: 10px;">


    <div class="col-lg-3">
        <div class="info-box" style="background-color: #a07789">
            <div class="col-md-4" style="font-size: 50px;"><span class="glyphicon glyphicon-user"></span></div>
            <div class="col-md-8">
                <div class="row" style="font-size: 20px;">
                    Total Students
                </div>
                <div class="row" style="font-size: 18px;">100</div>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="info-box" style="background-color: #533443">
            <div class="col-md-4" style="font-size: 50px;"><span class="glyphicon glyphicon-user"></span></div>
            <div class="col-md-8">
                <div class="row" style="font-size: 20px;">
                    Absent Today
                </div>
                <div class="row" style="font-size: 18px;">100</div>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="info-box" style="background-color: #aba992">
            <div class="col-md-4" style="font-size: 50px;"><span class="glyphicon glyphicon-user"></span></div>
            <div class="col-md-8">
                <div class="row" style="font-size: 20px;">
                    Total Students
                </div>
                <div class="row" style="font-size: 18px;">100</div>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="info-box" style="background-color: #47666b">
            <div class="col-md-4" style="font-size: 50px;"><span class="glyphicon glyphicon-user"></span></div>
            <div class="col-md-8">
                <div class="row" style="font-size: 20px;">
                    Total Students
                </div>
                <div class="row" style="font-size: 18px;">100</div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
    <a href="user.php">
        <div class="col-lg-8 col-space">
            <div class="btn btn-block option-box">
                <h4>User</h4>
            </div>
        </div>
    </a>

    <a href="student.php">
    <div class="col-lg-4 col-space">
        <div class="btn btn-block option-box">
            <h4>Students</h4>
        </div>
    </div>
    </a>

    <a href="routine.php">
    <div class="col-lg-4 col-space">
        <div class="btn btn-block option-box">
            <h4>Routine</h4>
        </div>
    </div>
    </a>

    <a href="fee.php">
    <div class="col-lg-8 col-space">
        <div class="btn btn-block option-box">
            <h4>Fee</h4>
        </div>
    </div>
    </a>

    <a href="attendance.php">
    <div class="col-lg-8 col-space">
        <div class="btn btn-block option-box">
            <h4>Attendance</h4>
        </div>
    </div>
    </a>

    <a href="attendance.php">
        <div class="col-lg-4 col-space">
            <div class="btn btn-block option-box">
                <h4>Attendance</h4>
            </div>
        </div>
    </a>
    </div>
</div>

</body>
</html>