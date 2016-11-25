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
    <script src="../js/common.js"></script>
</head>
<body>
<?php include 'layout/header.php' ?>
<div class="container">
    <legend>Add Student</legend>
    <form action="../controller/studentController.php"  name="studentform" method="post"   enctype="multipart/form-data">
        <fieldset>
            <h4>Students Detail</h4>
            <input type="hidden" name="mode" id="modes" value="add">
            <div class="col-md-4">
                <input type="text" name="student_id" id="student_id" class="form-control form-group" placeholder="ID" onkeyup="checkNumeric('student_id')" />
            </div>
            <div class="col-md-4">
                <input type="text" name="firstName" class="form-control form-group" placeholder="First Name" id="firstName" onkeyup="checkAlphabet('firstName')"/>
            </div>
            <div class="col-md-4">
                <input type="text" name="lastName" placeholder="last Name" class="form-control form-group" id="lastName" onkeyup="checkAlphabet('lastName')"/>
            </div>
            <div class="col-md-4">
                <input type="text" name="dob" placeholder="Date of Birth" class="form-control form-group" onfocus="(this.type='date')" id="dob" />
            </div>
            <div class="col-md-4">
                <input type="text" name="address" placeholder="address" class="form-control form-group" id="address" onkeyup="checkAlphabet('address')"/>
            </div>
            <div class="col-md-4">
                <input type="tel" name="contact" placeholder="contact" class="form-control form-group" id="contact" onkeyup="checkNumeric('contact')"/>
            </div>
            <div class="col-md-4">
                <input type="number" name="rollNumber" placeholder="roll no." class="form-control form-group" id="roll"  onkeyup="checkNumeric('roll')"  />
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <select class="form-control" name="grade" id="grade" placeholder="grade" required="">
                        <?php
                        $class = getClass($connection);
                        while($row = $class->fetch_assoc()){
                            ?>
                            <option value="<?php echo $row["class"]; ?>"><?php echo $row["class"]; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

            </div>
            <div class="col-md-4">
                <input type="text" name="section" placeholder="section" class="form-control form-group" id="section" onkeyup="checkAlphabet('section')"/>
            </div>
        </fieldset>
        <h4>Parents Detail</h4>
        <div class="col-md-6">
            <input type="text" name="fatherName" class="form-control form-group" placeholder="Father Name" id="fatherName"  onkeyup="checkAlphabet('fathername')" />
        </div>
        <div class="col-md-6">
            <input type="text" name="motherName" class="form-control form-group" placeholder="Mother Name" id="motherName" onkeyup="checkAlphabet('mothername')" />
        </div>
        <h4>Photo</h4>
        <div class="col-md-4">
            <input type="file" name="photo" class="form-group" id="studentPhoto"/>
        </div>
        <div class="col-md-12">
            <input class="btn btn-primary btn-block" name="submit"  type="submit"  value="Add"/>
        </div>
    </form>

    <?php echo date("Y-m-d") ?>
</div>

</body>
</html>
