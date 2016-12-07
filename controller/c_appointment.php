<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/7/2016
 * Time: 8:49 PM
 */

session_start();

include "../config/databaseConnection.php";
include "../common/service.php";

$agenda = $_POST['agenda'];
$date = $_POST['date'];
$time = $_POST['time'];
$parentsID = $_SESSION['user_id'];

makeAppointment($agenda, $date, $time, $parentsID, $connection);

header('Location: ../views/a_profile.php?sid=14');