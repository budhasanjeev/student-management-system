<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/22/2016
 * Time: 9:38 PM
 */


include  '../common/service.php';
echo validateTeacherEmail($_POST["username"], $connection);