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


if (isset($_POST['actionname'])) {
    $actionname = $_POST['actionname'];
    if ($actionname == 'getsubject') {
        $finaloutput = array();
        $classid = $_POST['classid'];
        $finaloutput = getSubject($classid, $connection);
        echo json_encode($finaloutput);
    }

}
function addClass($name, $connection)
{
    //validation of class is needed i.e. check whether class is already entered or not
    $insert = "INSERT INTO `class`(`class`) VALUES ('$name')";
    $connection->query($insert);
}


function getClass($connection)
{
    $select = "select * from class";
    $class = $connection->query($select);
    return $class;
}


function getClassID($name, $connection)
{
    $select = "select id from class where class = '$name'";
    $class = $connection->query($select);

    while ($row = $class->fetch_assoc()) {
        $id = $row["id"];
    }
    return $id;
}


function getClassName($id, $connection)
{
    $select = "select class from class where id = $id";
    $class = $connection->query($select);

    while ($row = $class->fetch_assoc()) {
        $name = $row["class"];
    }
    return $name;
}

function getClassStudents($name, $connection)
{
    $select = "select * from student where grade = '$name'";
    $student = $connection->query($select);
    return $student;
}


function getStudentInfo($sid, $connection)
{
    $select = "select * from student where id = '$sid'";
    $student = $connection->query($select);
    return $student;
}

function getAllStudent($connection)
{

    $select = "select * from student";
    $student = $connection->query($select);
    return $student;

}

function getStudentName($sid, $connection)
{
    $select = "select * from student where id = '$sid'";
    $name = $connection->query($select);
    while ($row = $name->fetch_assoc()) {
        $n = $row["first_name"];
        return $n;
    }
}

function addAttendance($return_class, $sid, $month, $day, $year, $status, $connection)
{
    $insert = "INSERT INTO `attendance`(`class_id`, `student_id`, `year`, `month`, `day`, `status`) VALUES ($return_class,$sid,'$year','$month','$day','$status')";
    $connection->query($insert);
}

function getTeacherInfo($teacherID, $connection)
{
    $select = "select * from teacher where id = '$teacherID'";
    $teacher = $connection->query($select);
    return $teacher;
}

function getTeacher($connection)
{
    $select = "select * from teacher";
    $teacher = $connection->query($select);
    return $teacher;
}


function addSubject($subject, $class_ID, $connection)
{
    $insert = "INSERT INTO `subject`(`subject_name`, `class_id`) VALUES ('$subject',$class_ID)";
    $connection->query($insert);
}

function getSubject($classID, $connection)
{
    $select = "select * from subject where class_id = '$classID'";
    $sub = $connection->query($select);
    $i = 0;
    $output = array();
    while ($subject = $sub->fetch_assoc()) {
        $eachOutput = array("subjectName" => $subject["subject_name"], "id" => $subject["id"]);
        $output[$i++] = $eachOutput;
    }
    return $output;
}

function getClassSubject($class_id, $connection)
{
    $select = "SELECT * FROM `subject` WHERE `class_id` = '$class_id'";
    $subject = $connection->query($select);
    return $subject;
}


function addClassSubject($class_id, $subject_id, $teacher_id, $connection)
{
    $select = "SELECT * FROM `teacher_subject` WHERE `subject_id` = $subject_id && `class_id` = $class_id";
    $t = $connection->query($select);


    if(isset($t)){
        $delete = "DELETE FROM `teacher_subject` WHERE `subject_id` = $subject_id && `class_id` = $class_id";
        $connection->query($delete);
    }

        $insert = "INSERT INTO `teacher_subject`(`teacher_id`, `subject_id`, `class_id`) VALUES ($teacher_id, $subject_id, $class_id)";
        $connection->query($insert);
}

function getTeacherSubject($teacherID, $connection)
{
    $select = "SELECT * FROM `teacher_subject` WHERE `teacher_id` = '$teacherID'";
    $teacher = $connection->query($select);
    return $teacher;
}


