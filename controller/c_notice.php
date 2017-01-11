<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 1/11/2017
 * Time: 8:39 PM
 */

include '../common/service.php';

$visible = $_POST['visible'];
$title = $_POST['title'];
$date = $_POST['date'];
$notice = $_POST['notice'];

addNotice($visible, $title, $date, $notice, $connection);

header("Location: ../views/notice.php");