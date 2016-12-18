<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/7/2016
 * Time: 9:31 PM
 */
session_start();
?>



<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Student Management</title>
</head>
<body>
<?php include 'layout/header.php'; ?>



<div class="container">
    <div class="row">
        <legend>Class</legend>
    </div>

    <?php
    $class = getClass($connection);

    while($row = $class->fetch_assoc()){
        ?>

        <a href="a_subjectList.php?id=<?php echo $row["id"]; ?>">
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