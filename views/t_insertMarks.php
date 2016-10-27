<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/18/2016
 * Time: 12:43 PM
 */
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
        <legend><a href="t_marks.php">Exam Marks</a>/<a href="t_student.php">students</a>/marksheet <span class="pull-right">Student name</span></legend>
    </div>

    <div>
        <form action="" class="form">
            <table style="width: 100%">
                <tr>
                    <th>subject</th>
                    <th>marks</th>
                </tr>
                <tr>
                    <td><label>Math</label></td>
                    <td><input class="form-control" type="text"/></td>
                </tr>

                <tr>
                    <td><label>Science</label></td>
                    <td><input class="form-control" type="text"/></td>
                </tr>
            </table>

        </form>
    </div>

</div>
</body>
</html>
