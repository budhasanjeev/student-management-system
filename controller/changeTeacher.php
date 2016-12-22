<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/22/2016
 * Time: 1:29 PM
 */

include "../common/service.php";

$t_id = $_POST['teacher_id'];
$s_id = $_POST['subject_id'];
$c_id = $_POST['class_id'];

addClassSubject($c_id, $s_id, $t_id, $connection);

header("Location: ../views/a_subjectList.php?id=$c_id");
