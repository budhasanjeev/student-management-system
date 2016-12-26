<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/4/2016
 * Time: 1:33 PM
 */

//session_start();
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
}

include "../config/databaseConnection.php";
include "../common/service.php";
include "../common/Common.php";
?>


<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Student Management</title>
    <script src="../js/jquery-1.12.4.min.js"></script>
    <script src="../js/jquery.noty.packaged.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script type="application/javascript" src="../js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css"/>
    <script src="../js/custom.js"></script>
    <script src="../js/user.js"></script>
    <script>
        function validatePassword() {
            var currentPassword,newPassword,conformPassword,output = true;

            currentPassword = document.frmChange.currentPassword;
            newPassword = document.frmChange.newPassword;
            conformPassword= document.frmChange.conformPassword;

            if(!currentPassword.value) {
                currentPassword.focus();
                document.getElementById("currentPassword").innerHTML = "required";
                output = false;
            }
            else if(!newPassword.value) {
                newPassword.focus();
                document.getElementById("newPassword").innerHTML = "required";
                output = false;
            }
            else if(!conformPassword.value) {
                conformPassword.focus();
                document.getElementById("conformPassword").innerHTML = "required";
                output = false;
            }
            if(newPassword.value != conformPassword.value) {
                newPassword.value="";
                conformPassword.value="";
                newPassword.focus();
                document.getElementById("conformPassword").innerHTML = "not same";
                output = false;
            }
            return output;
        }
    </script>


    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/style.css"/>



    <script type="text/javascript">
        function checkClass(event) {
            var classd = event.value;
            var class_d = '#'+classd;
            if ($(event).is(':checked')) {
                $.ajax({
                    type: 'POST',
                    url: '../controller/classExists.php',
                    data: 'username=' + classd,
                    success: function (data) {
                        var jsonData = JSON.parse(data);

                        if (jsonData.message == "success") {
//                            var pTag = '<p id="someMessage">Test</p>';
//                            $(event).after(pTag);
//                            $("#registerButton").prop('disabled', true);
//                            $("#option").prop('disabled', true);
                            alert('Class already exists');
                            $(class_d).attr('checked',false);
                        }
                    }
                });
            } else {
                $("#className").attr('style', 'border: 1px solid blue');
                $(".className").attr('style', 'display: none;');
                if($("#someMessage").length != 0){
                    $("#registerButton").prop('disabled', false);
                    $("#option").prop('disabled', false);
                }
                $("#someMessage").remove();
            }
        }

        function c() {
            var classd = document.getElementById('temail').value;
            $.ajax({
                type: 'POST',
                url: '../controller/teacherEmailExists.php',
                data: 'username=' + classd,
                success: function (data) {
                    var jsonData = JSON.parse(data);
                    if (jsonData.message == "fail") {

                        $("#email").attr('style', 'border: 1px solid blue');
                        $(".email").attr('style', 'display: none;');
                        $("#registerButton").prop('disabled', false);
                    } else {
                        $("#email").attr('style', 'border: 2px solid red');
                        $(".email").attr('style', 'display: block;');
                        $("#registerButton").prop('disabled', true);
                    }
                }
            });
        }


        function checkTeacherUsername() {
            var username = document.getElementById('tusername').value;
            $.ajax({
                type: 'POST',
                url: '../controller/teacherUsernameExists.php',
                data: 'username=' + username,
                success: function (data) {
                    var jsonData = JSON.parse(data);
                    if (jsonData.message == "fail") {

                        $("#tusername").attr('style', 'border: 1px solid blue');
                        $(".username").attr('style', 'display: none;');
                        $("#registerButton").prop('disabled', false);

                        var password = "@"+username+"123#" ;

                        $('#tpassword').val(password);

                    } else {
                        $("#tusername").attr('style', 'border: 2px solid red');
                        $(".username").attr('style', 'display: block;');
                        $("#registerButton").prop('disabled', true);
                    }
                }
            });
        }

        function call() {

        }
    </script>

</head>
<body>

