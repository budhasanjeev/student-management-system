<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 1/15/2017
 * Time: 9:44 PM
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
        <legend>Subjects of class <?php echo getClassName($_GET['id'], $connection); ?></legend>
    </div>
    <?php
    $class = getClassSubject($_GET['id'], $connection);

    while($row = $class->fetch_assoc()){
        ?>
        <a href="t_addMarks.php?class=<?php echo $_GET['id']; ?>&sub=<?php echo $row['id']; ?>">
            <div class="col-lg-3">
                <div class="box">
                    <?php echo $row["subject_name"]; ?>
                </div>
            </div>
        </a>

        <?php
    }
    ?>
</div>
</body>
</html>

