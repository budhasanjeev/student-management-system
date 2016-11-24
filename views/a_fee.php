<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/5/2016
 * Time: 6:39 PM
 */

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Upload Sheet</title>

</head>
<body>

    <?php include 'layout/header.php' ?>
    <div class="container">

    <legend>Fee <form method="post" action="../controller/feeController.php" class="pull-right">
            <input type="hidden" name="deletePhoto" value="deletePhoto">
            <button class="btn btn-success" type="submit">Update</button>
        </form></legend>

        <?php
        $class = getClass($connection);

        while($row = $class->fetch_assoc()){
            ?>

            <a href="fee.php?id=<?php echo $row["id"]; ?>">
                <div class="col-lg-3">
                    <div class="box">
                        <?php echo $row["class"]; ?>
                    </div>
                </div>
            </a>

        <?php
        }
        ?>
</div>



</body>
</html>
