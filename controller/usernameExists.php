<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/22/2016
 * Time: 4:23 PM
 */

include  '../common/service.php';

echo validateUsername($_POST["username"], $connection);