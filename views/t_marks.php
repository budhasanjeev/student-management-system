<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/18/2016
 * Time: 11:05 AM
 */
session_start();

if(!isset($_SESSION["email"])){
    header("Location: login.php");
}
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
        <legend>Exam Marks</legend>
    </div>

    <a href="t_student.php">
    <div class="box col-lg-3">
        class 1
    </div>
    </a>


</div>
</body>
</html>
