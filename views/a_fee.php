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

    <legend>Fee</legend>

        <?php
        $class = getClass($connection);
        while($row = $class->fetch_assoc()) {
            ?>
            <div class="col-md-3">
                <div  class="box">
                    <a href="fee.php?id=<?php echo $row["id"]; ?>">Class <?php echo $row["class"]; ?></a>
                </div>
            </div>
        <?php
        }
        ?>
</div>

    <form method="post" action="../controller/feeController.php">
        <input type="hidden" name="deletePhoto" value="deletePhoto">
        <button type="submit">Delete</button>
    </form>

</body>
</html>
