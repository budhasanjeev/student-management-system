<?php

include "../config/databaseConnection.php";
include  '../common/Common.php';

$objCommon = new Common();
$uploads_dir = '../img';


if(isset($_POST['submit']))
{
    $class_id = $_POST["class_id"];
  //  $class = $_POST["class"];

    $file = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];

    $path = "../img/" . basename($file);
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

else if(isset($_POST['mode'])){

    $class_id = $_POST['class_id'];

    $file = $_FILES['fee_photo']['name'];
    $file_tmp = $_FILES['fee_photo']['tmp_name'];

    $imageName = $objCommon->getImageName($class_id);

    $path = "../img/" . basename($file);

    /*This line call deletePhoto to delete photo from img directory*/
    $objCommon->deletePhoto($imageName['file']);

    if (move_uploaded_file($file_tmp, $path)) {
         $result = $objCommon->updateFee($file,$class_id);

         ?>

         <script>
             alert('successfully updated');
             window.location.href='../views/fee.php?id=<?php echo $class_id ?>';
         </script>



         <?php
     }    
}
