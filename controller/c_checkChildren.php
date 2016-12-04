<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/4/2016
 * Time: 2:36 PM
 */

session_start();

include "../config/databaseConnection.php";
include  '../common/service.php';

$pid = $_SESSION['user_id'];

$parentsInfo = getParentsInfo($pid, $connection);
while($row = mysqli_fetch_assoc($parentsInfo)){
    $student_id = $row["student_id"];
    $student_ids = explode(",",$student_id);
    $number_child = sizeof($student_ids);
}

echo $number_child;

if($number_child == 1){
    header("Location: ../views/a_profile.php?sid=$student_ids[0]");
}else{
    header("Location: ../views/p_MLanding.php");
}

?>