<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 11/20/2016
 * Time: 8:33 PM
 */

include "../config/databaseConnection.php";
include  '../common/service.php';

$exam = $_POST["exam"];
$subject_id = $_POST["subject_id"];
$class_id = $_POST["class_id"];
$full = $_POST["fullMarks"];
$pass = $_POST["passMarks"];

$students = getClassStudents(getClassName($class_id, $connection), $connection);
while($row = $students->fetch_assoc()){
    $id = $row["id"];
    $marks =  $_POST["$id"];
    $query = "INSERT INTO `marks`(`exam`, `student_id`, `subject_id`, `marks`, `fullmarks`, `passmarks`) VALUES ('$exam', $id, $subject_id, $marks, $full, $pass)";
    $connection->query($query);

}

header("Location: ../views/t_marks.php");