function getSubjectName($sid, $connection)
{
    $select = "SELECT * FROM `subject` WHERE `id` = '$sid'";
    $name = $connection->query($select);
    while ($row = $name->fetch_assoc()) {
        $n = $row["subject_name"];
        return $n;
    }
}


function getSubjectTeacher($subjectID, $connection)
{
    $select = "SELECT * FROM `teacher_subject` WHERE `subject_id` = '$subjectID'";
    $teacher_id = $connection->query($select);
    $row = $teacher_id->fetch_assoc();
    $t_id = $row['teacher_id'];
    $n = getTeacherInfo($t_id, $connection);
    $r = $n->fetch_assoc();
    return $r['name'];

}

function getTotalStudent($connection)
{
    $select = "SELECT COUNT(*) FROM `student`";
    $count = $connection->query($select);
    return $count;
}


function getAbsentCount($connection)
{

    $month = date("F");
    $year = date("o");
    $day = date("j");

    $select = "SELECT COUNT(*) FROM `attendance` WHERE `status` = 'absent' && `year` = '$year' && `month` = '$month'&& `day` = '$day'";
    $count = $connection->query($select);
    return $count;
}

function getAbsentStudent($connection)
{

    $month = date("F");
    $year = date("o");
    $day = date("j");

    $select = "SELECT * FROM `attendance` WHERE `status` = 'absent' && `year` = '$year' && `month` = '$month'&& `day` = '$day'";
    $count = $connection->query($select);
    return $count;
}


function getBirthdayCount($connection)
{
    $today = DATE("m-d");
    $select = "SELECT COUNT(*) FROM `student` where 'dob' = '$today'";
    $count = $connection->query($select);
    return $count;
}


function getBirthdayStudent($connection)
{
    $today = DATE("m-d");
    $select = "SELECT * FROM `student` where 'dob' = '$today'";
    $count = $connection->query($select);
    return $count;
}


function getTodayAppointCount($connection)
{
    $today = DATE("Y-m-d");
    $select = "SELECT COUNT(*) FROM `appointment` where `purposed_date` = '$today'";
    $count = $connection->query($select);
    return $count;
}


function getTodayAppoint($connection)
{
    $today = DATE("Y-m-d");
    $select = "SELECT * FROM `appointment` where `purposed_date` = '$today'";
    $count = $connection->query($select);
    return $count;
}


function getAttendanceStatus($sid, $connection)
{
    $month = date("F");
    $year = date("o");
    $day = date("j");

    $select = "SELECT status, count(*) as number FROM `attendance` WHERE `student_id` = $sid && `year` = '$year' && `month` = '$month' GROUP BY status  ";
    $count = $connection->query($select);
    return $count;
}

function getParentsInfo($pid, $connection)
{
    $select = "select * from user where id = '$pid'";
    $parents = $connection->query($select);
    return $parents;
}

function getStudentAttendance($student_id, $connection)
{
    $month = date("F");
    $year = date("o");
    $select = "select * from attendance where `student_id` = '$student_id' && MONTH = '$month' && YEAR = '$year'";
    $attendance = $connection->query($select);
    return $attendance;
}


function makeAppointment($agenda, $date, $time, $parentsID, $connection)
{
    $insert = "INSERT INTO `appointment`(`purpose`, `purposed_date`, `prefered_time`, `parent_id`) VALUES ('$agenda','$date','$time','$parentsID')";
    $connection->query($insert);
}

function getExam($connection)
{
    $select = "SELECT DISTINCT `exam` FROM marks";
    $result = $connection->query($select);
    return $result;
}

function getExamMarks($exam, $sid, $connection)
{
    $select = "SELECT * FROM `marks` WHERE `exam` = '$exam' && `student_id` = $sid";
//    echo $select;
    $result = $connection->query($select);
    return $result;
}

function getClassPerformance($sid, $connection, $exam)
{
    $select = "SELECT * FROM `marks` WHERE `exam` = '$exam' && `student_id` = $sid";
}

