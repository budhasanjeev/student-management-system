<?php
/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 12/19/2016
 * Time: 5:28 PM
 */

    include "../config/databaseConnection.php";
    include "../common/service.php";

    $result = upgradeStudents($connection);

    echo json_encode($result);