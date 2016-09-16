<?php
    include '../common/Common.php';

$objCommon = new Common();

if(isset($_FILES['file'])) {

    $file = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    move_uploaded_file($file_tmp, "../excelFiles/attendance/$file");


    $result = $objCommon->attendanceExcel($file,$file_tmp);

}
