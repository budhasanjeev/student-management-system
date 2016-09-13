<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/13/2016
 * Time: 3:52 PM
 */
session_start();
include '../common/Common.php';
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Student Management</title>

    <script src="../js/user.js" type="text/javascript"></script>
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
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <form action="../controller/userController.php" method="post" id="user-form" class="form form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" id="modes" name="mode" value="add">
                    <div class="form-group">
                        <label class="col-md-4">Username</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" name="username" required=""/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4">Role</label>
                        <div class="col-lg-8">
                            <select class="form-control" name="role">
                                <option value="parents">Parents</option>
                                <option value="admin">Admin</option>
                                <option value="teacher">Teacher</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4">Email</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="email" name="email" required=""/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4">Student</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" name="student_id" required=""/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4">Photo</label>
                        <div class="col-lg-8">
                            <input type="file" name="photo" required=""/>
                        </div>
                    </div>

                    <input class="btn btn-primary" type="submit">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<div class="container">
    <?php
    if (isset($_SESSION['create_user']) == 'success') {
        ?>
        <script>

            displayMessage('user successfully created', 'success');

        </script>
        <?php
    }else if (isset($_SESSION['create_user']) == 'fail'){
        ?>
    <script>

        displayMessage('failed to create user', 'error');

    </script>
    <?php
    }
        unset($_SESSION['create_user']);
        session_destroy();
    ?>
    <div style="text-align: right;">
        <button type="button" class="btn btn-primary glyphicon glyphicon-plus"  data-toggle="modal" data-target="#addUser">  New</button>
    </div>
    <div>
        <table class="table table-responsive">
            <thead>
            <tr>
                <th>photo</th>
                <th>username</th>
                <th>email</th>
                <th>role</th>
                <th>actions</th>
            </tr>
            </thead>

            <tbody>

            <?php
            $objCommon = new Common();

            $userList = $objCommon->getUser();

            foreach ($userList as $user) {

                ?>
                <tr>
                    <td><img src="../images/<?php echo $user['photo'] ?>" style="height: 50px" class="img-circle"></td>
                    <td><?php echo $user['username'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td><?php echo $user['role'] ?></td>
                    <td style="vertical-align: middle">
                        <button class="btn btn-default" onclick="editUser(<?php echo $user['id'] ?>)" title="EDIT"><span class="glyphicon glyphicon-edit"></span></button>
                        <button class="btn btn-default" onclick="deleteUser(<?php echo $user['id'] ?>)" title="DELETE"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
                </tr>

                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>