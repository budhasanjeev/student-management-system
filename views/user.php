<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/13/2016
 * Time: 3:52 PM
 */
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Student Management</title>
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
                    <form action="" class="form form-horizontal">
                        <div class="form-group">
                            <label class="col-md-4">Username</label>
                            <div class="col-lg-8">
                                <input class="form-control" type="text" name="username" required=""/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4">Password</label>
                            <div class="col-lg-8">
                                <input class="form-control" type="password" name="password" required=""/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4">Conform Password</label>
                            <div class="col-lg-8">
                                <input class="form-control" type="password" name="conformPassword" required=""/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4">Role</label>
                            <div class="col-lg-8">
                                <select class="form-control">
                                    <option>Parents</option>
                                    <option>Admin</option>
                                    <option>Teacher</option>
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
                                <input class="form-control" type="text" name="student" required=""/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4">Photo</label>
                            <div class="col-lg-8">
                                <input type="file" name="photo" required=""/>
                            </div>
                        </div>

                        <input class="btn btn-primary" type="submit"/>
                    </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<div class="container">
<div style="text-align: right;">
    <button type="button" class="btn btn-primary glyphicon glyphicon-plus"  data-toggle="modal" data-target="#addUser">  New</button>
</div>
    <div>
        <table class="table table-responsive">
            <thead>
            <tr>
                <th></th>
            </tr>
            </thead>
        </table>
    </div>
</div>
</body>
</html>