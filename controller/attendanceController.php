<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 11/15/2016
 * Time: 10:28 AM
 */

include "../config/databaseConnection.php";
include  '../common/service.php';

$month = date("F");
$year = date("o");
$day = date("j");

$return_class = $_GET["id"];

$classStudent = getClassStudents(getClassName($return_class, $connection), $connection);


$student_array = array();
$i = 0;

while($row = $classStudent->fetch_assoc()){
    $student_array[$i] = $row["id"];
//    echo $row["id"];
    $i++;
}



for($i = 0; $i < count($student_array); $i++){
    $status = $_POST["$student_array[$i]"];
//    echo $student_array[$i]." ".$status;
    addAttendance($return_class, $student_array[$i], $month, $day, $year, $status, $connection);
}

header("Location: ../views/teacher.php?id=$return_class");
