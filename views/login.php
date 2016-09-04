<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/4/2016
 * Time: 11:55 AM
 */

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Student Management</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/style.css"/>
</head>
<body style="display: flex; justify-content: center; align-items: center;">

<div class="highlight login-div">
    <form class="form-horizontal" action="">
        <legend><h2>System Login</h2></legend>
        <div class="form-group">
            <label class="glyphicon glyphicon-user col-md-2 login-glyphicon"></label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="username" required="" placeholder="username"/>
            </div>
        </div>

        <div class="form-group">
            <label class="glyphicon glyphicon-pencil col-md-2 login-glyphicon" for=""></label>
            <div class="col-md-10">
            <input type="password" class="form-control" name="password" required="" placeholder="password"/>
            </div>
        </div>

        <input class="btn btn-primary btn-block" type="submit" value="login"/>
    </form>
</div>

</body>
</html>