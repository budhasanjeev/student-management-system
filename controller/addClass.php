<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 11/13/2016
 * Time: 1:26 PM
 */

    include "../config/databaseConnection.php";
    include "../common/service.php";

    $gradeList = $_POST["grade"];

    foreach ($gradeList as $grade)
    {
        addClass($grade, $connection);

    }

    header("Location: ../views/a_class.php");
