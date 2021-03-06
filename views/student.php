<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/5/2016
 * Time: 6:38 PM
 */
//include '../common/Common.php'
session_start();

if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin'){
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Student Management</title>

    <script src="../js/student.js"></script>
</head>
<body>
<?php
include 'layout/header.php';
?>

<div class="container">

    <div class="add-btn-div">
    <div class="col-md-4">
        <a href="studentForm.php" class="btn btn-block btn-primary">Add Student Form</a>
    </div>
    <div class="col-md-4">
        <a href="../controller/downloadController.php?link=sample_excel.xlsx" class="btn btn-block btn-primary">Download Excel Sample</a>
    </div>
    <div class="col-md-4">
        <button class="btn btn-block btn-primary" onclick="uploadExcel();">Upload Excel</button>
    </div>
    </div>

    <?php
    $email = $_SESSION['email'];
    $role = $_SESSION['role'];
    $username = $_SESSION['username'];

    if(isset($_SESSION['create_student'])){
        if($_SESSION['create_student'] == 'success'){
            echo '<script>
                    displayMessage("Successfully completed","success");
                </script>';
        }
        else if($_SESSION['create_student'] == 'error'){
            echo '<script>
                    displayMessage("failed to complete","error");
                </script>';
        }
    }

    session_unset();
    $_SESSION['email'] = $email;
    $_SESSION['role'] = $role;
    $_SESSION['username'] = $username;

    ?>

    <table class="table table-responsive table-bordered table-striped">
        <thead  style="font-size: 15px;">
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

        <tbody  style="font-size: 13px;">
        <?php
        $objCommon = new Common();
        $studentList = $objCommon->getStudent();

        foreach ($studentList as $student) {
            ?>

            <tr>
                <td style="vertical-align: middle"><img src="../img/<?php echo $student['photo'] ?>" style="width: 40px;" class="img-circle">
                </td>
                <td style="vertical-align: middle"><?php echo $student['student_id'] ?></td>
                <td style="vertical-align: middle"><?php echo $student['first_name'] . ' ' . $student['last_name'] ?></td>
                <td style="vertical-align: middle"><?php echo $student['dob'] ?></td>
                <td style="vertical-align: middle"><?php echo $student['address'] ?></td>
                <td style="vertical-align: middle"><?php echo $student['contact_number'] ?></td>
                <td style="vertical-align: middle"><?php echo $student['roll_number'] ?></td>
                <td style="vertical-align: middle"><?php echo $student['grade'] ?></td>
                <td style="vertical-align: middle"><?php echo $student['section'] ?></td>
                <td style="vertical-align: middle"><?php echo $student['father_name'] ?></td>
                <td style="vertical-align: middle"><?php echo $student['mother_name'] ?></td>
                <td style="vertical-align: middle">
                    <form action="../controller/studentController.php" method="post">
                        <input type="hidden" name="mode" value="edit">
                        <input type="hidden" name="id" value="<?php echo $student['id'] ?>">
                        <button class="btn btn-default"><span class="glyphicon glyphicon-edit"></span></button>
                    </form>
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

<div id="upload-excel" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Excel</h4>
            </div>
            <div class="modal-body">
                <form class="form" action="../controller/studentController.php" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="mode" value="excel">
                    <div class="form-group">
                        <label for="class">File : </label>
                        <input class="form-control" type="file" name="student_excel" required=""/>
                    </div>

                    <div style="text-align: right">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

</body>
<script>
    function uploadExcel(){

        $('#upload-excel').modal();

    }
</script>
</html>
<?php
}else{
    header('Location: logout.php');
}
?>
