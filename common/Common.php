<?php

/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 8/31/2016
 * Time: 7:08 PM
 */

require('../config/databaseConnection.php');

class Common
{

    public function login($username,$pwd){

        global $connection;

        $pwd = md5($pwd);

        $login_query = "SELECT *FROM user WHERE email_address = '$username' and password='$pwd' ";

        $result = mysqli_query($connection,$login_query);

        $data = array();

        if(mysqli_num_rows($result)>0){

            $data['message']='success';

            while($row = mysqli_fetch_assoc($result)){
                $data['first_name'] = $row['first_name'];
                $data['last_name'] = $row['last_name'];
                $data['role'] = $row['role'];
            }

        }
        else{
            $data['message']='fail';
        }

        return $data;

    }

    public function createStudent(){

    }
    public function getAllStudent(){

    }

    public function editStudent(){

    }

    public function updateStudent(){

    }

    public function terminateStudent(){

    }
    
}