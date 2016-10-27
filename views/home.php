<?php
/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 9/4/2016
 * Time: 2:04 PM
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>

    <body>
        <form action="../controller/studentController.php" method="post" enctype="multipart/form-data">
            <label>Upload Excel File</label>
            <input type="file" name="student_excel">
            <br>
            <button type="submit" name="submit" value="submit">submit</button>
        </form>
    </body>

</html>