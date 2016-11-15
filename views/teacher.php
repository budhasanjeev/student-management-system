<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/15/2016
 * Time: 7:42 PM
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
<?php
include 'layout/header.php';

$class_id = $_GET["id"];
$month = date("F");
$year = date("o");

function getClassAttendance($class_id, $month, $year, $connection){

    $select = "select * from attendance where class_id = '$class_id' && month = '$month' && year = '$year'";
    $attendance = $connection->query($select);
    return $attendance;

}


function getAttendance($student_id, $day, $month, $year, $connection){
    $select = "select status from attendance where `student_id` = '$student_id' && `day` = '$day' && MONTH = '$month' && YEAR = '$year'";
    echo $select."</br>";
    $attendance = $connection->query($select);
    while($row = $attendance->fetch_assoc()){
        $a = $row["status"];
        return $a;
    }
}
?>


<div class="container">
    <div class="col-md-1">
        <table class="table table-responsive">
            <?php
            $class = getClass($connection);
            while($row = $class->fetch_assoc()){
                ?>
                <tr>
                    <td><a href="teacher.php?id=<?php echo $row["id"]; ?>"><?php echo $row["class"]; ?></a></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <div class="col-md-11">
        <legend>Attendance of <?php echo getClassName($class_id, $connection); ?><span class="pull-right"><?php echo $month." ".$year; ?></span></legend>

        <form action="../controller/attendanceController.php?id=<?php echo $class_id; ?>" method="post">
        <table class="table table table-responsive table-bordered table-striped table-fixed">
            <thead>
                <th></th>
                <th><?php echo date("j"); ?></th>
                <?php
                $day = getClassAttendance($class_id, $month, $year, $connection);
                $day_array = array();
                $i = 0;
                while($row = $day->fetch_assoc()){
                    $day_array[$i] = $row["day"];
                    $i++;
                }
                echo count($day_array);
                for($i=0; $i < count($day_array); $i++) {
                    ?>
                    <th><?php echo $day_array[$i]; ?></th>
                <?php
                }
                ?>
            </thead>
            <tbody style="background-color: blanchedalmond;">
            <?php
            $classStudent = getClassStudents(getClassName($class_id, $connection), $connection);
            $i = 0;
            while($row = $classStudent->fetch_assoc()){
                ?>
                <tr>
                    <th>
                        <?php
                        echo $row["first_name"]." ".$row["last_name"]; ?></th>
                    <td>
                        <select name="<?php echo $row["id"]; ?>">
                            <option value="present">Present</option>
                            <option value="absent">Absent</option>
                            <option value="leave">Leave</option>
                        </select>
                    </td>
                    <?php
                    foreach ($day_array as &$att_day) {
                        $attendance = getAttendance($row["id"], $att_day, $month, $year, $connection);
                        ?>
                        <td><?php echo $attendance; ?></td>
                    <?php
                    }
                    ?>
                </tr>
            <?php
            }
            ?>
            </tbody>


        </table>
            <input class="btn btn-primary" value="Done" type="submit"/>
        </form>
    </div>
</div>
</body>
</html>