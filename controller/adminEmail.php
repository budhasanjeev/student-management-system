<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 1/4/2017
 * Time: 10:00 PM
 */

include'../common/service.php';

$email = $_POST['email'];
$password = $_POST['password'];
setAdminEmail($email, $password, $connection);
header('Location: ../views/admin.php');
