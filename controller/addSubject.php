<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 11/20/2016
 * Time: 8:33 PM
 */

include "../config/databaseConnection.php";
include  '../common/service.php';

$subject = $_POST["subject"];
$class_ID = $_POST["classID"];

addSubject($subject, $class_ID, $connection);

header("Location: ../views/admin.php");