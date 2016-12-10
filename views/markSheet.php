<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/10/2016
 * Time: 1:23 PM
 */

$exam = $_POST['exam'];
$sid = $_POST['sid'];

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
$marks = getExamMarks($exam, $sid, $connection);
$studentInfo = getStudentInfo($sid, $connection);
$student = $studentInfo->fetch_assoc();
?>
<div class="container">
    <table class="table table-bordered">
        <thead>
        <th>Name</th>
        <th style="border-left: 0px;"><?php echo ": ".$student['first_name']." ".$student['last_name'] ?></th>
        <th>Class</th>
        <th style="border-left: 0px;"><?php echo ": ".ucfirst($student['grade'])." ".$student['section'] ?></th>
        <th>Roll</th>
        <th style="border-left: 0px;"><?php echo ": ".$student['roll_number'] ?></th>
        </thead>
        <thead>
        <th colspan="6" style="text-align: center;">
            <h4><?php echo ucfirst($exam); ?> Term Marks Sheet</h4>
        </th>
        </thead>
        <tbody class="table-striped">
        <tr>
            <td colspan="3"><strong>Subject</strong></td>
            <td><strong>Full Marks</strong></td>
            <td><strong>Pass Marks</strong></td>
            <td><strong>Obtained Marks</strong></td>
        </tr>
        <?php
        $totalFull = 0;
        $totalPass = 0;
        $totalObtained = 0;
        $fail = 0;
        while($row = $marks->fetch_assoc()){
            ?>
            <tr>
                <td colspan="3"><?php echo getSubjectName($row['subject_id'], $connection) ?></td>
                <td><?php echo $row['fullmarks'] ?></td>
                <td><?php echo $row['passmarks'] ?></td>
                <?php
                if($row['marks']<$row['passmarks']){
                    ?>
                    <td><?php echo $row['marks']; $fail = 1; ?> F</td>
                <?php
                }else{
                    ?>
                    <td><?php echo $row['marks'] ?></td>
                <?php
                }
                ?>

            </tr>
        <?php
            $totalFull = $totalFull + $row['fullmarks'];
            $totalPass = $totalPass + $row['passmarks'];
            $totalObtained = $totalObtained + $row['marks'];
            $per = ($totalObtained/$totalFull)*100;
        }
        ?>
        <tr>
            <td colspan="3"><strong>Total</strong></td>
            <td><strong><?php echo $totalFull ?></strong></td>
            <td><strong><?php echo $totalPass ?></strong></td>
            <td><strong><?php echo $totalObtained ?></strong></td>
        </tr>
        <tr></tr>
        <tr>
            <td colspan="2"><strong>Status</strong></td>
            <td><strong><?php
                if($fail == 1){
                    echo "Fail";
                }else{
                    if (50 <= $per && $per < 60) {
                        echo "Second Division";
                    } elseif (60 <= $per && $per < 80) {
                        echo "First Division";
                    } elseif ($per >= 80) {
                        echo "Distinction";
                    } elseif ($per < 50) {
                        echo "Third Division";
                    }
                }
                ?></strong></td>
            <td colspan="2"><strong>Percentage</strong></td>
            <td><?php echo $per."%"; ?></td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>