<?php
/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 9/15/2016
 * Time: 6:05 PM
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
<?php include 'layout/header.php' ?>
<div class="container">
    <legend>Edit Student</legend>
    <form action="../controller/studentController.php" method="post" enctype="multipart/form-data">
        <?php
        $student = array();
        $student = $_SESSION['student'];
        ?>
        <fieldset>
            <h4>Students Detail</h4>
            <input type="hidden" name="mode" id="modes" value="update">
            <input type="hidden" name="std_id" id="std_id" value="<?php echo $student['id']; ?>">
            <div class="col-md-4">
                <input type="text" name="student_id" class="form-control form-group" placeholder="ID" value="<?php echo $student['student_id'] ?>"/>
            </div>
            <div class="col-md-4">
                <input type="text" name="firstName" class="form-control form-group" placeholder="First Name" id="firstName" value="<?php echo $student['first_name'] ?>"/>
            </div>
            <div class="col-md-4">
                <input type="text" name="lastName" placeholder="last Name" class="form-control form-group" id="lastName" value="<?php echo $student['last_name'] ?>"/>
            </div>
            <div class="col-md-4">
                <input type="date" name="dob" placeholder="DOB" class="form-control form-group" id="dob" value="<?php echo $student['dob'] ?>"/>
            </div>
            <div class="col-md-4">
                <input type="text" name="address" placeholder="address" class="form-control form-group" id="address" value="<?php echo $student['address'] ?>"/>
            </div>
            <div class="col-md-4">
                <input type="tel" name="contact" placeholder="contact" class="form-control form-group" id="contact" value="<?php echo $student['contact_number'] ?>"/>
            </div>
            <div class="col-md-4">
                <input type="number" name="rollNumber" placeholder="roll no." class="form-control form-group" id="roll" value="<?php echo $student['roll_number'] ?>"/>
            </div>
            <div class="col-md-4">
                <input type="text" name="grade" placeholder="grade" class="form-control form-group" id="grade" value="<?php echo $student['grade'] ?>"/>
            </div>
            <div class="col-md-4">
                <input type="text" name="section" placeholder="section" class="form-control form-group" id="section" value="<?php echo $student['section'] ?>"/>
            </div>
        </fieldset>
        <h4>Parents Detail</h4>
        <div class="col-md-6">
            <input type="text" name="fatherName" class="form-control form-group" placeholder="Father Name" id="fatherName" value="<?php echo $student['father_name'] ?>"/>
        </div>
        <div class="col-md-6">
            <input type="text" name="motherName" class="form-control form-group" placeholder="Mother Name" id="motherName" value="<?php echo $student['mother_name'] ?>"/>
        </div>
        <h4>Photo</h4>
        <div class="col-md-4">
            <input type="file" name="photo" class="form-group" id="studentPhoto" value="<?php echo $student['photo'] ?>"/>
        </div>
        <div class="col-md-12">
            <input class="btn btn-primary btn-block" name="submit" type="submit" value="Edit"/>
        </div>
    </form>
</div>

</body>
</html>
