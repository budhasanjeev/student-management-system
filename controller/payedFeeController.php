<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 1/17/2017
 * Time: 10:29 PM
 */

include  '../common/service.php';
$sid = $_POST['student_id'];
$date = $_POST['date'];
$amount = $_POST['amount'];

addPayedFee($sid, $date, $amount, $connection);

header("Location: ../views/a_profile?sid=$sid");