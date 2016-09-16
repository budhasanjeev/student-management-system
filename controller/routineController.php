
<?php

include '../config/databaseConnection.php';

if(isset($_POST['btn-upload']))
{

    $file = rand(1000,100000)."-".$_FILES['file']['name'];

    $grade = $_POST['grade'];
    $file_loc = $_FILES['file']['tmp_name'];
   // $folder='C:\xampp2\htdocs\Stmt\uploads';

    move_uploaded_file($file_loc,"../uploads/$file");
    $sql="INSERT INTO class_routine(grade,pdf_name) VALUES('$grade','$file')";
    $connection->query($sql);
}
?>
<form action="../views/RoutineControl.php" method="post" enctype="multipart/form-data">
    <button type="submit" name="btn">view routine</button>
</form>
