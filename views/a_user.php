<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/13/2016
 * Time: 3:52 PM
 */

session_start();

if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin'){
include '../config/databaseConnection.php';
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Student Management</title>
    <link href="https://fonts.googleapis.com/css?family=David+Libre|Raleway" rel="stylesheet">
    <script src="../js/user.js"></script>
</head>
<body>
<?php include 'layout/header.php'; ?>

<!-- Add user Modal -->
<div id="addUser" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center;"></h4>
            </div>
            <div class="modal-body">
                <form id="user-form" action="" method="post" enctype="multipart/form-data" class="form form-horizontal">

                    <input type="hidden" name="mode" id="modes">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group">
                        <label class="col-md-4">First Name</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" id="firstName" name="firstName" required=""/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4">Last Name</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" id="lastName" name="lastName" required=""/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4">Username</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" id="username" name="username" required="" onChange="checkUsername();"/>
                            <div class="error username">Username already exists</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4">Role</label>
                        <div class="col-lg-8">
                            <select class="form-control" name="role" id="role" onchange="checkRole();">
                                <?php
                                if($_SESSION['role'] == "sAdmin"){
                                    ?>
                                    <option value="Admin">Admin</option>
                                <?php
                                }
                                ?>
                                <option value="Parents">Parents</option>
                                <option value="Receptionist">Receptionist</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4">Email</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="email" id="uemail" name="email" required="" onchange="checkEmail();"/>
                            <div class="error email">Email already exists</div>
                        </div>
                    </div>

                    <div class="form-group children">
                        <label class="col-md-4">Children</label>
                        <div class="col-lg-8">
                            <!-- <input class="form-control" type="text" id="student_id" name="student_id" required=""/>-->
                            <select class="form-control js-example-basic-multiple " multiple="multiple" name="student_id[]" id="student_id" style="width: 100%">
                                <?php
                                    $objCommon = new Common();

                                    $studentList = $objCommon->getStudent();

                                    foreach ($studentList as $student ){
                                        ?>
                                        <option value="<?php echo $student["id"] ; ?>">
                                            <?php echo $student["first_name"].' '.$student["last_name"] ?>
                                        </option>

                                        <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4">Photo</label>
                        <div class="col-lg-8">
                            <input type="file" name="photo" id="photo" required=""/>
                        </div>
                    </div>

                    <div style="text-align: right;">
                        <input class="btn btn-primary" id="registerButton" type="submit" id="user-save"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<div class="container">
    <div class="add-btn-div">
        <button type="button" id="add-user" class="btn btn-primary btn-block glyphicon glyphicon-plus"> New</button>
    </div>

    <?php
    $email = $_SESSION['email'];
    $role = $_SESSION['role'];

    if(isset($_SESSION['create_user'])){
        if($_SESSION['create_user'] == 'success'){
            echo '<script>
                    displayMessage("Successfully completed","success");
                </script>';
        }
        else if($_SESSION['create_user'] == 'error'){
            echo '<script>
                    displayMessage("failed to complete","error");
                </script>';
        }
    }
    session_unset();

    $_SESSION['email'] = $email;
    $_SESSION['role'] = $role;
    ?>

    <div>
        <table class="table table-responsive">
            <thead>
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $objCommon = new Common();
            $userList = $objCommon->getUser();

            foreach ($userList as $user) {
                ?>
                <tr>
                    <td style="vertical-align: middle"><img src="../img/<?php echo $user['photo'] ?>"
                                                            class="img-circle" style="width:40px"></td>
                    <td style="vertical-align: middle"><?php echo $user['first_name'] . ' ' . $user['last_name'] ?></td>
                    <td style="vertical-align: middle"><?php echo $user['username'] ?></td>
                    <td style="vertical-align: middle"><?php echo $user['email'] ?></td>
                    <td style="vertical-align: middle"><?php echo $user['role'] ?></td>
                    <td style="vertical-align: middle">
                        <button class="btn btn-default" onclick="editUser(<?php echo $user['id'] ?>)"><span class="glyphicon glyphicon-edit"></span></button>
                        <button class="btn btn-default" onclick="deleteUser(<?php echo $user['id'] ?>)"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
                </tr>

                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<script>

    $('#add-user').on('click',function () {
        $('#addUser').modal('show');
        $('#addUser .modal-title').html("ADD USER");
        $('#addUser button[type=submit]').html("submit");
        $('#user-form').attr('action','../controller/userController.php');
        $('#modes').attr('value','add');
        $('#user_id').removeAttr('value');

    });

    function checkRole(){
        var role = document.getElementById('role').value;
        if(role == "Parents"){
            alert(role);
            $(".children").css('display','block');
        }else{
            $(".children").css('display','none');
        }
    }



    function checkUsername(){

        var username = document.getElementById('username').value;
        $.ajax({
            type:'POST',
            url:'../controller/usernameExists.php',
            data:'username='+username,
            success:function(data){
                var jsonData = JSON.parse(data);
                if(jsonData.message == "fail"){

                    $("#username").attr('style', 'border: 1px solid blue');
                    $(".username").attr('style', 'display: none;');
                    $("#registerButton").prop('disabled', false);
                }else{
                    $("#username").attr('style', 'border: 2px solid red');
                    $(".username").attr('style', 'display: block;');
                    $("#registerButton").prop('disabled', true);
                }
            }
        })
    }

    function checkEmail(){


        var username = document.getElementById('uemail').value;
        alert(username);
        $.ajax({
            type:'POST',
            url:'../controller/emailExists.php',
            data:'username='+username,
            success:function(data){
                var jsonData = JSON.parse(data);
                if(jsonData.message == "fail"){

                    $("#email").attr('style', 'border: 1px solid blue');
                    $(".email").attr('style', 'display: none;');
                    $("#registerButton").prop('disabled', false);
                }else{
                    $("#email").attr('style', 'border: 2px solid red');
                    $(".email").attr('style', 'display: block;');
                    $("#registerButton").prop('disabled', true);
                }
            }
        })
    }


</script>

<script type="text/javascript">
    $(".js-example-basic-multiple").select2();



</script>
</body>
</html>

<?php
}else{
    header('Location: logout.php');
}
?>
