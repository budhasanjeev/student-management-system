<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/22/2016
 * Time: 5:16 PM
 */


include  '../common/service.php';
echo validateStudentID($_POST["username"], $connection);