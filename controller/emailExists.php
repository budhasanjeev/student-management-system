<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/22/2016
 * Time: 4:59 PM
 */


include  '../common/service.php';

echo validateEmail($_POST["username"], $connection);