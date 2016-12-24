<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/22/2016
 * Time: 8:59 PM
 */


include  '../common/service.php';
echo validateClass($_POST["username"], $connection);