<!--Routine Modal -->
<div id="routineModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add new Routine</h4>
            </div>
            <div class="modal-body">
                <form action="../controller/routineController.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="class" name="class">Class: </label>
                        <select name="class_id" class="form-control" onchange="setTextField()">
                            <?php
                            $class = getClass($connection);
                            while ($row = mysqli_fetch_assoc($class)) {
                                ?>

                                <option value="<?php echo $row["id"]; ?>"><?php echo $row["class"]; ?></option>

                            <?php
                            }
                            ?>
                        </select>
                        <input id="class" type="hidden" name="class" value=""/>
                        <script type="text/javascript">
                            function setTextField(ddl) {
                                document.getElementById('class').value = ddl.options[ddl.selectedIndex].text;
                            }
                        </script>

                    </div>

                    <div class="form-group">
                        <label for="routine">Routine: </label>
                        <input type="file" name="file"/>
                    </div>
                    <div style="text-align: right">
                        <input type="submit" value="submit" name="submit"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<!--Fee Modal -->
<div id="feeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Fee</h4>
            </div>
            <div class="modal-body">
                <form action="../controller/feeController.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="class" name="class">Class: </label>
                        <select name="class_id" class="form-control" onchange="setTextField()">
                            <?php
                            $class = getClass($connection);
                            while ($row = mysqli_fetch_assoc($class)) {
                                ?>

                                <option value="<?php echo $row["id"]; ?>"><?php echo $row["class"]; ?></option>

                            <?php
                            }
                            ?>
                        </select>
                        <!--                        <input id="class" type = "hidden" name = "class" value = "" />-->
                        <script type="text/javascript">
                            function setTextField(ddl) {
                                document.getElementById('class').value = ddl.options[ddl.selectedIndex].text;
                            }
                        </script>

                    </div>

                    <div class="form-group">
                        <label for="routine">Fee: </label>
                        <input type="file" name="file"/>
                    </div>
                    <div style="text-align: right">
                        <input type="submit" value="submit" name="submit"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!--Class Modal -->
<div id="classModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Class</h4>
            </div>
            <div class="modal-body">
                <form class="form" action="../controller/addClass.php" method="post">
                    <div class="form-group">
                        <legend>Class</legend>

                        <div class="col-md-6">
                            <table>
                            <tr>
                                <td><input type="checkbox" name="grade[]" value="Nursery" onclick="checkClass(this);" id="Nursery"/></td>
                                <td>Nursery</td>
                            </tr>
                                <tr>
                                    <td><input type="checkbox" name="grade[]" value="UKG" onclick="checkClass(this);" id="UKG"/></td>
                                    <td>UKG</td>
                                </tr>

                                <tr>
                                    <td><input type="checkbox" name="grade[]" value="One" id="One" onclick="checkClass(this);"/></td>
                                    <td>One</td>
                                </tr>

                                <tr>
                                    <td><input type="checkbox" name="grade[]" value="Three" onclick="checkClass(this);" id="Three"/></td>
                                    <td>Three</td>
                                </tr>

                                <tr>
                                    <td><input type="checkbox" name="grade[]" value="Five" onclick="checkClass(this);" id="Five"/></td>
                                    <td>Five</td>
                                </tr>

                                <tr>
                                    <td><input type="checkbox" name="grade[]" value="Seven" onclick="checkClass(this);" id="Seven"><br/></td>
                                    <td>Seven</td>
                                </tr>

                                <tr>
                                    <td><input type="checkbox" name="grade[]" value="Nine" onclick="checkClass(this);" id="Nine" /></td>
                                    <td>Nine</td>
                                </tr>

                                <tr>
                                    <td><input type="checkbox" name="grade[]" value="Eleven" onclick="checkClass(this);" id="Eleven"/><br/></td>
                                    <td>Eleven</td>
                                </tr>
                            </table>

                        </div>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td><input type="checkbox" name="grade[]" value="LKG" onclick="checkClass(this);" id="LKG"/></td>
                                    <td>LKG</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="grade[]" value="KG" onclick="checkClass(this);" id="KG"/></td>
                                    <td>UKG</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="grade[]" value="Two" onclick="checkClass(this);" id="Two"/></td>
                                    <td>Two</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="grade[]" value="Four" onclick="checkClass(this);" id="Four"/></td>
                                    <td>Four</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="grade[]" value="Six" onclick="checkClass(this);" id="Six"/></td>
                                    <td>Six</td>
                                </tr>
                                <tr>
                                <td><input type="checkbox" name="grade[]" value="Eight" onclick="checkClass(this);" id="Eight"/></td>
                                    <td>Eight</td>
                                </tr>
                                <tr>
                                <td><input type="checkbox" name="grade[]" value="Ten" onclick="checkClass(this);" id="Ten"/></td>
                                    <td>Ten</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="grade[]" value="Twelve" onclick="checkClass(this);" id="Twelve"/></td>
                                    <td>Twelve</td>
                                </tr>
                            </table>

                        </div>

                    </div>

                    <div style="text-align: right">
                        <button type="submit" id="registerButton" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<!--Change Password Modal -->
