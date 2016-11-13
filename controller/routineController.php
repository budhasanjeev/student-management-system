<?php
/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 8/31/2016
 * Time: 7:18 PM
 */
$uploads_dir = '../img';
if(isset($_FILES['file']))
{

    $file = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    print_r($file);
    move_uploaded_file($file_tmp,"../img/$file");
}
?>
