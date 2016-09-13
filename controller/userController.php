<?php
/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 9/13/2016
 * Time: 3:11 PM
 */
include '../common/Common.php';

$objCommon = new Common();

if(isset($_POST['mode'])){

    if(isset($_POST['mode']) == 'add'){

        $username = $_POST['username'];
        $role     = $_POST['role'];
        $address  = $_POST['email'];
        $student_id  = implode(',', $_POST['student_id']);

        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($image_tmp,"../images/$image");
        
        $result = $objCommon->createUser($username,$role,$emailAddress,$student_id,$image);
        
        
    }

    else if(isset($_POST['mode']) == 'edit'){

    }

    else if(isset($_POST['mode']) == 'update'){

    }

    else if(isset($_POST['mode']) == 'delete'){

    }
}