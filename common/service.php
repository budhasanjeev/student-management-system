<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 11/13/2016
 * Time: 1:28 PM
 */

include "../config/databaseConnection.php";


$month = date("F");
$year = date("o");
$day = date("j");


if(isset($_POST['actionname'])){
    $actionname = $_POST['actionname'];
    if($actionname == 'getsubject'){
        $finaloutput = array();
        $classid = $_POST['classid'];
        $finaloutput = getSubject($classid,$connection);
          echo json_encode($finaloutput);
    }

}
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
    $i = 0;
    $output = array();
    while($subject = $sub->fetch_assoc())
    {
        $eachOutput = array("subjectName"=>$subject["subject_name"],"id"=>$subject["id"]);
        $output[$i++] = $eachOutput;
    }
   return $output;
}

function getClassSubject($class_id, $connection){
    $select = "SELECT * FROM `subject` WHERE `class_id` = '$class_id'";
    $subject = $connection->query($select);
    return $subject;
}



function addClassSubject($class_id, $subject_id, $teacher_id, $connection){
    $insert = "INSERT INTO `teacher_subject`(`teacher_id`, `subject_id`, `class_id`) VALUES ($teacher_id, $subject_id, $class_id)";
    $connection->query($insert);
}

function getTeacherSubject($teacherID, $connection){
    $select = "SELECT * FROM `teacher_subject` WHERE `teacher_id` = '$teacherID'";
    $teacher = $connection->query($select);
    return $teacher;
}


function getSubjectName($sid, $connection){
    $select = "SELECT * FROM `subject` WHERE `id` = '$sid'";
    $name = $connection->query($select);
    while($row = $name->fetch_assoc()){
        $n = $row["subject_name"];
        return $n;
    }
}


function getSubjectTeacher($subjectID, $connection){
    $select = "SELECT * FROM `teacher_subject` WHERE `id` = '$subjectID'";
    $teacherid = $connection->query($select);
    while($row = $teacherid->fetch_assoc()){
        $n = getTeacherInfo($row["teacher_id"], $connection);
        while($r = $n->fetch_assoc()){
            return $r['name'];
        }
    }
}

function getTotalStudent($connection){
    $select = "SELECT COUNT(*) FROM `student`";
    $count = $connection->query($select);
    return $count;
}


function getAbsentCount($connection){

    $month = date("F");
    $year = date("o");
    $day = date("j");

    $select = "SELECT COUNT(*) FROM `attendance` WHERE `status` = 'absent' && `year` = '$year' && `month` = '$month'&& `day` = '$day'";
    $count = $connection->query($select);
    return $count;
}

function getAbsentStudent($connection){

    $month = date("F");
    $year = date("o");
    $day = date("j");

    $select = "SELECT * FROM `attendance` WHERE `status` = 'absent' && `year` = '$year' && `month` = '$month'&& `day` = '$day'";
    $count = $connection->query($select);
    return $count;
}



function getBirthdayCount($connection){
    $today = DATE("Y-m-d");
    $select = "SELECT COUNT(*) FROM `student` where 'dob' = '$today'";
    $count = $connection->query($select);
    return $count;
}



function getBirthdayStudent($connection){
    $today = DATE("Y-m-d");
    $select = "SELECT * FROM `student` where 'dob' = '$today'";
    $count = $connection->query($select);
    return $count;
}


