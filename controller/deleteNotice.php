<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 1/11/2017
 * Time: 9:54 PM
 */

include '../common/service.php';

$id = $_GET['id'];

deleteNotice($id, $connection);

header("Location: ../views/notice.php");