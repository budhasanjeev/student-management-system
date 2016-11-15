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
            <li>
                <a href="fee.php?id=<?php echo $row["id"]; ?>">Class <?php echo $row["class"]; ?></a>
            </li>
        <?php
        }
        ?>
</div>


</body>
</html>
