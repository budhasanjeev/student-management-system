<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/4/2016
 * Time: 2:03 PM
 */
session_start();
if($_SESSION['role'] == "Admin" || $_SESSION['role'] == "sAdmin"){

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
    <div class="col-lg-4">
        <div class="info-box" style="background-color: #a07789">
            <div class="col-md-4" style="font-size: 50px;"><span class="glyphicon glyphicon-user"></span></div>
            <div class="col-md-8">
                <div class="row" style="font-size: 20px;">
                    Total Students
                </div>
                <div class="row" style="font-size: 18px;"><?php $total = getTotalStudent($connection);
                    while($row = $total->fetch_assoc()){
                        echo $row['COUNT(*)'];
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <a href="absent.php"><div class="col-lg-4">
        <div class="info-box" style="background-color: #533443">
            <div class="col-md-4" style="font-size: 50px;"><span class="glyphicon glyphicon-user"></span></div>
            <div class="col-md-8">
                <div class="row" style="font-size: 20px;">
                    Absent Today
                </div>
                <div class="row" style="font-size: 18px;"><?php $total = getAbsentCount($connection);

                        while($row = $total->fetch_assoc()){
                            $count = $row['COUNT(*)'];
                            if($count != 0){
                                echo $count;
                            }else{
                                ?>
                                <span style="color: red">Attendance not taken</span>
                            <?php
                            }
                        }
                ?></div>
            </div>
        </div>
    </div></a>


    <a href="a_appoints.php"><div class="col-lg-4">
        <div class="info-box" style="background-color: #47666b">
            <div class="col-md-4" style="font-size: 50px;"><span class="glyphicon glyphicon-user"></span></div>
            <div class="col-md-8">
                <div class="row" style="font-size: 20px;">
                    Appoints today
                </div>
                <div class="row" style="font-size: 18px;">
                    <?php $total = getTodayAppointCount($connection);
                    while($row = $total->fetch_assoc()){
                        $count = $row['COUNT(*)'];
                        if($count != 0){
                            echo $count;
                        }else{
                            ?>
                            <span style="color: red">No Appointments Today</span>
                        <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div></a>

    <div class="row" style="padding: 20px; margin-top: 120px;">
        <img src="../img/ohiocharters1.png" width="100%" height="500px" alt=""/>
    </div>
</div>

    <?php
    }else{
        header("Location: logout.php");
    }
?>

</body>
</html>
