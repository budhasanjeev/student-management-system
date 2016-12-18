<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/18/2016
 * Time: 1:32 PM
 */
session_start();

if($_SESSION['role'] != 'parents'){
?>


<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Student Management</title>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/style.css"/>
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

        <a href="a_student.php?id=<?php echo $row["id"]; ?>">
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

<?php
}else{
    header('Location: logout.php');
}
?>