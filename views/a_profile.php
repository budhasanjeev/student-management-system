<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/18/2016
 * Time: 1:39 PM
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
        <legend><a href="t_marks.php">Class</a>/<a href="t_student.php">students</a>/profile</legend>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="row" style="text-align: center;">
                <img src="../images/user.png" width="50%" height="300px" alt=""/>
            </div>

            <div class="row">
                <table style="width: 100%;">
                    <tr>
                    <th>Name</th>
                        <td>Ram</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>Ram</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>