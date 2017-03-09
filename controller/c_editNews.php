<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 3/9/2017
 * Time: 11:47 AM
 */

include '../common/service.php';

$sid = $_POST['sid'];
$id = $_POST['id'];
$amount = $_POST['newAmount'];

editFee($id, $amount, $connection);


header("Location: ../views/a_profile.php?sid=$sid");