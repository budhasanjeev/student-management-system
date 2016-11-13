<?php
/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 9/13/2016
 * Time: 3:11 PM
 */
session_start();
include  '../common/Common.php';

$objCommon = new Common();

if(isset($_POST['mode'])){

    if($_POST['mode']=='add'){

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $username = $_POST['username'];
        $role     = $_POST['role'];
        $emailAddress  = $_POST['email'];
        $children  = $_POST['student_id'];

        $student_id = implode(",",$children);

        $image = $_FILES['photo']['name'];
        $image_tmp = $_FILES['photo']['tmp_name'];

        move_uploaded_file($image_tmp,"../img/$image");
        
        $result = $objCommon->createUser($firstName,$lastName,$username,$role,$emailAddress,$student_id,$image);
        
        if($result){
            $_SESSION['create_user'] = 'success';
        }
        else{
            $_SESSION['create_user'] = 'error';
        }

        header('Location:../views/a_user.php');

    }

    else if($_POST['mode'] == 'edit'){

        $id = $_POST['id'];

        $result = array();

        $result = $objCommon->editUser($id);

        echo json_encode($result);
        
    }

    else if($_POST['mode'] == 'update'){

        $user_id = $_POST['user_id'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $username = $_POST['username'];
        $role     = $_POST['role'];
        $emailAddress  = $_POST['email'];
        $student_id  = $_POST['student_id'];

        $image = $_FILES['photo']['name'];
        $image_tmp = $_FILES['photo']['tmp_name'];

        move_uploaded_file($image_tmp,"../images/$image");

        $result = $objCommon->updateUser($firstName,$lastName,$username,$role,$emailAddress,$student_id,$image,$user_id);

        if($result){
            $_SESSION['create_user'] = 'success';
        }
        else{
            $_SESSION['create_user'] = 'error';
        }

        header('Location:../views/a_user.php');
        
    }

    else if($_POST['mode']=='delete'){

        $id = $_POST['id'];

        $result = array();

        $result = $objCommon->deleteUser($id);

        echo json_encode($result);

    }
}