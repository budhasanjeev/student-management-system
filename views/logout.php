<?php
/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 10/20/2016
 * Time: 6:50 PM
 */

session_start();

session_destroy();

header('Location: login.php');