<div id="changePasswordModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="modal-body">


                <form class="form" name="frmChange" method="post" action="changePassword.php" onSubmit="return validatePassword()">
                    <div style="width:500px;">
                    <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
                    <table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
                        <tr class="form-group">
                            <td width="40%"><label>Current Password</label></td>
                            <td width="60%"><input type="password" name="currentPassword" class="txtField form-control"/><span id="currentPassword"  class="required"></span></td>
                        </tr>
                        <tr class="form-group">
                            <td><label>New Password</label></td>
                            <td><input type="password" name="newPassword" class="txtField form-control"/><span id="newPassword" class="required"></span></td>
                        </tr>
                        <tr class="form-group">
                        <td><label>Confirm Password</label></td>
                        <td><input type="password" name="conformPassword" class="txtField form-control"/><span id="conformPassword" class="required"></span></td>
                        </tr>
                        <tr style="text-align: right;">
                            <td colspan="2"><input type="submit" name="submit" value="Change" class="btnSubmit btn btn-primary"></td>
                        </tr>
                    </table>
                    </div>
                    </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!--appointment Modal -->
<div id="appointmentModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Make Appointment</h4>
            </div>
            <div class="modal-body">
                <form class="form" action="../controller/c_appointment.php" method="post">
                    <div class="form-group">
                        <label for="class">Agenda: </label>
                        <input class="form-control" type="text" name="agenda" required=""/>
                    </div>

                    <div class="form-group">
                        <label for="class">Time: </label>
                        <input class="form-control" type="time" name="time" required=""/>
                    </div>

                    <div class="form-group">
                        <label for="class">Appointment Date: </label>
                        <input class="form-control" type="date" name="date" required=""/>
                    </div>
                    <div style="text-align: right">
                        <button type="submit" class="btn btn-success">Send</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!--Subject Modal -->
