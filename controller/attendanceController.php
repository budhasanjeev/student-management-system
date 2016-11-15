<?php
    include '../common/service.php';
    include '../config/databaseConnection.php';


$month = date("F");
$year = date("o");

$class_id = $_GET["id"];
$attendance = getClassAttendance($class_id, $month, $year, $connection);


?>