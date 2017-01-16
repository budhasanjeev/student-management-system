<?php

include "../config/databaseConnection.php";
include  '../common/service.php';

$class_id = $_POST['class_id'];
$fee = $_POST['fee'];

addFee($class_id, $fee, $connection);

header("Location: ../views/admin.php");