<div id="subjectModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Subject</h4>
            </div>
            <div class="modal-body">
                <form class="form" action="../controller/addSubject.php" method="post">

                    <div class="form-group">
                        <lable>Class:</lable>
                        <select class="form-control" name="classID">
                            <?php
                            $class = getClass($connection);
                            while ($r = $class->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $r['id']; ?>"><?php echo $r['class']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <lable>Subject:</lable>
                        <input class="form-control" type="text" name="subject" required=""/>
                    </div>

                    <div style="text-align: right">
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!--Add Teacher Modal -->
<div id="teacherModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Teacher</h4>
            </div>
            <div class="modal-body">
                <form class="form" action="../controller/teacherController.php" method="post"
                      enctype="multipart/form-data">

                    <input type="hidden" name="mode" value="add">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="class">Name: </label>
                            <input class="form-control" type="text" name="name" required=""/>
                        </div>

                        <div class="form-group">
                            <label for="class">Contact: </label>
                            <input class="form-control" placeholder="98********, 98********" type="text" name="contact"
                                   required=""/>
                        </div>

                        <div class="form-group">
                            <label for="class">Email: </label>
                            <input class="form-control" type="text" id="temail" name="email" onchange="c()"/>

                            <div class="error email">Email already exist</div>
                        </div>

                        <div class="form-group">
                            <label for="class">Experience: </label>
                            <input class="form-control" type="text" name="experience" required=""/>
                        </div>


                        <div class="form-group">
                            <label for="class">Joined on: </label>
                            <input class="form-control" type="date" name="join_on" required=""/>
                        </div>



                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="class">Username: </label>
                            <input class="form-control" type="text" name="username" id="tusername" required=""
                                   onchange="checkTeacherUsername();"/>

                            <div class="error username">Username already exist</div>
                        </div>


                        <div class="form-group">
                            <label for="class">Password: </label>
                            <input class="form-control" type="text" id="tpassword" name="tpassword" disabled/>

                        </div>

                        <div class="form-group">
                            <label for="class">Address: </label>
                            <input class="form-control" type="text" name="address" required=""/>
                        </div>


                        <div class="form-group">
                            <label for="class">Degree: </label>
                            <input class="form-control" type="text" name="degree" required=""/>
                        </div>

                        <div class="form-group">
                            <label for="class">Photo: </label>
                            <input type="file" name="photo" required=""/>
                        </div>

                    </div>



                    <div style="text-align: right">
                        <button type="submit" id="registerButton" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<nav class="navbar" role="navigation"
     style="border-radius: 0px; border-bottom: 2px solid skyblue; background-color: gray;">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span style="background-color: #ffffff;" class="icon-bar"></span>
            <span style="background-color: #ffffff;" class="icon-bar"></span>
            <span style="background-color: #ffffff;" class="icon-bar"></span>
        </button>
        <a class="navbar-brand"
           style="font-family: 'Kaushan Script', cursive; color: #ffffff;" <?php if ($_SESSION['role'] == 'Admin') { ?> href="admin.php" <?php } ?><?php if ($_SESSION['role'] == 'Teacher') { ?> href="teacher.php" <?php } ?>>SMS</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">


            <?php
            if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin') {
                ?>
                <li><a href="admin.php">Home</a></li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Students<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php
                        $class = getClass($connection);
                        while ($row = mysqli_fetch_assoc($class)) {
                            ?>
                            <li>
                                <a href="a_student.php?id=<?php echo $row["id"]; ?>">Class <?php echo $row["class"]; ?></a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
            <?php
            }
            ?>

            <?php
            if ($_SESSION['role'] == 'teacher' || $_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin') {
                ?>
                <li><a href="a_teacher.php">Teachers</a></li>
            <?php
            }
            ?>


            <?php
            if($_SESSION['role'] == 'Receptionist'){
                ?>
                <li><a href="a_teacher.php">Teachers</a></li>
            <?php
            }
            ?>


            <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Subject<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <?php
                    $class = getClass($connection);
                    while ($row = mysqli_fetch_assoc($class)) {
                        ?>
                        <li>
                            <a href="a_subjectList.php?id=<?php echo $row["id"]; ?>">Class <?php echo $row["class"]; ?></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Routine<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <?php
                    $class = getClass($connection);
                    while ($row = mysqli_fetch_assoc($class)) {
                        ?>
                        <li>
                            <a href="routine.php?id=<?php echo $row["id"]; ?>">Class <?php echo $row["class"]; ?></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </li>
            <?php
            if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin' || $_SESSION['role'] == 'Parents') {
                ?>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Fee<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php
                        $class = getClass($connection);
                        while ($row = mysqli_fetch_assoc($class)) {
                            ?>
                            <li>
                                <a href="fee.php?id=<?php echo $row["id"]; ?>">Class <?php echo $row["class"]; ?></a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
            <?php
            }
            if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin') {
                echo '<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Add New<b class="caret"></b></a>

                <div class="dropdown-menu" style="padding: 4px;">
                    <a href="a_user.php">
                        <div class="col-md-6" style="padding: 5px;">
                            <div class="dropdown-div" style="background-color: #a07789;">
                                <div>User</div>
                            </div>
                        </div>
                    </a>

                    <a href="student.php">
                        <div class="col-md-6" style="padding: 5px;">
                            <div class="dropdown-div" style="background-color: #aba992;">
                                <div>Student</div>
                            </div>
                        </div>
                    </a>

                    <a href="">
                        <div class="col-md-6" style="padding: 5px;">
                            <div class="dropdown-div" style="background-color: #47666b;">
                                <a href="" data-toggle="modal" data-target="#teacherModal"><div>Teacher</div></a>
                            </div>
                        </div>
                    </a>

                    <a href="#">
                        <div class="col-md-6" style="padding: 5px;">
                            <div class="dropdown-div" style="background-color: #533443;">
                                <a href="" data-toggle="modal" data-target="#classModal"><div>Class</div></a>
                            </div>
                        </div>
                    </a>

                    <a href="student.php">
                        <div class="col-md-12" style="padding: 5px;">
                            <div class="dropdown-div" style="background-color: #aba992;">
                                <a href="" data-toggle="modal" data-target="#subjectModal"><div>Subject</div></a>
                            </div>
                        </div>
                    </a>

                    <a href="#">
                        <div class="col-md-6" style="padding: 5px;">
                            <div class="dropdown-div" style="background-color: #533443;">
                                <a href="" data-toggle="modal" data-target="#routineModal"><div>Routine</div></a>
                            </div>
                        </div>
                    </a>

                    <a href="#">
                        <div class="col-md-6" style="padding: 5px;">
                            <div class="dropdown-div" style="background-color: #a07789;">
                                <a href=""  data-toggle="modal" data-target="#feeModal"><div>Fee</div></a>
                            </div>
                        </div>
                    </a>
                </div>
            </li>';
            }

            if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin') {
                ?>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Class Performance<b
                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php
                        $class = getClass($connection);
                        while ($row = mysqli_fetch_assoc($class)) {
                            ?>
                            <li>
                                <a href="classPerform.php?id=<?php echo $row["id"]; ?>">Class <?php echo $row["class"]; ?></a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
                <?php
                echo '<li><a href="update.php">Upgrade Class</a></li>';
            }

            if ($_SESSION['role'] == 'teacher') {
                echo '<li><a href="t_marks.php">Insert Marks</a></li>';
            }

            if (isset($_SESSION['multiChild'])) {
                $pid = $_SESSION['user_id'];
                $parentsInfo = getParentsInfo($pid, $connection);
                while ($row = mysqli_fetch_assoc($parentsInfo)) {
                    $student_id = $row["student_id"];
                    $student_ids = explode(",", $student_id);
                    $number_child = sizeof($student_ids);
                }
                ?>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Child Profile<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php
                        for ($i = 0; $i < $number_child; $i++) {
                            ?>
                            <li>
                                <a href="a_profile.php?sid=<?php echo $student_ids[$i]; ?>"><?php echo getStudentName($student_ids[$i], $connection); ?></a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>

                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Attendance<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php
                        for ($i = 0; $i < $number_child; $i++) {
                            ?>
                            <li>
                                <a href="studentAttendance.php?id=<?php echo $student_ids[$i]; ?>"><?php echo getStudentName($student_ids[$i], $connection); ?></a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>

                <!--                <li><a href="studentAttendance.php?id=--><?php //echo $student_ids[$i];
                ?><!--">Attendance</a></li>-->

            <?php
            }

            if (isset($_SESSION['sid'])) {
                ?>
                <li><a href="a_profile.php?sid=<?php echo $_SESSION['sid']; ?>">Profile</a></li>
                <li><a href="studentAttendance.php?id=<?php echo $_SESSION['sid']; ?>">Attendance</a></li>
            <?php
            }

            if ($_SESSION['role'] == 'Parents') {
                echo '<li><a href="#" data-toggle="modal" data-target="#appointmentModal">Make Appointment</a></li>';
            }

            ?>


        </ul>
        <!--        <div class="col-sm-3 col-md-3">-->
        <!--            <form class="navbar-form" role="search">-->
        <!--                <div class="input-group">-->
        <!--                    <input type="text" class="form-control" placeholder="Search" name="q">-->
        <!---->
        <!--                    <div class="input-group-btn">-->
        <!--                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i>-->
        <!--                        </button>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </form>-->
        <!--        </div>-->
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">H! <?php echo ucfirst($_SESSION['username']); ?><b class="caret"></b></a>

                <ul class="dropdown-menu ">
                    <li><a href="#" data-toggle="modal" data-target="#changePasswordModal">Change Password</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
<div style="height: 50px;"></div>


</body>
</html>