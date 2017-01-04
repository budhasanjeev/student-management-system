<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Student Management</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/style.css"/>
</head>
<body style="font-family: 'Kaushan Script', cursive;">

<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/4/2016
 * Time: 11:55 AM
 */


include '../config/databaseConnection.php';
session_start();

if (isset($_POST["login"])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $stored_password = "null";
    $role = "null";
    
    $select_from_user = "SELECT id, password, role, username FROM user WHERE email = '$email'";

    $select_from_teacher = "SELECT id, password, username FROM teacher WHERE email = '$email'";

    $result_from_user = $connection->query($select_from_user);

    $result_from_teacher = $connection->query($select_from_teacher);

    if(mysqli_num_rows($result_from_user) > 0) {
        $row = $result_from_user->fetch_assoc();
        $stored_password = $row['password'];
        $role = $row['role'];
        $user_id = $row['id'];
        $username = $row['username'];

    }else if(mysqli_num_rows($result_from_teacher) > 0){
        $row = $result_from_teacher->fetch_assoc();
        $stored_password = $row['password'];
        $role = 'teacher';
        $teacher_id = $row['id'];
        $username = $row['username'];
    }

    if(md5($password) == $stored_password){

        if($role == "Admin" || $role == "sAdmin"){
            echo "admin";
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            header("Location: admin.php");
        }
        else if($role == "Parents"){
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            header("Location: ../controller/c_checkChildren.php");
        }
        else if($role == "Receptionist"){
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            header("Location: recp.php");
        }
        else if($role == "teacher") {
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            $_SESSION['teacher_id'] = $teacher_id;
            $_SESSION['username'] = $username;
            header("Location: a_class.php");

        }
    }else{
        ?>
        <script>

            alert('sadf');
            span.style.display="block"


        </script>
<?php
    }
}

?>

<div style="height: 100%; width: 100%; display: flex; justify-content: center; align-items: center; position: absolute; background-color: #f5f5f5;">
<div style="text-align: center;">
    <div class="container" style="text-align: center;">

    </div>

    <div style="width: 50%; display: inline-block;">
        <div class="login-div">
            <h3 style="font-family: 'Ultra', serif;">Student Management Portal</h3>

            <hr/>
            <span class="error" id="err" style="z-index: 100;">Username Not Found</span><br/>
            <form class="form-horizontal"  method="post" action="">
                <!--        <legend><h2>System Login</h2></legend>-->
                <div class="form-group">
                    <label class="glyphicon glyphicon-user col-md-2 login-glyphicon"></label>
                    <div class="col-md-10">
                        <input type="email" class="form-control" name="email" required="" placeholder="e-mail address"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="glyphicon glyphicon-pencil col-md-2 login-glyphicon" for=""></label>
                    <div class="col-md-10">
                        <input type="password" class="form-control" name="password" required="" placeholder="password"/>
                    </div>
                </div>

                <input class="btn btn-primary btn-block" style="background-color: #080808"  name="login" type="submit" value="login"/>
            </form>
        </div>
    </div>
    </div>
</div>


</body>

</html>