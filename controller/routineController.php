<?php
/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 8/31/2016
 * Time: 7:18 PM
 */
include "../config/databaseConnection.php";
$uploads_dir = '../img';
if(isset($_FILES['file']))
{

    $file = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $class = $_POST['class'];
    print_r($file);
    $path = "../img/" . basename($file);
    if (move_uploaded_file($file_tmp, $path)) {
        mysql_query("insert into routin (class, file) VALUES ('$class','$file')")
        or die(mysql_error());


        ?>
        <script>
            alert('successfully uploaded');
            window.location.href='admin.php?success';
        </script>
    <?php
    }

}
?>
