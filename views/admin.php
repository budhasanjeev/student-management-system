<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/4/2016
 * Time: 2:03 PM
 */
session_start();

if(!isset($_SESSION["email"])){
    header("Location: login.php");
}
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
<div class="container" style="padding: 10px;">
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
                    Birthday today
                </div>
                <div class="row" style="font-size: 18px;">5</div>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="info-box" style="background-color: #47666b">
            <div class="col-md-4" style="font-size: 50px;"><span class="glyphicon glyphicon-user"></span></div>
            <div class="col-md-8">
                <div class="row" style="font-size: 20px;">
                    Appoints today
                </div>
                <div class="row" style="font-size: 18px;">14</div>
            </div>
        </div>
    </div>

    <div class="row" style="padding: 20px; margin-top: 120px;">
        <img src="../images/graph.jpg" width="100%" height="500px" alt=""/>
    </div>
</div>

</body>
</html>