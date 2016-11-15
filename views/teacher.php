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
    $attendance = $connection->query($select);
    while($row = $attendance->fetch_assoc()){
        $a = $row["status"];
    }
    return $a;
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

        <form action="">
        <table class="table table table-responsive table-bordered table-striped table-fixed">
            <thead>
                <th></th>
                <th><?php echo date("j"); ?></th>
                <?php
                $day = getClassAttendance($class_id, $month, $year, $connection);
                $day_array = array();
                while($row = $day->fetch_assoc()){
                    $i = 0;
                    $day_array[$i] = $row["day"];
                    $i++;
                }
                for($i=0; $i < count($day_array); $i++) {
                    ?>
                    <th><?php echo $day_array[$i]; ?></th>
                <?php
                }
                ?>
            </thead>
            <tbody>
            <?php
                $classAttendance = getClassAttendance($class_id, $month, $year, $connection);
            while($row = $classAttendance->fetch_assoc()){
                $i = 0;
                ?>
                <tr>
                    <th><?php
                        $sid = $row["student_id"];
                        echo getStudentName($sid, $connection); ?></th>
                    <td>
                        <select name="<?php echo $sid; ?>">
                            <option value="absent">Absent</option>
                            <option value="present">Present</option>
                            <option value="leave">Leave</option>
                        </select>
                    </td>
                    <?php
                    foreach ($day_array as &$value) {
                        $attendance = getAttendance($row["student_id"], $value, $month, $year, $connection);
                        ?>
                        <td><?php echo $attendance; ?>/td>
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