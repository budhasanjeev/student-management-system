<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 11/13/2016
 * Time: 1:28 PM
 */

include "../config/databaseConnection.php";

function addClass($name, $connection){
    $insert = "INSERT INTO `class`(`class`) VALUES ('$name')";
    $connection->query($insert);
}


function getClass($connection){
    $select = "select * from class";
    $class = $connection->query($select);
    return $class;
}

function getClassName($id, $connection){
    $select = "select class from class where id = $id";
    $class = $connection->query($select);
    
    while($row = $class->fetch_assoc()){
        $name = $row["class"];
    }
    return $name;
}

function getClassStudents($name, $connection){
    $select = "select * from student where grade = '$name'";
    $student = $connection->query($select);
    return $student;
}


function getStudentInfo($sid, $connection){
    $select = "select * from student where id = '$sid'";
    $student = $connection->query($select);
    return $student;
}

function getStudentName($sid, $connection){
    $select = "select name from student where id = '$sid'";
    $name = $connection->query($select);
    while($row = $name->fetch_assoc()){
        $n = $row["name"];
    }
    return $n;
}



//function getClassAttendance($class_id, $month, $year, $connection){
//    $select = "select * from attendance where class_id = '$class_id' & month = '$month' & year = '$year'";
//    $attendance = $connection->query($select);
//    return $attendance;
//}
//
//
//function getAttendance($student_id, $day, $month, $year, $connection){
//    $select = "select status from attendance where `student_id` = '$student_id' & `day` = '$day' & MONTH = '$month' & YEAR = '$year'";
//    $attendance = $connection->query($select);
//    while($row = $attendance->fetch_assoc()){
//        $a = $row["status"];
//    }
//    return $a;
//}