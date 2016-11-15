<?php

include "../config/databaseConnection.php";
include  '../common/Common.php';

$objCommon = new Common();
$uploads_dir = '../img';

if(isset($_POST['submit']))
{
    // $class_class=$_POST['class'];
    $class_id = $_POST["class_id"];
    $class = $_POST["class"];
    print_r($class_id);
    print_r($class);
    // $class=$_POST['class'];
    $file = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];



    $path = "../img/" . basename($file);
    print_r($path);


    if (move_uploaded_file($file_tmp, $path)) {
        $result = $objCommon->addFee($file,$class_id);


        ?>
        <script>
            alert('successfully uploaded');
            window.location.href='../views/admin.php?success';
        </script>
    <?php
    }

}


