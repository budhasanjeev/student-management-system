<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 3/6/2017
 * Time: 9:43 PM
 */

include "../config/databaseConnection.php";
include "../common/service.php";

$s = $_GET['sid'];
$id = $_GET['id'];
deletePayFee($id, $connection);

header("Location: ../views/a_profile.php?sid=$s");