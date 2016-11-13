<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 10/20/2016
 * Time: 7:55 PM
 */

include '../common/Common.php';
include '../config/databaseConnection.php';
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
    <legend>All teachers</legend>

    <?php
        $objCommon = new Common();
        $teacherList = $objCommon->getAllTeacher();
    ?>
    <table class="table table-responsive table-striped table-bordered">
        <thead>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Address</th>
        <th>Degree</th>
        </thead>
        <tbody>

        <?php
            foreach ($teacherList as $teacher) {
                ?>
                <tr>
                    <td><img class="img-circle" width="60px" src="../img/<?php echo $teacher["photo"] ?>"></td>
                    <td><?php echo $teacher['name'] ?></td>
                    <td><?php echo $teacher['email'] ?></td>
                    <td><?php echo $teacher['contact'] ?></td>
                    <td><?php echo $teacher['address'] ?></td>
                    <td><?php echo $teacher['degree'] ?></td>
                </tr>

                <?php
            }
        ?>
        </tbody>
    </table>
    </div>
</body>
</html>