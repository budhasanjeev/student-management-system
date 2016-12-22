<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/22/2016
 * Time: 12:48 PM
 */

include '../common/service.php';

$id = $_GET['id'];
$class = $_GET['class'];

deleteSubject($id, $connection);

header("Location: ../views/a_subjectList.php?id=$class");