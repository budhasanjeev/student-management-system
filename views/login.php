<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/4/2016
 * Time: 11:55 AM
 */

include '../config/databaseConnection.php';
if (isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stored_password = "null";
    $role = "null";

    $select_query = "SELECT `password`, `role` FROM `user` WHERE `email_address` = '$email'";
    $result = $connection->query($select_query);


    while($row = $result->fetch_assoc()){
        $stored_password = $row['password'];
        $role = $row['role'];
    }

    if($password == $stored_password){
        if($role == "admin"){
            header("Location: admin/index.php");
        }else{
            echo "student";
        }
    }else{
        echo "user not found";
    }


}


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
    <form class="form-horizontal"  method="post" action="">
        <legend><h2>System Login</h2></legend>
        <div class="form-group">
            <label class="glyphicon glyphicon-envelope col-md-2 login-glyphicon"></label>
            <div class="col-md-10">
                <input type="email" class="form-control" name="email" required="" placeholder="username"/>
            </div>
        </div>

        <div class="form-group">
            <label class="glyphicon glyphicon-pencil col-md-2 login-glyphicon" for=""></label>
            <div class="col-md-10">
            <input type="password" class="form-control" name="password" required="" placeholder="password"/>
            </div>
        </div>

        <input class="btn btn-primary btn-block" name="login" type="submit" value="login"/>
    </form>
</div>

</body>
</html>