function upgradeStudents($connection)
{

    $select_students = getAllStudent($connection);
    $select_classes = getClass($connection);

    $classes = [];

    $errorCount = 0;
    $successCount = 0;

    while ($row = mysqli_fetch_array($select_classes)) {
        $classes[] = $row['class'];
    }

    $next_class = null;

    while ($row = mysqli_fetch_assoc($select_students)) {

        $student_class = $row['grade'];

        if ($student_class == 'Nursery') {

            foreach ($classes as $class) {
                if ($class == 'LKG') {
                    $next_class = 'LKG';
                } else if ($class == 'UKG') {
                    $next_class = 'LKG';
                } else if ($class == 'KG') {
                    $next_class = 'KG';
                }
            }
        } else if ($student_class == 'LKG') {
            $next_class = 'UKG';
        } else if ($student_class == 'UKG' || $student_class == 'KG' && in_array('One', $classes)) {
            $next_class = 'One';
        } else if ($student_class == 'One' && in_array('Two', $classes)) {
            $next_class = 'Two';
        } else if ($student_class == 'Two' && in_array('Three', $classes)) {
            $next_class = 'Three';
        } else if ($student_class == 'Three' && in_array('Four', $classes)) {
            $next_class = 'Four';
        } else if ($student_class == 'Four' && in_array('Five', $classes)) {
            $next_class = 'Five';
        } else if ($student_class == 'Five' && in_array('Six ', $classes)) {
            $next_class = 'Six';
        } else if ($student_class == 'Six' && in_array('Seven', $classes)) {
            $next_class = 'Seven';
        } else if ($student_class == 'Seven' && in_array('Eight', $classes)) {
            $next_class = 'Eight';
        } else if ($student_class == 'Eight' && in_array('Nine', $classes)) {
            $next_class = 'Nine';
        } else if ($student_class == 'Nine' && in_array('Ten', $classes)) {
            $next_class = 'Ten';
        } else if ($student_class == 'Ten' && in_array('Eleven', $classes)) {
            $next_class = 'Eleven';
        } else if ($student_class == 'Eleven' && in_array('Twelve', $classes)) {
            $next_class = 'Twelve';
        } else if ($student_class == 'Twelve') {
            $next_class = 'Completed';
        } else {
            $next_class = 'Completed';
        }

        $upgrade_query = "update student set grade = '$next_class' where grade = '$student_class'";

        if ($connection->query($upgrade_query)) {
            $successCount++;
        } else {
            $errorCount++;
        }

    }
    $data['errorCount'] = $errorCount;
    $data['successCount'] = $successCount;

    return $data;
}

function deleteSubject($id, $connection)
{
    $delete = "DELETE FROM `subject` WHERE `id` = $id";
    $connection->query($delete);
}

function validateUsername($username, $connection){
    $select = "SELECT * FROM `user` WHERE `username` = '$username'";
    $result = $connection->query($select);

    $data = array();

    if(mysqli_num_rows($result)>0){
        $data['message']='success';
    }
    else{
        $data['message']='fail';
    }

    return json_encode($data);
}

function validateEmail($email, $connection){
    $select = "SELECT * FROM `user` WHERE `email` = '$email'";
    $result = $connection->query($select);

    $data = array();

    if(mysqli_num_rows($result)>0){
        $data['message']='success';
    }
    else{
        $data['message']='fail';
    }

    return json_encode($data);
}

function validateStudentID($id, $connection){
    $select = "SELECT * FROM `student` WHERE `student_id` = '$id'";
    $result = $connection->query($select);

    $data = array();

    if(mysqli_num_rows($result)>0){
        $data['message']='success';
    }
    else{
        $data['message']='fail';
    }

    return json_encode($data);
}

function checkAttendance($class, $connection){

    $month = date("F");
    $year = date("o");
    $day = date("j");

    $select = "SELECT * FROM `attendance` WHERE `class_id` = $class && `year` = '$year' && `month` = '$month' && `day` = '$day'";
//    echo $select;
    $result = $connection->query($select);
    if(mysqli_num_rows($result) > 0){
        return "done";
    }else{
        return "remain";
    }
}