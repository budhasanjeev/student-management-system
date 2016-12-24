<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/23/2016
 * Time: 9:21 AM
 */


include  '../common/service.php';
echo validateTeacherUsername($_POST["username"], $connection);