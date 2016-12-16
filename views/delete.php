<?php
/**
 * Created by PhpStorm.
 * User: anijor
 * Date: 11/15/2016
 * Time: 2:42 PM
 */

include "../config/databaseConnection.php";
$id=$_GET["id"];
$res=mysqli_query($connection,"SELECT file FROM fee WHERE id='$id'");
$row=mysqli_fetch_array($res);
mysqli_query($connection,"DELETE FROM fee WHERE id='$id'");
$entry ="../img/".$row['file'];
chmod( $entry, 0777 );
unlink( $entry );
