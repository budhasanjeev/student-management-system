<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/16/2016
 * Time: 1:55 PM
 */

session_start();

if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin'){
$student_id = $_GET['id'];

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

    <legend>Performance of <b>Class <?php echo getClassName($_GET['id'], $connection); ?></b></legend>

    <table class="table table-responsive table-bordered table-striped">
    <thead>
    <th>Name</th>
    <?php
    $exam = getExam($connection);
    while($row = $exam->fetch_assoc()){
        ?>
        <th><?php echo $row['exam']; ?></th>
    <?php
    }
    ?>
    </thead>
        <tbody>
        <?php
    $stdArray = array();
    $students = getClassStudents(getClassName($_GET['id'], $connection), $connection);
    while($std = $students->fetch_assoc()){
        ?>
        <tr>
            <td><?php echo $std['first_name']." ".$std['last_name']; ?></td>
        <?php
        $totalFull = 0;
        $totalPass = 0;
        $totalObtained = 0;
        $exam = getExam($connection);
        while($e = $exam->fetch_assoc()){
            ?>
            <td>
            <?php
            $marks = getExamMarks($e['exam'], $std['id'], $connection);
            while($m = $marks->fetch_assoc()){
                $totalFull = $totalFull + $m['fullmarks'];
                $totalPass = $totalPass + $m['passmarks'];
                $totalObtained = $totalObtained + $m['marks'];

            }
            $per = ($totalObtained/$totalFull)*100;
            $stdArray[$std['id']] = $per;
            echo round($per,2);
            ?>
            </td>
            <?php
        }
        ?>
        </tr>
        <?php
    }
    ?>
        </tbody>
    </table>


    <?php
    $max = max($stdArray);
    $avg = array_sum($stdArray) / count($stdArray);
    $min = min($stdArray);
    ?>
    <table class="table table-responsive">
        <thead>
        <th colspan="3" style="text-align: center">This is of Latest Exam</th>
        </thead>
        <thead>
        <th>Highest</th>
        <th>Average</th>
        <th>Lowest</th>
        </thead>
        <tr>
            <td><?php echo round($max,2); ?></td>
            <td><?php echo round($avg,2); ?></td>
            <td><?php echo round($min,2); ?></td>
        </tr>
    </table>
</div>
</body>
</html>

<?php
}else{
    header('Location: logout.php');
}
?>

