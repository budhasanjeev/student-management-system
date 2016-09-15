<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/5/2016
 * Time: 6:38 PM
 */
session_start();
include '../common/Common.php'

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Student Management</title>
</head>
<body>
<?php
include 'layout/header.php';
?>

<div class="container">
    <div class="col-md-6">
        <a href="studentForm.php" class="btn btn-block btn-primary">Form to add student</a>
    </div>
    <div class="col-md-6">
        <a href="" class="btn btn-block btn-primary">Excell to add student</a>
    </div>

    <?php
    if(isset($_SESSION['create_student'])){
        if($_SESSION['create_student'] == 'success'){
            echo '<script>
                    displayMessage("Successful","success");
                </script>';
        }
        else if($_SESSION['create_student'] == 'error'){
            echo '<script>
                    displayMessage("Failed","error");
                </script>';
        }
    }

    session_unset();
    ?>

    <table class="table table-responsive">
        <thead>
        <tr>
            <th>Photo</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>DOB</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Roll No.</th>
            <th>Grade</th>
            <th>Section</th>
            <th>Father's Name</th>
            <th>Mother's Name</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        <?php
        $objCommon = new Common();
        $studentList = $objCommon->getStudent();

        foreach ($studentList as $student) {
            ?>

            <tr>
                <td><img src="../images/<?php echo $student['photo'] ?>" style="width: 40px;" class="img-circle">
                </td>
                <td><?php echo $student['id'] ?></td>
                <td><?php echo $student['first_name'] . ' ' . $student['last_name'] ?></td>
                <td><?php echo $student['dob'] ?></td>
                <td><?php echo $student['address'] ?></td>
                <td><?php echo $student['contact_number'] ?></td>
                <td><?php echo $student['roll_number'] ?></td>
                <td><?php echo $student['grade'] ?></td>
                <td><?php echo $student['section'] ?></td>
                <td><?php echo $student['father_name'] ?></td>
                <td><?php echo $student['mother_name'] ?></td>
                <td>
                    <button class="btn btn-default" onclick="editStudent(<?php echo $student['id'] ?>)"><span class="glyphicon glyphicon-edit"></span></button>
                    <button class="btn btn-default" onclick="deleteStudent(<?php echo $student['id'] ?>)"><span class="glyphicon glyphicon-trash"></span></button>
                </td>
            </tr>
            <?php
        }
        ?>
        <tr>

        </tr>
        </tbody>
    </table>
</div>

</body>
</html>