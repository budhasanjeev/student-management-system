<?php
/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 8/31/2016
 * Time: 7:18 PM
 */
include "../config/databaseConnection.php";
include  '../common/Common.php';

$objCommon = new Common();
$uploads_dir = '../img';
if(isset($_FILES['file']))
{

    $file = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $class = $_POST['class'];
    print_r($file);
    $path = "../img/" . basename($file);
    print_r($path);

    if (move_uploaded_file($file_tmp, $path)) {
        $result = $objCommon->addRoutine($class,$file);


        ?>
        <script>
            alert('successfully uploaded');
            window.location.href='../views/admin.php?success';
        </script>
    <?php
    }

}
?>
