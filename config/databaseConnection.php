<?php
/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 8/31/2016
 * Time: 7:11 PM
 */

$server_name = "localhost"; 
$username    = "root"; /* database username */
$password    = "root"; /* database password */
$db_name     = "student_ims"; /* database name */

/*Create Connection*/
$connection = mysqli_connect($server_name,$username,$password,$db_name);

/*Check Connection*/
if(mysqli_connect_errno()){
    die("Connection failed: ".mysqli_connect_error());
}
