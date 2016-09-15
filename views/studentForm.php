<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/5/2016
 * Time: 9:29 PM
 */
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
    <legend>Add Student</legend>
    <form action="../controller/studentController.php" method="post" enctype="multipart/form-data">

        <fieldset>
            <h4>Students Detail</h4>
            <input type="hidden" name="mode" value="add">
            <div class="col-md-4">
                <input type="text" name="student_id" class="form-control form-group" placeholder="ID" name="id"/>
            </div>
            <div class="col-md-4">
                <input type="text" name="firstName" class="form-control form-group" placeholder="First Name" name="fname"/>
            </div>
            <div class="col-md-4">
                <input type="text" name="lastName" placeholder="last Name" class="form-control form-group" name="lname"/>
            </div>
            <div class="col-md-4">
                <input type="date" name="dob" placeholder="DOB" class="form-control form-group" name="dob"/>
            </div>
            <div class="col-md-4">
                <input type="text" name="address" placeholder="address" class="form-control form-group" name="address"/>
            </div>
            <div class="col-md-4">
                <input type="tel" name="contact" placeholder="contact" class="form-control form-group" name="contact"/>
            </div>
            <div class="col-md-4">
                <input type="number" name="rollNumber" placeholder="roll no." class="form-control form-group" name="roll"/>
            </div>
            <div class="col-md-4">
                <input type="text" name="grade" placeholder="grade" class="form-control form-group" name="roll"/>
            </div>
            <div class="col-md-4">
                <input type="text" name="section" placeholder="section" class="form-control form-group" name="section"/>
            </div>
        </fieldset>
        <h4>Parents Detail</h4>
        <div class="col-md-6">
            <input type="text" name="fatherName" class="form-control form-group" placeholder="Father Name" name="fatherName"/>
        </div>
        <div class="col-md-6">
            <input type="text" name="motherName" class="form-control form-group" placeholder="Mother Name" name="motherName"/>
        </div>
        <h4>Photo</h4>
        <div class="col-md-4">
            <input type="file" name="photo" class="form-group" name="studentPhoto"/>
        </div>
        <div class="col-md-12">
            <input class="btn btn-primary btn-block" name="submit" type="submit" value="Add"/>
        </div>
    </form>
</div>
</body>
</html>
