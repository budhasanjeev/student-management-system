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


function getClassID($name, $connection){
    $select = "select id from class where class = '$name'";
    $class = $connection->query($select);

    while($row = $class->fetch_assoc()){
        $id = $row["id"];
    }
    return $id;
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
    $select = "select * from student where id = '$sid'";
    $name = $connection->query($select);
    while($row = $name->fetch_assoc()){
        $n = $row["name"];
        return $n;
    }
}

function addAttendance($return_class, $sid, $month, $day, $year, $status, $connection){
    $insert = "INSERT INTO `attendance`(`class_id`, `student_id`, `year`, `month`, `day`, `status`) VALUES ($return_class,$sid,'$year','$month','$day','$status')";
    $connection->query($insert);
}

function getTeacherInfo($teacherID, $connection){
    $select = "select * from teacher where id = '$teacherID'";
    $teacher = $connection->query($select);
    return $teacher;
}

function addSubject($subject, $class_ID, $connection){
    $insert = "INSERT INTO `subject`(`subject_name`, `class_id`) VALUES ('$subject',$class_ID)";
    $connection->query($insert);
}

function getSubject($classID, $connection){
    $select = "select * from subject where class_id = '$classID'";
    $sub = $connection->query($select);
    return $sub;
}

