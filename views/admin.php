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
        <div class="info-box" style="background-image: url('../img/image.gif');">
<!--            <div class="col-md-4" style="font-size: 50px;"><span class="glyphicon glyphicon-user"></span></div>-->
            <div class="overlay-back">
                <div class="row" style="font-size: 20px;">
                   <h1>Total Students</h1>
                </div>
                <div class="row" style="font-size: 18px;"><?php $total = getTotalStudent($connection);
                    while($row = $total->fetch_assoc()){
                        ?>
                        <span class="data"><?php echo $row['COUNT(*)']; ?></span>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <a href="absent.php"><div class="col-lg-4">
        <div class="info-box" style="background-image: url('../img/RESTRICTED_AP51712149_xru65d.jpg');">
            <div class="overlay-back">
                <div class="row" style="font-size: 20px;">
                    <h1>Absent Today</h1>
                </div>
                <div class="row" style="font-size: 18px;"><?php $total = getAbsentCount($connection);

                        while($row = $total->fetch_assoc()){
                            $count = $row['COUNT(*)'];
                            if($count != 0){
                                ?>
                                <span class="data"><?php echo $count; ?></span>
                                <?php
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
        <div class="info-box" style="background-image: url('../img/appoint.JPG');">
            <div class="overlay-back">
                <div class="row" style="font-size: 20px;">
                    <h1>Appoints today</h1>
                </div>
                <div class="row" style="font-size: 18px;">
                    <?php $total = getTodayAppointCount($connection);
                    while($row = $total->fetch_assoc()){
                        $count = $row['COUNT(*)'];
                        if($count != 0){
                            ?>
                            <span class="data"><?php echo $count; ?></span>
                            <?php
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

</div>

    <?php
    }else{
        header("Location: logout.php");
    }
?>

</body>
</html>
