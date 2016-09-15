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
            <input type="hidden" name="mode" id="modes" value="add">
            <input type="hidden" name="student_id" id="student_id">
            <div class="col-md-4">
                <input type="text" name="student_id" class="form-control form-group" placeholder="ID" />
            </div>
            <div class="col-md-4">
                <input type="text" name="firstName" class="form-control form-group" placeholder="First Name" id="firstName" />
            </div>
            <div class="col-md-4">
                <input type="text" name="lastName" placeholder="last Name" class="form-control form-group" id="lastName"/>
            </div>
            <div class="col-md-4">
                <input type="date" name="dob" placeholder="DOB" class="form-control form-group" id="dob" />
            </div>
            <div class="col-md-4">
                <input type="text" name="address" placeholder="address" class="form-control form-group" id="address" />
            </div>
            <div class="col-md-4">
                <input type="tel" name="contact" placeholder="contact" class="form-control form-group" id="contact" />
            </div>
            <div class="col-md-4">
                <input type="number" name="rollNumber" placeholder="roll no." class="form-control form-group" id="roll"/>
            </div>
            <div class="col-md-4">
                <input type="text" name="grade" placeholder="grade" class="form-control form-group" id="grade"/>
            </div>
            <div class="col-md-4">
                <input type="text" name="section" placeholder="section" class="form-control form-group" id="section"/>
            </div>
        </fieldset>
        <h4>Parents Detail</h4>
        <div class="col-md-6">
            <input type="text" name="fatherName" class="form-control form-group" placeholder="Father Name" id="fatherName" />
        </div>
        <div class="col-md-6">
            <input type="text" name="motherName" class="form-control form-group" placeholder="Mother Name" id="motherName"/>
        </div>
        <h4>Photo</h4>
        <div class="col-md-4">
            <input type="file" name="photo" class="form-group" id="studentPhoto"/>
        </div>
        <div class="col-md-12">
            <input class="btn btn-primary btn-block" name="submit" type="submit" value="Add"/>
        </div>
    </form>
</div>

</body>
</html>
