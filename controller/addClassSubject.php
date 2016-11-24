<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 11/24/2016
 * Time: 8:53 PM
 */

include "../config/databaseConnection.php";
include  '../common/service.php';


$class_id = $_POST['class'];
$subject_id = $_POST['subject'];
$teacher_id = $_GET['id'];

addClassSubject($class_id, $subject_id, $teacher_id, $connection);

header("Location:../views/editTeacher.php?id=$teacher_id");