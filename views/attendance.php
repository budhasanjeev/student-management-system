<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/15/2016
 * Time: 7:42 PM
 */

session_start();
$role = $_SESSION['role'];
if($role == "Receptionist") {

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


    $month = date("F");
    $year = date("o");

    function getAttendanceDay($class_id, $month, $year, $connection)
    {

        $select = "select DISTINCT day from attendance where class_id = '$class_id' && month = '$month' && year = '$year'";
        $attendance = $connection->query($select);
        return $attendance;

    }


    function getAttendance($student_id, $day, $month, $year, $connection)
    {
        $select = "select status from attendance where `student_id` = '$student_id' && `day` = '$day' && MONTH = '$month' && YEAR = '$year'";
//    echo $select."</br>";
        $attendance = $connection->query($select);
        while ($row = $attendance->fetch_assoc()) {
            $a = $row["status"];
            return $a;
        }
    }

    ?>


    <div class="container">
        <div class="col-md-2 vm">
            <ul>
                <?php
                $class = getClass($connection);
                while ($row = $class->fetch_assoc()) {
                    ?>
                    <li>
                        <a href="teacher.php?id=<?php echo $row["id"]; ?>"><?php echo $row["class"]; ?></a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
        <div class="col-md-10">
            <h2>Hello!</h2>
        </div>
    </div>

    <script>
        $('#attendance-table').dataTable();
    </script>
    </body>
    </html>

<?php
}else{
    session_unset();
    header("Location: logout.php");
}
?>